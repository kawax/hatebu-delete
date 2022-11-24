<div class="card bg-primary my-2">
    <div class="card-header text-white">
        {{ $this->feed->channel->title }}（最近の20件） {{ now() }}
    </div>
    <ul class="list-group list-group-flush">
        @foreach($this->feed->item as $item)
            <livewire:entry :link="(string)$item->link"
                            :title="(string)$item->title"
                            :description="(string)$item->description"
                            :date="Date::parse($item->children('dc', true)->date)->addHours(9)->toDateTimeString()"
                            :key="(string)$item->link">
        @endforeach
    </ul>
</div>
