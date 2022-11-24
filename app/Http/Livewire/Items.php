<?php

namespace App\Http\Livewire;

use App\Bookmark\Feed;
use Livewire\Component;
use SimpleXMLElement;

class Items extends Component
{
    protected SimpleXMLElement $feed;

    protected $listeners = ['deleted' => 'feed'];

    public function mount()
    {
        $this->feed();
    }

    public function feed()
    {
        $this->feed = app(Feed::class)->get(request()->user());
    }

    public function getFeedProperty(): SimpleXMLElement
    {
        return $this->feed;
    }

    public function render()
    {
        return view('livewire.items');
    }
}
