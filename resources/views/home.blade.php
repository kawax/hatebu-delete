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
                                <a href="{{ $item->link[0]->attributes()['href'] ?? '' }}" target="_blank">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-primary">
                    <div class="card-header text-white">
                        通知
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($notifications as $notification)
                            <li class="list-group-item">
                                {{ $notification->created_at }}
                                <a href="{{ data_get($notification->data, 'url') }}" target="_blank">
                                    {{ data_get($notification->data, 'title') }}
                                </a>
                                を削除。
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
