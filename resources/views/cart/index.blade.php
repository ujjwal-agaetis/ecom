@extends('layouts.app')
@section('content')
<div class="container">
    <div class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end">
        Review your Cart Items
    </div>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @foreach($cart as $cat => $carts)
            @php $total += $carts['price'] * $carts['quantity'];
            $subtotal = $carts['price'] * $carts['quantity'];
            @endphp
            <tr data-id="{{ $carts['id'] }}">
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{asset('img/category/cloth_default.jpg')}}" width="100" height="100" class="img-responsive" /></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{ $carts['item_name'] }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">{{$carts['price']}}</td>
                <td data-th="Quantity">
                    <input type="number" value="{{ $carts['quantity'] }}" class="form-control quantity update-cart " />
                </td>
                <td data-th="Subtotal" class="text-center">{{$subtotal}} ₹</td>
                <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i>Remove</button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    <h3><strong>{{$total}} ₹</strong></h3>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<form id="place_order_form">
<div class="container">
    <div class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end">
        Billing Details
    </div>
        @csrf
        <div class="col-md-6">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname">
        </div>
        <div class="col-md-6">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname">
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="col-12">
            <label for="address1" class="form-label">Address 1</label>
            <input type="text" class="form-control" id="address1" name="address1" placeholder="1234 Main St">
        </div>
        <div class="col-12">
            <label for="address2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="col-md-6">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        <div class="col-md-4">
            <label for="state" class="form-label">State</label>
            <select id="state" class="form-select" name="state">
                <option value="">Choose...</option>
                <option value="Maharashtra">Maharashtra</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="zip" class="form-label">Zip</label>
            <input type="text" class="form-control" name="zip" id="zip">
        </div>
    <hr class="border border-primary border-3 opacity-75">
    <div class="float-end" style="margin-bottom: 20px;">
        <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
        <button class="btn btn-success place_order" type="submit">Place Order</button>
    </div>
</div>
</form>
<script type="module">
    $(document).ready(function() {
        // Create action for category
        $('#place_order_form').validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                address1: {
                    required: true,
                },
                address2: {
                    required: true,
                },
                city: {
                    required: true,
                },
                state: {
                    required: true,
                },
                zip: {
                    required: true,
                },
                // Add more rules for other form fields as needed
            },
            messages: {
                firstname: {
                    required: "Please enter your First name",
                },
                lastname: {
                    required: "Please enter your Last name",
                },
                email: {
                    required: "Please enter your Email",
                },
                address1: {
                    required: "Address1 field can't be empty",
                },
                address2: {
                    required: "Address2 field can't be empty",
                },
                city: {
                    required: "Please enter your City",
                },
                state: {
                    required: "Please enter your State",
                },
                zip: {
                    required: "Please enter your Zip",
                },
                // Add more custom error messages for other form fields
            },
            submitHandler: function(form) {
                $.ajax({
                    url: '/cart/place_order',
                    type: 'post',
                    data: $('#place_order_form').serialize(),
                    success: function(response) {
                        // Handle the response
                        //console.log(response);
                        alert('Order placed successfully!');
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON.errors) {
                        // Handle validation errors
                        // Display errors to the user
                        const errorMessages = xhr.responseJSON.errors;
                        let errors = 'Following errors found : ' + '\n';
                        for (const field in errorMessages) {
                            errors += errorMessages[field][0] + '\n'; // Get the first error message
                        }
                        alert(errors);
                        }
                    }
                });
            }
        });
    })
    $(".update-cart").change(function(e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "{{ route('update.cart') }}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });
</script>
@endsection