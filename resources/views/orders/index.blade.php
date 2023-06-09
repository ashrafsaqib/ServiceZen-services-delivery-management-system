    @extends('layouts.app')
    @section('content')
    <div class="row">
        <div class="col-md-12 margin-tb">
            <div class="float-start">
                <h2>Orders</h2>
            </div>
            <div class="float-end">
                @can('order-download')
                <a class="btn btn-success float-end no-print" href="orderCSV"><i class="fa fa-download"></i> Export XSL</a>
                <a class="btn btn-danger float-end no-print" target="_blank" href="orderPrint" style="margin-right: 10px;"><i class="fa fa-print"></i> Download PDF</a>
                @endcan
            </div>
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
        <div class="col-md-9">
            <table class="table table-bordered table-responsive">
                <tr>
                    <th>No</th>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Staff</th>
                    <th>Data \ Time Slot</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Comment</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                @if(count($orders))
                @foreach ($orders as $order)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>#{{ $order->id }}</td>

                    <td>@if($order->customer){{ $order->customer->name }}@endif</td>
                    <td>@if($order->staff){{ $order->staff->user->name }}@endif</td>
                    <td>{{ $order->date }} \ @if($order->time_slot) {{ date('h:i A', strtotime($order->time_slot->time_start)) }} -- {{ date('h:i A', strtotime($order->time_slot->time_end)) }} @endif</td>
                    <td>@currency($order->total_amount)</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->order_comment }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <form action="{{ route('orders.destroy',$order->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('orders.show',$order->id) }}">Show</a>
                            @can('order-edit')
                            <a class="btn btn-primary" href="{{ route('orders.edit',$order->id) }}">Edit</a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('order-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="11" class="text-center"> There is no Order</td>
                </tr>
                @endif
            </table>
            {!! $orders->links() !!}
        </div>
        <div class="col-md-3">
            <h3>Filter</h3>
            <hr>
            <form action="orderFilter" method="GET" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Appointment Date:</strong>
                            <input type="date" name="appointment_date" class="form-control" value="{{ $filter['appointment_date'] }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Staff:</strong>
                            <select name="staff_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($users as $staff)
                                @if($staff->getRoleNames() == '["Staff"]')
                                @if($staff->id == $filter['staff'])
                                <option value="{{ $staff->id }}" selected>{{ $staff->name }}</option>
                                @else
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Status:</strong>
                            <select name="status" class="form-control">
                                <option value="">Select</option>
                                @foreach ($statuses as $status)
                                @if($status == $filter['status'])
                                <option value="{{ $status }}" selected>{{ $status }}</option>
                                @else
                                <option value="{{ $status }}">{{ $status }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Affiliate:</strong>
                            <select name="affiliate_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($users as $affiliate)
                                @if($affiliate->getRoleNames() == '["Affiliate"]')
                                @if($affiliate->id == $filter['affiliate'])
                                <option value="{{ $affiliate->id }}" selected>{{ $affiliate->name }}</option>
                                @else
                                <option value="{{ $affiliate->id }}">{{ $affiliate->name }}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Customer:</strong>
                            <select name="customer_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($users as $customer)
                                @if($customer->getRoleNames() == '["Customer"]')
                                @if($customer->id == $filter['customer'])
                                <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                                @else
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Payment Method:</strong>
                            <select name="payment_method" class="form-control">
                                <option value="">Select</option>
                                @foreach ($payment_methods as $payment_method)
                                @if($payment_method == $filter['payment_method'])
                                <option value="{{ $payment_method }}" selected>{{ $payment_method }}</option>
                                @else
                                <option value="{{ $payment_method }}">{{ $payment_method }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Date Added:</strong>
                            <input type="date" name="created_at" class="form-control" value="{{ $filter['created_at'] }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection