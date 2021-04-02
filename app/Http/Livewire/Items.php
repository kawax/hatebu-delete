<?php

namespace App\Http\Livewire;

use App\Jobs\FeedJob;
use Livewire\Component;

class Items extends Component
{
    protected $feed;

    protected $listeners = ['deleted' => 'feed'];

    public function mount()
    {
        $this->feed();
    }

    public function feed()
    {
        $this->feed = FeedJob::dispatchSync(request()->user());
    }

    public function getFeedProperty()
    {
        return $this->feed;
    }

    public function render()
    {
        return view('livewire.items');
    }
}
