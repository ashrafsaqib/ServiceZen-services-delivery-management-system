@extends('site.layout.app')
<base href="/public">
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 py-5 text-center">
            <h2>Orders</h2>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="text-right mb-2">
        <a class="btn btn-success text-right no-print" href="staffOrderCSV"><i class="fa fa-download"></i> Export Excel</a>
    </div>
    <div class="album bg-light">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>

            @foreach ($orders as $order)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>@currency( $order->total_amount )</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{ route('order.show',$order->id) }}">Show</a>
                    @if(Auth::User()->getRoleNames() == '["Customer"]')
                    @if($order->status == "Pending")
                    <a class="btn btn-sm btn-primary" href="{{ route('order.edit',$order->id) }}">Edit</a>
                    @endif
                    @endif
                    @if($order->status !== "Complete" && Auth::User()->getRoleNames() == '["Staff"]')
                    <a class="btn  btn-sm btn-success" href="{{ route('updateOrderStatus', $order->id) }}?status=Processing">Accept</a>
                    <a class="btn btn-sm btn-danger" href="{{ route('updateOrderStatus', $order->id) }}?status=Canceled">Reject</a>
                    <a class="btn btn-sm btn-success" href="{{ route('updateOrderStatus', $order->id) }}?status=Complete">Complete</a>
                    @endif
                </td>
            </tr>
            @endforeach
            @if(count($orders) == 0)
            <tr>
                <td colspan="7" class="text-center"> There is no Order</td>
            </tr>
            @endif
        </table>
        {!! $orders->links() !!}

    </div>
</div>
@endsection