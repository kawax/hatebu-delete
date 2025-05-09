<li class="py-3 border-b border-gray-400  hover:bg-zinc-50  dark:hover:bg-zinc-600/75">
    <time>{{ $date }}</time>

    <a href="{{ $link }}"
       class="font-bold text-indigo-500 hover:text-indigo-700 hover:underline"
       target="_blank">
        {{ $title }}
    </a>

    @unless(empty($description))
        <span class="text-gray-500">『{{ $description }}』</span>
    @endunless

    <flux:button wire:click="delete()" wire:loading.attr="disabled" variant="outline" size="sm">
        個別削除
    </flux:button>
</li>
