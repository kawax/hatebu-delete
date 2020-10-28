<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\DeleteNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Revolution\Hatena\Bookmark\Bookmark;

class DeleteJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $feed = FeedJob::dispatchNow($this->user);

        foreach ($feed->item as $item) {
            $this->delete($item);
        }

        $this->user->fill([
            'fails' => 0,
        ])->save();
    }

    /**
     * @param mixed $item
     */
    private function delete($item)
    {
        $url = (string) $item->link;

        if (empty($url)) {
            return;
        }

        $date = Carbon::parse((string) $item->children('http://purl.org/dc/elements/1.1/')->date);

        if ($date->gt(now()->subDays(config('hatena.delete_days')))) {
            return;
        }

        try {
            //FeedJobで認証情報はセット済なのでここでは不要
            $status = app(Bookmark::class)->delete($url);

            if ($status === Bookmark::NO_CONTENT) {
                $this->user->notify(new DeleteNotification((string) $item->title, $url));
            }
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
        }
    }

    /**
     * @param \Exception $exception
     */
    public function failed(\Exception $exception)
    {
        $this->user->increment('fails');
    }
}
