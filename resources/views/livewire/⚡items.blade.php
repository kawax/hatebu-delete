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
                            :key="(string)$item->link">
        @endforeach
    </ul>
</x-card>
