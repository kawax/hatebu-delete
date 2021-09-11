<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Revolution\Hatena\Bookmark\Bookmark;
use Revolution\Hatena\Bookmark\My;
use Revolution\Illuminate\Support\DispatchNow;
use SimpleXMLElement;

class FeedJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use DispatchNow;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(protected User $user)
    {
    }

    /**
     * Execute the job.
     *
     * @return SimpleXMLElement
     */
    public function handle(): SimpleXMLElement
    {
        $config = [
            'consumer_key'    => config('services.hatena.client_id'),
            'consumer_secret' => config('services.hatena.client_secret'),
            'token'           => $this->user->access_token,
            'token_secret'    => $this->user->token_secret,
        ];

        $my = app(My::class)->setAuth($config)->my();
        $my = json_decode($my);

        $feed = app(Bookmark::class)->setAuth($config)->feed($my->name);

        return simplexml_load_string($feed);
    }
}
