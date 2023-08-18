@extends('layouts.app')
@section('content')
<div class="container">
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
                        $subtotal =  $carts['price'] * $carts['quantity'];
                    @endphp
        
                    <tr data-id="{{ $carts['id'] }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{asset('img/category/cloth_default.jpg')}}" width="100" height="100" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $carts['item_name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">{{$carts['price']}}</td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $carts['quantity'] }}" class="form-control quantity update-cart "/>
                        </td>
                        <td data-th="Subtotal" class="text-center"></td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i>Remove</button>
                        </td>
                    </tr>
                @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><h3><strong></strong></h3></td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">
                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                    <button class="btn btn-success place_order" type="submit">Place Order</button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script type="module">
  $(document).ready(function() {
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: "{{ route('remove.from.cart')}}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  });
  $(".update-cart").change(function (e) {
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
            success: function (response) {
               window.location.reload();
            }
        });
    });
    $('.place_order').on('click', function() {
      var id = $(this).data('id');
      $.ajax({
        url: '/cart/place_order',
        type: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
        //   "id": id
        id: ele.parents("tr").attr("data-id"),
        },
        success: function(response) {
          // Handle the response
          //console.log(response);
          alert('Order placed successfully!');
          location.reload();
        }
      });
    })
</script>
@endsection