@extends('layouts.app')
@section('extra_header')

@endsection
@section('content')
<div class="container cart-page">
<h1>Cart</h1>
    <section class="text-center mb-4">

        <div class="row wow fadeIn">
          
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Item Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $key => $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $item->name }}</td>
                            <td>${{ $item->price }}</td>
                            <td>
                                <a href="{{url("cart?product_id=$item->id&decrease=1")}}" ><i class="fas fa-minus mr-2"></i></a>
                                {{ $item->qty }}
                                <a href="{{url("cart?product_id=$item->id&increment=1")}}"><i class="fas fa-plus ml-2"></i></a>
                            </td>
                            <td>${{ $item->qty*$item->price  }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"><b>Order Total</b></td>
                        <td><b>${{ $totalPrice }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <a class="btn btn-warning float-right ml-2 tt-btn" href="{{url("checkout")}}"><i class="fas fa-shopping-cart"></i> Proceed to checkout</a>
                            <a class="btn btn-primary float-right tt-btn" href="{{url("")}}"><i class="fas fa-shopping-basket"></i> Continue shopping</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection

