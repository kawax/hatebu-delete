<?php

namespace App\Jobs;

use App\Bookmark\Feed;
use App\Models\User;
use App\Notifications\DeleteNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Revolution\Hatena\Bookmark\Bookmark;

class DeleteAllJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(
        protected User $user
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $feed = app(Feed::class)->get($this->user);

        foreach ($feed->item as $item) {
            $this->delete($item);
        }

        $this->user->fill([
            'fails' => 0,
        ])->save();
    }

    /**
     * @param  mixed  $item
     */
    private function delete($item)
    {
        $url = (string) $item->link;

        if (empty($url)) {
            return;
        }

        $date = Carbon::parse((string) $item->children('dc', true)->date)
                      ->addHours(9)//日本時間に合わせる調整
                      ->addDays(config('hatena.delete_days'));//○日後に削除

        if ($date->gt(now())) {
            return;
        }

        try {
            $status = $this->user->hatenaBookmark()->delete($url);

            if ($status === Bookmark::NO_CONTENT) {
                $this->user->notify(new DeleteNotification((string) $item->title, $url));
            }
        } catch (\Exception $e) {
            logger()->error($e->getMessage(), [$date->toDateTimeString()]);
        }
    }

    /**
     * @param  \Exception  $exception
     */
    public function failed(\Exception $exception)
    {
        $this->user->increment('fails');
    }
}
