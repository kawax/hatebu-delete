<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Notifications extends Component
{
    public Collection $notifications;

    protected $listeners = ['deleted' => 'notifications'];

    public function mount()
    {
        $this->notifications();
    }

    public function notifications()
    {
        request()->user()
                 ->readNotifications()
                 ->where('created_at', '<', now()->subDays(config('hatena.delete_days')))
                 ->delete();

        $notifications = request()->user()->notifications;
        $notifications->markAsRead();

        $this->notifications = $notifications->take(20);
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
