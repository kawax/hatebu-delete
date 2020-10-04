{{-- Success is as dangerous as failure. --}}
<li class="list-group-item">
    <time>{{ $date }}</time>

    <a href="{{ $link }}"
       class="font-weight-bold"
       target="_blank"
       rel="noreferrer noopener">
        {{ $title }}
    </a>

    @unless(empty($description))
        <span class="text-muted">『{{ $description }}』</span>
    @endunless

    <button wire:click="delete()" class="btn btn-outline-dark btn-sm">個別削除</button>

</li>
