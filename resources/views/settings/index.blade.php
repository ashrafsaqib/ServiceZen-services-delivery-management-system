@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 margin-tb">
            <div class="float-start">
                <h2>Setting</h2>
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
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Sr#</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th width="280px">Action</th>
                </tr>
                @if(count($settings))
                @foreach ($settings as $setting)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $setting->key }}</td>
                    <td>{{ substr($setting->value, 0, 50) }}</td>
                    <td>
                        @can('setting-edit')
                        <a class="btn btn-primary" href="{{ route('settings.edit',$setting->id) }}">Edit</a>
                        @endcan
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">There is no Setting.</td>
                </tr>
                @endif
            </table>
            {!! $settings->links() !!}
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        function checkTableResponsive() {
            var viewportWidth = $(window).width();
            var $table = $('table');

            if (viewportWidth < 768) { 
                $table.addClass('table-responsive');
            } else {
                $table.removeClass('table-responsive');
            }
        }

        checkTableResponsive();

        $(window).resize(function () {
            checkTableResponsive();
        });
    });
</script>
@endsection