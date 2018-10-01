<li class="list-group-item">
    @php
        $url = $item->link;
    @endphp

    <time>{{ Carbon\Carbon::parse($item->children('http://purl.org/dc/elements/1.1/')->date)->toDateTimeString() }}</time>

    <a href="{{ $url }}"
       class="font-weight-bold"
       target="_blank"
       rel="noreferrer noopener">
        {{ $item->title }}
    </a>

    @unless(empty($item->description))
        <span class="text-muted">『{{ $item->description }}』</span>
    @endunless

    <form action="{{ route('delete-one') }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="url" value="{{ $url }}">
        <input class="btn btn-outline-dark btn-sm" type="submit" value="個別削除">
    </form>
</li>
