@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>Staff Zone</h2>
        </div>
        <div class="col-md-6">
            @can('staff-zone-create')
            <a class="btn btn-success  float-end" href="{{ route('staffZones.create') }}"> Create New Staff Zone</a>
            @endcan
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Transport Charges</th>
                    <th width="280px">Action</th>
                </tr>
                @if(count($staffZones))
                @foreach ($staffZones as $staffZone)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $staffZone->name }}</td>
                    <td>{{ $staffZone->description }}</td>
                    <td>{{ $staffZone->transport_charges }}</td>
                    <td>
                        <form action="{{ route('staffZones.destroy',$staffZone->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('staffZones.show',$staffZone->id) }}">Show</a>
                            @can('staff-zone-edit')
                            <a class="btn btn-primary" href="{{ route('staffZones.edit',$staffZone->id) }}">Edit</a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('staff-zone-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">There is no staff zone.</td>
                </tr>
                @endif  
            </table>
            {!! $staffZones->links() !!}
        </div>
    </div>
    
@endsection