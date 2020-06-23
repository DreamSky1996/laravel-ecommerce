@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="my-5 h2">Customer Info</h1>
                            <div class="row ">
                                <div class="col-md-6">
                                    <label class="text-label">First Name:&emsp;{{$customer->firstName}}</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-label">Last Name:&emsp;{{$customer->lastName}}</label>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <label class="text-label">Email Address:&emsp;{{$customer->email}}</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-label">Phone Number:&emsp;{{$customer->Phone}}</label>
                                </div>
                            </div>
                            <h4 class="pt-3">Billing Address</h4>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <label class="text-label">Address:&emsp;{{$customer->Address}}</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-label">City:&emsp;{{$customer->City}}</label>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <label class="text-label">Province:&emsp;{{$customer->Province}}</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-label">Postal Code:&emsp;{{$customer->PostalCode}}</label>
                                </div>
                            </div>
                            <h4 class="pt-3">Shipping Address</h4>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <label class="text-label">Address:&emsp;{{$customer->shipping_Address}}</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-label">City:&emsp;{{$customer->shipping_City}}</label>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <label class="text-label">State:&emsp;{{$customer->shipping_Province}}</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-label">Postal Code:&emsp;{{$customer->shipping_PostalCode}}</label>
                                </div>
                            </div>
                            <h2 class="my-5 h2">Products Summary</h2>
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
                                            {{ $item->qty }}
                                        </td>
                                        <td>${{ $item->qty*$item->price  }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4"><b>Order Total</b></td>
                                    <td><b>$ {{$total_price}}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <a class="btn btn-warning float-right ml-2" href="{{url("/admin/orders")}}">Back</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
@section('extra_script')
    <script src="{{asset('assets/js/ajax_cust.js')}}"></script>
@endsection
