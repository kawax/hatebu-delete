<x-layouts.app :title="config('app.name')">
    <div class="grid md:grid-cols-2 pt-6 gap-6">
        <div>
            <livewire:delete/>

            <livewire:items/>
        </div>
        <div>
            <livewire:notifications/>
        </div>
    </div>
</x-layouts.app>
