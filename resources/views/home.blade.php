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
                        @each('home.entry', $feed->entry, 'item')
                    </ul>
                </div>
            </div>

            @include('home.notifications')

        </div>
    </div>
@endsection
