<?php

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Defer;
use Livewire\Attributes\On;
use Livewire\Component;

new
#[Defer]
class extends Component
{
    public Collection $notifications;

    public function mount(): void
    {
        $this->notifications();
    }

    #[On('deleted')]
    public function notifications(): void
    {
        request()->user()
            ->readNotifications()
            ->where('created_at', '<', now()->subDays(config('hatena.delete_days')))
            ->delete();

        $notifications = request()->user()->notifications;
        $notifications->markAsRead();

        $this->notifications = $notifications->take(20);
    }
};
?>

<x-card>
    <x-slot:header>
        <flux:heading size="xl">
            通知
        </flux:heading>
    </x-slot:header>

    <ul class="list-none">
        @foreach($notifications as $notification)
            <li class="py-3 border-b border-zinc-200">
                <time>{{ $notification->created_at }}</time>

                @switch(class_basename($notification->type))
                    @case('DeleteNotification')
                        <a href="{{ data_get($notification->data, 'url') }}" target="_blank"
                           class="font-bold text-indigo-500 hover:text-indigo-700 hover:underline break-all">
                            {{ data_get($notification->data, 'title') }}
                        </a>
                        を削除。
                        @break
                    @default
                        ...
                        @break
                @endswitch
            </li>
        @endforeach
    </ul>
</x-card>
