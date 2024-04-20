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
     * @param  User  $user
     * @return void
     */
    public function __construct(
        protected User $user,
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
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
     * @param  SimpleXMLElement  $item
     *
     * @throws RequestException
     */
    private function delete(SimpleXMLElement $item)
    {
        $url = (string) $item->link;

        if (empty($url)) {
            return;
        }

        $date = Carbon::parse((string) $item->children('dc', true)->date)
            ->addHours(9) //日本時間に合わせる調整
            ->addDays(config('hatena.delete_days')); //○日後に削除

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
