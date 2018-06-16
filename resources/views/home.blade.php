@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-primary">
                    <div class="card-body">
                        <a href="{{ route('delete') }}" class="btn btn-primary">最近の20件を削除</a>
                        <small class="text-muted">（{{ config('hatena.delete_days') }}日以内のブックマークは除く）</small>
                    </div>
                </div>

                <div class="card bg-primary my-2">
                    <div class="card-header text-white">
                        {{ $feed->title }}（最近の20件）
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($feed->entry as $item)
                            <li class="list-group-item">
                                {{ Carbon\Carbon::parse($item->issued)->toDateTimeString() }}
                                <a href="{{ $item->link[0]->attributes()['href'] ?? '' }}"
                                   target="_blank"
                                   rel="noreferrer noopener">
                                    {{ $item->title }}
                                </a>

                                @unless(empty($item->summary))
                                    <span class="text-muted">『{{ $item->summary }}』</span>
                                @endunless

                                <form action="{{ route('delete-url') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="url" value="{{ $item->link[0]->attributes()['href'] }}">
                                    <input class="btn btn-outline-dark btn-sm" type="submit" value="個別削除">
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @include('home.notifications')

        </div>
    </div>
@endsection
