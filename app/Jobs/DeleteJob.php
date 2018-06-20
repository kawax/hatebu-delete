<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\User;
use Revolution\Hatena\Bookmark\Bookmark;

use App\Notifications\DeleteNotification;

use Carbon\Carbon;

class DeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

        foreach ($feed->entry as $item) {
            $url = data_get(head($item->link), 'href');

            if (empty($url)) {
                continue;
            }

            $date = Carbon::parse((string)$item->issued);

            if ($date->gt(now()->subDays(config('hatena.delete_days')))) {
                continue;
            }

            //FeedJobで認証情報はセット済なのでここでは不要
            $status = app(Bookmark::class)->delete($url);

            if ($status === 204) {
                $this->user->notify(new DeleteNotification((string)$item->title, $url));
            }
        }

        $this->user->fill([
            'fails' => 0,
        ])->save();
    }

    /**
     * @param \Exception $exception
     */
    public function failed(\Exception $exception)
    {
        $this->user->increment('fails');
    }
}
