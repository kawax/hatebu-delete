<?php

namespace App\Jobs;

use App\Bookmark\Feed;
use App\Models\User;
use App\Notifications\DeleteNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SimpleXMLElement;
use Throwable;

class DeleteAllJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected User $user,
    ) {}

    /**
     * Execute the job.
     *
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws RequestException
     */
    public function handle(): void
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
     * @throws RequestException
     */
    private function delete(SimpleXMLElement $item)
    {
        $url = (string) $item->link;

        if (empty($url)) {
            return;
        }

        $date = Carbon::parse((string) $item->children('dc', true)->date, config('app.timezone'))
            ->addDays(config('hatena.delete_days')); // ○日後に削除

        if ($date->greaterThan(now())) {
            return;
        }

        $res = $this->user->hatenaBookmark()->delete($url)->throw();

        if ($res->successful()) {
            $this->user->notify(new DeleteNotification((string) $item->title, $url));
        }
    }

    public function failed(?Throwable $exception): void
    {
        info($exception->getMessage());

        $this->user->increment('fails');
    }
}
