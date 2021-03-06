<li class="list-group-item">
    <time>{{ $date }}</time>

    <a href="{{ $link }}"
       class="fw-bold"
       target="_blank">
        {{ $title }}
    </a>

    @unless(empty($description))
        <span class="text-muted">『{{ $description }}』</span>
    @endunless

    <button wire:click="delete()"
            class="btn btn-outline-dark btn-sm"
            wire:loading.attr="disabled">
        個別削除
    </button>
</li>
