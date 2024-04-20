<li class="pb-3 border-b">
    <time>{{ $date }}</time>

    <a href="{{ $link }}"
       class="font-bold text-indigo-500 hover:text-indigo-800 underline"
       target="_blank">
        {{ $title }}
    </a>

    @unless(empty($description))
        <span class="text-gray-500">『{{ $description }}』</span>
    @endunless

    <x-ts-button wire:click="delete()" wire:loading.attr="disabled" outline sm>
        個別削除
    </x-ts-button>
</li>
