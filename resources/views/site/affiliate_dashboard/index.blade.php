@extends('site.layout.app')

@section('content')
    <div class="container">
        <div class="row py-5">
            <div class="col-md-6 d-flex align-items-center">
                <h2>Dashboard</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                @if (auth()->user()->hasRole('Staff'))
                    <a class="btn btn-success" href="/admin">Staff Dashborad</a>
                @endif
            </div>
            <div class="col-md-4 py-2">
                <div class="card">
                    <div class="card-header">Salary</div>
                    <div class="card-body analytic">
                        <i class="fa fa-credit-card"></i>
                        <span class="float-end">Rs.{{ $user->affiliate->fix_salary * $pkrRateValue ?? null }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2">
                <div class="card">
                    <div class="card-header">Total Balance</div>
                    <div class="card-body analytic">
                        <i class="fa fa-credit-card"></i>
                        <span class="float-end">Rs.{{ $total_balance }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2">
                <div class="card">
                    <div class="card-header">Product Sale of {{ now()->format('F') }}</div>
                    <div class="card-body analytic">
                        <i class="fa fa-pkr-sign"></i>
                        <span class="float-end"><b>Rs.</b>{{ $product_sales }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2">
                <div class="card">
                    <div class="card-header">Rs.Total Bonus of {{ now()->format('F') }}</div>
                    <div class="card-body analytic">
                        <i class="fa fa-pkr-sign"></i>
                        <span class="float-end"><b>Rs.</b>{{ $bonus }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2">
                <div class="card">
                    <div class="card-header">Total Order Commission of {{ now()->format('F') }}</div>
                    <div class="card-body analytic">
                        <i class="fa fa-pkr-sign"></i>
                        <span class="float-end"><b>Rs.</b>{{ $order_commission }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2">
                <div class="card">
                    <div class="card-header">Other Income of {{ now()->format('F') }}</div>
                    <div class="card-body analytic">
                        <i class="fa fa-pkr-sign"></i>
                        <span class="float-end"><b>Rs.</b>{{ $other_income }}</span>
                    </div>
                </div>
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

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('affiliateUrl', ['affiliate_id' => auth()->user()->id]) }}">My Affiliate URL</a>
                <p>{{ route('affiliateUrl', ['affiliate_id' => auth()->user()->id]) }}</p>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Code:</strong>
                    <input disabled type="text" name="code" id="code" class="form-control" placeholder="Code"
                        value="{{ $user->affiliate->code ?? null }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Commission:</strong>
                    <input disabled type="text" name="commission" id="commission" class="form-control"
                        placeholder="Commission" value="{{ $user->affiliate->commission ?? null }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Fix Salary:</strong>
                    <input disabled type="text" name="fix_salary" id="fix_salary" class="form-control"
                        placeholder="Fix Salary"
                        value="{{ 'Rs.' . $user->affiliate->fix_salary * $pkrRateValue ?? null }}">
                </div>
            </div>
            <div class="col-md-12">
                <strong>My Customer</strong>
                <table class="table table-striped table-bordered album bg-light">
                    <td class="text-left" colspan="6"><i class="fas fa-filter"></i> Order Filter
                    </td>
                    <tr>
                        <td colspan="6">
                            <form action="{{ route('affiliate_dashboard.index') }}" method="GET"
                                enctype="multipart/form-data">
                                <div class="row d-flex flex-wrap justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <strong>Order Count:</strong>
                                            <div class="input-group me-2">
                                                <input type="number" name="order_count" class="form-control"
                                                    value="{{ $filter_order_count }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Filter by Count</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('affiliate_dashboard.index') }}" method="GET"
                                enctype="multipart/form-data">
                                <div class="row d-flex flex-wrap justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <strong>Date From:</strong>
                                            <input type="date" name="date_from" class="form-control"
                                                value="{{ $filter_date_from }}">
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Date To:</strong>
                                            <input type="date" name="date_to" class="form-control"
                                                value="{{ $filter_date_to }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex flex-wrap justify-content-md-center">
                                    <div class="col-md-6 mt-3">
                                        <div class="col-md-8 offset-md-4">
                                            <div class="d-flex flex-wrap justify-content-md-end">
                                                <div class="col-md-3">
                                                    <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                                                </div>
                                                <div class="col-md-9">
                                                    <button type="submit"
                                                        class="btn btn-block btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </td>
                    </tr>
                </table>
                @if (count($affiliateUser) != 0)
                    <table class="table table-striped table-bordered album bg-light">
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Orders</th>
                            <th>Number</th>
                            <th>Whatsapp</th>
                            <th>Zone</th>
                        </tr>
                        @foreach ($affiliateUser as $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->customer->name ?? '' }}</td>
                                <td>{{ $user->customer->email ?? '' }}</td>
                                <td>{{ $user->order_count }}
                                </td>
                                <td>{{ $user->customer->customerProfile->number ?? '' }}</td>
                                <td>{{ $user->customer->customerProfile->whatsapp ?? '' }}</td>
                                <td>{{ $user->customer->customerProfile->area ?? '' }}</td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $affiliateUser->links() !!}
                @else
                    <div class="text-center">
                        <h4>There are no Customer</h4>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <p>Your current balance is: <b>Rs.{{ $total_balance }}</b></p>
                @if (count($transactions) != 0)
                    <table class="table table-striped table-bordered album bg-light">
                        <tr>
                            <th>Sr#</th>
                            <th>Date Added</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->type }}</td>
                                <td>
                                    @if ($transaction->order_id)
                                        Order ID: #{{ $transaction->order_id }}
                                    @else
                                        Paid Amount
                                    @endif
                                </td>
                                <td>Rs.{{ $transaction->formatted_amount }}</td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $transactions->links() !!}
                @else
                    <div class="text-center">
                        <h4>There are no transactions</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
