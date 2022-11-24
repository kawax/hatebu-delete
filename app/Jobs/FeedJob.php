<?php

namespace App\Jobs;

use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
     *
     * @throws GuzzleException
     */
    public function handle(): SimpleXMLElement
    {
        $feed = $this->user->hatenaBookmark()->feed($this->user->name);

        return simplexml_load_string($feed);
    }
}
