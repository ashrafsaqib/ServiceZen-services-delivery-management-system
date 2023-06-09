@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 margin-tb">
            <div class="float-start">
                <h2> Show appointment</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $appointment->service->name }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Staff:</strong>
                @if(isset($appointment->serviceStaff->name))
                    {{ $appointment->serviceStaff->name }}
                @else
                    N\A
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Customer:</strong>
                {{ $appointment->order->customer->name }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                {{ $appointment->order->date }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Time:</strong>
                {{ date('h:i A', strtotime($appointment->order->time_slot->time_start)) }} -- {{ date('h:i A', strtotime($appointment->order->time_slot->time_end)) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                {{ $appointment->price }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $appointment->status }}
            </div>
        </div>
    </div>
@endsection