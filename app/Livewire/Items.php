<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Bookmark\Feed;
use Livewire\Attributes\On;
use Livewire\Component;
use SimpleXMLElement;

class Items extends Component
{
    protected SimpleXMLElement $feed;

    public function mount(): void
    {
        $this->feed();
    }

    #[On('deleted')]
    public function feed(): void
    {
        $this->feed = app(Feed::class)->get(request()->user());
    }

    public function getFeedProperty(): SimpleXMLElement
    {
        return $this->feed;
    }
}
