<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\DeleteNotification;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteOneJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @param  string  $url
     * @return void
     */
    public function __construct(
        protected User $user,
        protected string $url,
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $res = $this->user->hatenaBookmark()->delete($this->url)->throw();

        if ($res->successful()) {
            $this->user->notify(new DeleteNotification($this->url, $this->url));
        }
    }
}
