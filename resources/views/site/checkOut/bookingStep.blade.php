@extends('site.layout.app')
<link href="{{ asset('css/checkout.css') }}?v={{config('app.version')}}" rel="stylesheet">
@section('content')
<div class="album bg-light">
    <div class="container">
        <div id="booking-step">
            <div class="row">
                <div class="col-md-12 py-2 text-center">
                    <h2>Booking</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('error') || Session::has('success'))
                <div class="text-center" style="margin-bottom: 20px;">
                    @if(Session::has('error'))
                    <span class="alert alert-danger" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                    </span>
                    @endif
                    @if(Session::has('success'))
                    <span class="alert alert-success" role="alert">
                        <strong>{{ Session::get('success') }}</strong>
                    </span>
                    @endif
                </div>
                @endif

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
            </div>
            <form id="booking-form" action="draftOrder" method="POST">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3><strong>Services</strong></h3>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Category:</strong>
                            <select class="form-control" name="category_id" id="category">
                                <option value="0">-- All Services -- </option>
                                @foreach ($servicesCategories as $category)
                                <option @if (old('category')==$category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group scroll-div">
                            <strong>Services:</strong>
                            <input type="text" name="search-services" id="search-services" class="form-control" placeholder="Search Services By Name">
                            <table class="table table-striped table-bordered services-table">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                </tr>
                                @foreach ($servicesCategories as $category)
                                @foreach ($category->service as $service)
                                @if ($service->status)
                                <tr>
                                    <td>
                                        <input type="checkbox" @if(in_array($service->id,$serviceIds)) checked @endif class="service-checkbox" name="service_ids[]" value="{{ $service->id }}" data-price="{{ isset($service->discount) ? 
                                        $service->discount : $service->price }}" data-category="{{ $service->category_id }}">
                                    </td>
                                    <td>{{ $service->name }}</td>
    
                                    <td><span class="price">@if(isset($service->discount)) 
                                    @currency($service->discount) @else @currency($service->price) @endif</span></td>
                                    <td>{{ $service->duration }}</td>
                                </tr>
                                @endif
                                @endforeach
                                @endforeach
    
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-group" id="selected-services">
                                <strong>Services:</strong>
                                <table class="table table-striped table-bordered selected-services-table">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                    </tr>
                                    @if(count($selectedServices))
                                    @foreach ($selectedServices as $service)
                                    <tr>
                                        <td>
                                            <input type="checkbox" checked class="selected-service-checkbox" name="selected_service_ids[]" value="{{ $service->id }}" data-price="{{ isset($service->discount) ? 
                                        $service->discount : $service->price }}" data-category="{{ $service->category_id }}">
                                        </td>
                                        <td>{{ $service->name }}</td>
    
                                        <td><span class="price">@if(isset($service->discount)) 
                                    @currency($service->discount) @else @currency($service->price) @endif</span></td>
                                        <td>{{ $service->duration }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    <tr id="no-services" style="display: none;">
                                        <td colspan="4">
                                            <p class="text-center">No Selected Services.</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 py-5 text-center">
                        <h3>Your Current Area: {{ $area }}</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="location-search-wrapper" style="display: none;">
                            <div class="location-container welcome-section">
                                <div id="navbar-location-button" class="location-search lg">
                                    <div class="location-search-left">
                                        <svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6.2468C0 2.80246 2.69144 0 5.99974 0C9.30812 0 12 2.80246 12 6.2468C12 9.56227 6.55647 17.3084 6.32455 17.6364L6.10836 17.9429C6.0828 17.9789 6.04277 18 5.99974 18C5.95736 18 5.91707 17.9789 5.89177 17.9429L5.67545 17.6364C5.44367 17.3084 0 9.56227 0 6.2468ZM8.149 6.2468C8.149 5.01276 7.18511 4.00921 5.99974 4.00921C4.81502 4.00921 3.85047 5.01276 3.85047 6.2468C3.85047 7.48021 4.81506 8.4844 5.99974 8.4844C7.18507 8.4844 8.149 7.48021 8.149 6.2468Z" fill="black" fill-opacity="0.87"></path>
                                        </svg>
                                    </div>
                                    <div class="location-search-input-wrapper">
                                        <input id="searchField" disabled type="text" name="searchField" placeholder="Search for area, street name, landmark..." autocomplete="on" value="{{ old('searchField') ? old('searchField') : $addresses['searchField'] }}" class="location-search-input">
                                    </div>
                                    <div class="location-search-right en">
                                        <div class="location-search-clear en" style="display:none;">
                                            <svg width="15" height="15" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3266 8.99984L16.2251 3.10128C16.5916 2.73512 16.5916 2.14101 16.2251 1.77485C15.8587 1.40838 15.2652 1.40838 14.8987 1.77485L9.00016 7.67342L3.10128 1.77485C2.73481 1.40838 2.14132 1.40838 1.77485 1.77485C1.40838 2.14101 1.40838 2.73512 1.77485 3.10128L7.67373 8.99984L1.77485 14.8984C1.40838 15.2646 1.40838 15.8587 1.77485 16.2248C1.95809 16.4078 2.19823 16.4994 2.43807 16.4994C2.6779 16.4994 2.91804 16.4078 3.10128 16.2245L9.00016 10.326L14.8987 16.2245C15.082 16.4078 15.3221 16.4994 15.5619 16.4994C15.8018 16.4994 16.0419 16.4078 16.2251 16.2245C16.5916 15.8584 16.5916 15.2643 16.2251 14.8981L10.3266 8.99984Z" fill="black" fill-opacity="0.87"></path>
                                            </svg>
                                        </div>
                                        <div class="locate-me" id="manualLocationButton">
                                            <span>Update </span>
                                            <div class="locate-me-icon">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.375 9C12.375 10.8633 10.8633 12.375 9 12.375C7.10508 12.375 5.625 10.8633 5.625 9C5.625 7.10508 7.10508 5.625 9 5.625C10.8633 5.625 12.375 7.10508 12.375 9ZM9 7.3125C8.06836 7.3125 7.3125 8.06836 7.3125 9C7.3125 9.93164 8.06836 10.6875 9 10.6875C9.93164 10.6875 10.6875 9.93164 10.6875 9C10.6875 8.06836 9.93164 7.3125 9 7.3125ZM9 0C9.46758 0 9.84375 0.37793 9.84375 0.84375V2.30238C12.8953 2.68313 15.3176 5.10469 15.6973 8.15625H17.1562C17.6238 8.15625 18 8.53242 18 9C18 9.46758 17.6238 9.84375 17.1562 9.84375H15.6973C15.3176 12.8953 12.8953 15.3176 9.84375 15.6973V17.1562C9.84375 17.6238 9.46758 18 9 18C8.53242 18 8.15625 17.6238 8.15625 17.1562V15.6973C5.10469 15.3176 2.68313 12.8953 2.30238 9.84375H0.84375C0.37793 9.84375 0 9.46758 0 9C0 8.53242 0.37793 8.15625 0.84375 8.15625H2.30238C2.68313 5.10469 5.10469 2.68313 8.15625 2.30238V0.84375C8.15625 0.37793 8.53242 0 9 0ZM3.9375 9C3.9375 11.7949 6.20508 14.0625 9 14.0625C11.7949 14.0625 14.0625 11.7949 14.0625 9C14.0625 6.20508 11.7949 3.9375 9 3.9375C6.20508 3.9375 3.9375 6.20508 3.9375 9Z" fill="#00C3FF"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
                <div class="row">
                    <div id="slots-container" class="col-md-12">
                        @include('site.checkOut.timeSlots')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <h3><strong>Address</strong></h3>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Building Name:</strong>
                            <input required type="text" name="buildingName" id="buildingName" class="form-control" placeholder="Building Name" value="{{ old('buildingName') ? old('buildingName') : $addresses['buildingName'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Flat / Villa:</strong>
                            <input required type="text" name="flatVilla" id="flatVilla" class="form-control" placeholder="Flat / Villa" value="{{ old('flatVilla') ? old('flatVilla') : $addresses['flatVilla'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Street:</strong>
                            <input required type="text" name="street" id="street" class="form-control" placeholder="Street" value="{{ old('street') ? old('street') : $addresses['street'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Area:</strong>
    
                            <select readonly required class="form-control" name="area" id="area">
                                <option value="">-- Select Zone -- </option>
                                    <!-- Loop through the $zones array to generate options -->
                                @foreach ($zones as $zone)
                                <option @if (old('area')==$zone || $addresses['area']==$zone || (session('address') && session('address')['area']==$zone )) selected @endif value="{{ $zone }}">
                                    {{ $zone }}
                                </option>
                                @endforeach
                            </select>
    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>District:</strong>
                            <input required type="text" name="district" id="district" class="form-control" placeholder="District" value="{{ old('district') ? old('district') : $addresses['district'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Landmark:</strong>
                            <input required type="text" name="landmark" id="landmark" class="form-control" placeholder="Landmark" value="{{ old('landmark') ? old('landmark') : $addresses['landmark'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>City:</strong>
                            <input required type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ old('city') ? old('city') : $addresses['city'] }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Custom Location:</strong>
                            <input type="text" name="custom_location" class="form-control" value="{{ old('custom_location') }}" placeholder="32.3335, 65.23223">
                        </div>
                    </div>
                    <input type="hidden" name="latitude" id="latitude" class="form-control" placeholder="latitude" value="{{ old('latitude') ? old('latitude') : $addresses['latitude'] }}">
                    <input type="hidden" name="longitude" id="longitude" class="form-control" placeholder="longitude" value="{{ old('longitude') ? old('longitude') : $addresses['longitude'] }}">
                </div>
    
                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <h3><strong>Personal information</strong></h3>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Name:</strong>
                            <input required type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{  old('name') ? old('name') : $name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Email:</strong>
                            <input required type="email" name="email" id="email" class="form-control" placeholder="abc@gmail.com" value="{{  old('email') ? old('email') : $email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Phone Number:</strong>
                            <input id="number_country_code" type="hidden" name="number_country_code" />
                            <input required type="tel" name="number" id="number" class="form-control" value="{{ old('number') ? old('number') : $addresses['number'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Whatsapp Number:</strong>
                            <input id="whatsapp_country_code" type="hidden" name="whatsapp_country_code" />
                            <input required type="tel" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp') ? old('whatsapp') : $addresses['whatsapp'] }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span style="color: red;">*</span><strong>Gender:</strong><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" {{ old('gender') == 'Male' || $addresses['gender'] == 'Male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="genderMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" {{ old('gender') == 'Female' || $addresses['gender'] == 'Female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="genderFemale">Female</label>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Affiliate Code:</strong>
                            <input type="text" name="affiliate_code" id="affiliate_code" class="form-control" placeholder="Affiliate Code" {{ $affiliate_code ? 'readonly': null}} value="{{ $affiliate_code ?? old('affiliate_code') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Coupon Code:</strong>
                            <div class="input-group">
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Coupon Code" value="{{  old('coupon_code') ? old('coupon_code') : $coupon_code }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="applyCouponBtn">Apply Coupon</button>
                                </div>
                            </div>
                            <div id="responseMessage"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="checkbox" name="update_profile" id="update-profile" checked {{ old('update_profile') ? 'checked' : '' }}>
        
                            <label for="update-profile">
                                Save Data in Profile
                            </label>
                        </div>
                    </div>
                    <span class="invalid-feedback text-center" id="gender-error" role="alert" style="display: none; font-size: medium;">
                        <strong>Sorry, No Male Services Listed in Our Store.</strong>
                    </span>
                    <div class="col-md-12 errorContainer">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-block mt-2 mb-2 btn-success">Next</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="confirm-step" style="display: none;">
            <div class="row">
                <div class="col-md-12 py-2 text-center">
                    <h2>Summary</h2>
                </div>
                <div class="col-md-6 mt-3 mt-3 offset-md-3 ">
                    <h5>Time Slots And Staff</h5>
                    <table class="table">
                        <tr>
                            <td class="text-left"><strong> Time Slot:</strong></td>
                            <td><span id="time_slot"></span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong> Staff:</strong></td>
                            <td><span id="staff_name"></span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Date:</strong></td>
                            <td><span id="selected_date"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 mt-3 mt-3 offset-md-3 ">
                    <h5>Payment Summary</h5>
                    <table class="table">
                        <tr>
                            <td class="text-left"><strong> Service Total:</strong></td>
                            <td><span id="sub_total"></span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong> Coupon Discount:</strong></td>
                            <td><span id="discount"></span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Staff Charges:</strong></td>
                            <td><span id="staff_charges"></span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Transport Charges:</strong></td>
                            <td><span id="transport_charges"></span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Total:</strong></td>
                            <td><span id="total_amount"></span></td>
                        </tr>
                    </table>
                </div>
                <input type="hidden" name="customer_type" id="customer_type">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <strong>Comment:</strong>
                        <textarea id="order_comment" name="order_comment" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button id="confirmOrder" data-order-id="" type="button" class="btn btn-primary">Confirm Order</button><br><br>
                    @auth
                    <a id="orderEdit" href="">
                        <button type="button" class="btn btn-secondary">Edit Order</button>
                    </a>
                    @endauth
                    <a id="orderCancel" href="">
                        <button type="button" class="btn btn-primary">Cancel Order</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="success-step" style="display: none;">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Your order has been placed!</h1>
            </div>
          </section>
          <div class="album py-5 bg-light">
            <div class="container">
                <li>Your order has been successfully processed!</li>
                <li>We have send you email with your login credentials.</li>
                <li>Visit our website for your order detail and book more service</li>
                @auth
                <li>You can view your order history by clicking on <a href="/order">Order History</a>.</li>
                @endauth
                <li>Please direct any questions you have to the store owner.</li>
                <li>Thanks for booking our service!</li>
                <div class="col-md-12 text-right">
                    <a href="/">
                        <button type="button" class="btn btn-primary">Continue</button>
                    </a>
                </div>
            </div>
          </div>
        
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#booking-form").submit(function (event) {
            event.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $(this).serialize() + '&_token=' + csrfToken;
            var url = $(this).attr("action");

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (response) {
                    if (response.errors) {
                        var errorMessages = '<div class="alert alert-danger"><strong>Whoops! There were some problems with your input.</strong><ul>';
                        console.log(response.errors);
                        $.each(response.errors, function (field, errors) {
                            $.each(errors, function (key, error) {
                                errorMessages += '<li>' + error + '</li>';
                            });
                        });

                        errorMessages += '</ul></div>';
                        $('.errorContainer').html(errorMessages);
                    } else {
                        $('#booking-step').hide();
                        $('#confirm-step').show();
                        $('html, body').scrollTop(0);

                        $('#sub_total').text(response.sub_total);
                        $('#discount').text(response.discount);
                        $('#staff_charges').text(response.staff_charges);
                        $('#transport_charges').text(response.transport_charges);
                        $('#total_amount').text(response.total_amount);
                        $('#staff_name').text(response.staff_name);
                        $('#time_slot').text(response.time_slot);
                        $('#selected_date').text(response.date);
                        $('#confirmOrder').attr("data-order-id", response.order_id);
                        $('#customer_type').val(response.customer_type);

                        var editOrderRoute = "{{ route('order.edit', ':orderId') }}";
                        editOrderRoute = editOrderRoute.replace(':orderId', response.order_id);

                        $('#orderEdit').attr('href', editOrderRoute);

                        var cancelOrderRoute = "{{ route('cancelOrder', ':orderId') }}";
                        cancelOrderRoute = cancelOrderRoute.replace(':orderId', response.order_id);

                        $('#orderCancel').attr('href', cancelOrderRoute);
                    }
                },
                error: function (error) {
                    console.log("Error:", error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#confirmOrder").click(function() {
            var order_id =$(this).attr('data-order-id');
            var comment =$("#order_comment").val();
            var customer_type =$("#customer_type").val();
            $.ajax({
                type: "GET",
                url: "{{ route('confirmStep') }}",
                data: {
                    order_id: order_id,
                    comment: comment,
                    customer_type: customer_type,
                },
                success: function(response) {
                    $('#confirm-step').hide();
                    $('#success-step').show();
                    $('html, body').scrollTop(0);
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#applyCouponBtn").click(function() {
            var couponCode = $("#coupon_code").val();
            var selectedServiceIds = [];

            $(".selected-service-checkbox:checked").each(function() {
                selectedServiceIds.push($(this).val());
            });
            $("#responseMessage").html("");
            if(selectedServiceIds.length > 0 && couponCode){
                $.ajax({
                    type: "POST",
                    url: "{{ route('apply.coupon') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        coupon_code: couponCode,
                        selected_service_ids: selectedServiceIds
                    },
                    success: function(response) {
                        if(response.error){
                            $("#coupon_code").val("");
                            $("#responseMessage").append('<p class="coupon-message alert alert-danger">' + response.error + '</p>');
                        }else{
                            $("#responseMessage").append('<p class="coupon-message alert alert-success">' + response.message + '</p>');
                        }
                    },
                    error: function(error) {
                        console.log("Error:", error);
                    }
                });
            }else{
                $("#responseMessage").append('<p class="coupon-message alert alert-danger">There is error with services or coupon input.</p>');
            }
            setTimeout(function() {
                $(".coupon-message").css('display', 'none');
            },6000);

        });
    });
</script>
<script>
    $(document).ready(function () {
        function checkTableResponsive() {
            var viewportWidth = $(window).width();
            var $table = $('.services-table');
    
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
<script>
    $(document).on("change", "#category", function() {
        let value = $(this).val();
        if (value == 0) {
            $(".services-table tr").show();

        } else {
            $(".services-table tr").hide();

            $(".services-table tr").each(function() {
                let $row = $(this);

                let category = $row.find(".service-checkbox").attr("data-category");

                if (category === value) {
                    $row.show();
                }
            });
        }

    });
</script>

<script>
    $(document).on("change", ".service-checkbox", function() {
        let $row = $(this).closest('tr');
        var id = $(this).val();
        var name = $row.find('td:nth-child(2)').text();
        var price = $row.find(".price").text();
        var duration = $row.find("td:last").text();

        if ($(this).prop("checked")) {
            tableHtml = '<tr>';
            tableHtml += '<td>';
            tableHtml += '<input type="checkbox" checked class="selected-service-checkbox" name="selected_service_ids[]" value="' + id + '" data-price="' + price + '">';
            tableHtml += '</td>';
            tableHtml += '<td>' + name + '</td>';
            tableHtml += '<td>' + price + '</td>';
            tableHtml += '<td>' + duration + '</td>';
            tableHtml += '</tr>';

            $('.selected-services-table').append(tableHtml);
        } else {
            $(".selected-services-table tr").each(function() {
                let $row = $(this);

                let selectedName = $row.find("td:nth-child(2)").text();
                if (name === selectedName) {
                    $row.remove();
                }
            });
        }
    });
</script>
<script>
    $(document).on("change", ".selected-service-checkbox", function() {
        let $row = $(this).closest('tr');
        var id = $(this).val();
        var name = $row.find('td:nth-child(2)').text();

        if ($(this).prop("checked") === false) {
            $row.remove();
        }
    });
</script>
<script>
    $(document).ready(function() {
        console.log($('.selected-services-table tr').length);
        if ($('.selected-services-table tr').length > 2) {
            $('#no-services').hide();
        } else {
            $('#no-services').show();
        }

        if ($('.selected-services-table tr').length > 5) {
            $('#selected-services').addClass('scroll-div');
        } else {
            $('#selected-services').removeClass('scroll-div');
        }
    });
</script>
<script>
    $(document).on("change", ".service-checkbox,.selected-service-checkbox", function() {
        console.log($('.selected-services-table tr').length);
        if ($('.selected-services-table tr').length > 2) {
            $('#no-services').hide();
        } else {
            $('#no-services').show();
        }

        if ($('.selected-services-table tr').length > 5) {
            $('#selected-services').addClass('scroll-div');
        } else {
            $('#selected-services').removeClass('scroll-div');
        }
    });
</script>
<script>
    $(document).on("keyup", "#search-services", function() {
        $("#search-services").keyup(function() {
            let value = $(this).val().toLowerCase();

            $(".services-table tr").hide();

            $(".services-table tr").each(function() {
                let $row = $(this);

                let name = $row.find("td:nth-child(2)").text().toLowerCase();

                if (name.indexOf(value) !== -1) {
                    $row.show();
                }
            });
        });
    });
</script>
<script>
    function searchSelectOptions(selectElement, searchString) {
        // Convert the search string to lowercase for case-insensitive comparison
        const searchLower = searchString.toLowerCase();

        // Loop through all the options in the select menu
        for (let i = 0; i < selectElement.options.length; i++) {
            const option = selectElement.options[i];
            const optionValue = option.value.toLowerCase();

            // Check if the search string matches the option value exactly or partially
            if (optionValue === searchLower || optionValue.includes(searchLower)) {
                // Match found, you can perform your desired action here
                // console.log(`Found a match: ${option.value}`);
                return true; // Return true if you want to stop searching after the first match
            }
        }

        // No match found
        // console.log("No match found");
        return false;
    }

    function fillFormAddressFields(place) {
        const buildingNameField = document.getElementById('buildingName');
        const landmarkField = document.getElementById('landmark');
        const areaField = document.getElementById('area');
        const districtField = document.getElementById('district');
        const flatVillaField = document.getElementById('flatVilla');
        const streetField = document.getElementById('street');
        const cityField = document.getElementById('city');
        const latitudeField = document.getElementById('latitude');
        const longitudeField = document.getElementById('longitude');
        const searchField = document.getElementById("searchField");

        const addressComponents = place.address_components;
        // const selectElement = document.getElementById('mySelect');
        // const searchString = "OPT";
        // searchSelectOptions(selectElement, searchString);
        for (let i = 0; i < addressComponents.length; i++) {
            const component = addressComponents[i];
            const types = component.types;

            if (types.includes('premise')) {
                buildingNameField.value = component.long_name;
            } else if (types.includes('point_of_interest')) {
                landmarkField.value = component.long_name;
            } else if (types.includes('neighborhood') || types.includes('sublocality')) {
                areaField.value = component.long_name;
                districtField.value = component.long_name;
            } else if (types.includes('street_number')) {
                flatVillaField.value = component.long_name;
            } else if (types.includes('route')) {
                streetField.value = component.long_name;
            } else if (types.includes('locality')) {
                cityField.value = component.long_name;
            }
            latitudeField.value = place.geometry.location.lat();
            longitude.value = place.geometry.location.lng();
        }
        searchField.value = place["formatted_address"];
    }

    function initMap() {
        $('.location-search-wrapper').show();
        initAutocompleteLocal();
    }

    $(document).ready(function() {
        $("#manualLocationButton").click(function() {
            $("#locationPopup").modal('show');
        });
    });

    function initAutocompleteLocal() {
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('searchField'));
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }

            if (marker) {
                marker.setMap(null);
            }

            map.setCenter(place.geometry.location);
            placeMarker(place.geometry.location);

            fillFormAddressFields(place);
        });
    }
    $(document).on('change', '#zone', function() {
        $('#area').val($(this).val());
    });

    $(document).on('change', '#area', function() {
        $('#zone').val($(this).val());
    });
</script>
<script src="{{ asset('js/checkout.js') }}?v={{config('app.version')}}"></script>
@endsection