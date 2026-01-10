<?php

use App\Bookmark\Feed;
use Livewire\Attributes\Defer;
use Livewire\Attributes\On;
use Livewire\Component;

new
#[Defer]
class extends Component
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
};
?>

<x-card>
    <x-slot:header>
        <flux:heading size="xl">
            {{ $this->feed->channel->title }}（最近の20件） {{ now() }}
        </flux:heading>
    </x-slot:header>

    <ul class="list-none">
        @foreach($this->feed->item as $item)
            <livewire:entry :link="(string)$item->link"
                            :title="(string)$item->title"
                            :description="(string)$item->description"
                            :date="Date::parse($item->children('dc', true)->date)->addHours(9)->toDateTimeString()"
                            :key="(string)$item->link"/>
        @endforeach
    </ul>
</x-card>
