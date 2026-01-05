<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
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
}
