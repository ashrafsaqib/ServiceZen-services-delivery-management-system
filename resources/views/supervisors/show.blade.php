@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 margin-tb">
            <div class="float-start">
                <h2> Show Supervisor</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $supervisor->name }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $supervisor->email }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Roles:</strong>
                @if(!empty($supervisor->getRoleNames()))
                    @foreach($supervisor->getRoleNames() as $v)
                        <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection