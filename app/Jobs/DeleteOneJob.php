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

class DeleteOneJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $url;

    /**
     * Create a new job instance.
     *
     * @param User   $user
     * @param string $url
     *
     * @return void
     */
    public function __construct(User $user, string $url)
    {
        $this->user = $user;
        $this->url = $url;
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

        $status = $bookmark->setAuth($config)->delete($this->url);

        if ($status === Bookmark::NO_CONTENT) {
            $this->user->notify(new DeleteNotification($this->url, $this->url));
        }
    }
}
