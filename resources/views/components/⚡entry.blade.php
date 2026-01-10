<?php

use App\Jobs\DeleteOneJob;
use Livewire\Component;

new class extends Component
{
    public string $link;

    public string $title;

    public string $description;

    public string $date;

    public function delete(): void
    {
        DeleteOneJob::dispatchSync(request()->user(), $this->link);

        $this->dispatch('deleted');
    }
};
?>

<li class="py-3 border-b border-zinc-200">
    <time>{{ $date }}</time>

    <a href="{{ $link }}"
       class="font-bold text-indigo-500 hover:text-indigo-700 hover:underline"
       target="_blank">
        {{ $title }}
    </a>

    @unless(empty($description))
        <span class="text-gray-500">『{{ $description }}』</span>
    @endunless

    <flux:button wire:click="delete()" size="xs">
        個別削除
    </flux:button>
</li>
