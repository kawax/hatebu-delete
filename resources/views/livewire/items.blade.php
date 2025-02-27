<x-ts-card color="primary">
    <x-slot:header>
        {{ $this->feed->channel->title }}（最近の20件） {{ now() }}
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
</x-ts-card>
