@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 margin-tb">
            <div class="pull-left">
                <h2> Show Staff Zone</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $staffZone->name }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $staffZone->description }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Transport Charges:</strong>
                {{ $staffZone->transport_charges }}
            </div>
        </div>
    </div>
</div>
@endsection