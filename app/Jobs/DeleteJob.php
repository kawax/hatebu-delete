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
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function handle(Bookmark $bookmark)
    {
        $config = [
            'consumer_key'    => config('services.hatena.client_id'),
            'consumer_secret' => config('services.hatena.client_secret'),
            'token'           => $this->user->access_token,
            'token_secret'    => $this->user->token_secret,
        ];

        $feed = $bookmark->setAuth($config)->feed();
        $feed = simplexml_load_string($feed);

        foreach ($feed->entry as $item) {
            $url = (string)$item->link[0]->attributes()['href'] ?? '';
            if (empty($url)) {
                continue;
            }

            $title = (string)$item->title;

            $date = Carbon::parse((string)$item->issued);

            if ($date->lt(now()->subDays(config('hatena.delete_days')))) {
                $status = $bookmark->delete($url);

                if ($status === 204) {
                    $this->user->notify(new DeleteNotification($title, $url));
                }
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
