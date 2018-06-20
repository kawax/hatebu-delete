<li class="list-group-item">
    @php
        $url = data_get(head($item->link), 'href', '');
    @endphp

    <time>{{ Carbon\Carbon::parse($item->issued)->toDateTimeString() }}</time>

    <a href="{{ $url }}"
       class="font-weight-bold"
       target="_blank"
       rel="noreferrer noopener">
        {{ $item->title }}
    </a>

    @unless(empty($item->summary))
        <span class="text-muted">『{{ $item->summary }}』</span>
    @endunless

    <form action="{{ route('delete-one') }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="url" value="{{ $url }}">
        <input class="btn btn-outline-dark btn-sm" type="submit" value="個別削除">
    </form>
</li>
