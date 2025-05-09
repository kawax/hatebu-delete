<flux:card>
    <flux:heading>
        {{ $this->feed->channel->title }}（最近の20件） {{ now() }}
    </flux:heading>

    <ul class="list-none">
        @foreach($this->feed->item as $item)
            <livewire:entry :link="(string)$item->link"
                            :title="(string)$item->title"
                            :description="(string)$item->description"
                            :date="Date::parse($item->children('dc', true)->date)->addHours(9)->toDateTimeString()"
                            :key="(string)$item->link">
        @endforeach
    </ul>
</flux:card>
