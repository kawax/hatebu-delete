@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <livewire:delete/>

                <livewire:items/>
            </div>
            <div class="col-md-6">
                <livewire:notifications/>
            </div>
        </div>
    </div>
@endsection
