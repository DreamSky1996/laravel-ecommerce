@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Customer</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">customer</a>
                        </li>
                    </ol>
                </div>
            </div>
            @if($editFlag)
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="card forms-card">
                                <div class="card-body">
                                    {{--							<h4><span class="reg">*</span>Required</h4>--}}
                                    @if(Session::has('message'))

                                        <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>{{Session::get('message')}}</strong>
                                        </div>
                                    @endif
                                    <div class="row my-5" style="justify-content: center; width: 100%">
                                        <h2>Update</h2>
                                    </div>
                                    <div class="basic-form">
                                        <form action="{{route('customerUpdate')}}" method="post" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{$custom->id}}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">First Name</label>
                                                        <input type="text" name="firstName" class="form-control" placeholder="First Name" value="{{$custom->firstName}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Last Name</label>
                                                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="{{$custom->lastName}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Email Address</label>
                                                        <div class="input-group">
                                                            <input type="email" name="email" class="form-control border-right-0" placeholder="Email" value="{{$custom->email}}" required="">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-transparent" id="inputGroupPrepend3"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Phone Number</label>
                                                        <div class="input-group">
                                                            <input type="text" name="phoneNumber" class="form-control border-right-0" placeholder="804-657-9007" value="{{$custom->Phone}}" required="">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-transparent" id="inputGroupPrepend5"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="pt-4 pb-2">Billing Address</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Address</label>
                                                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{$custom->Address}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">City</label>
                                                        <input type="text" name="city" class="form-control" placeholder="City" value="{{$custom->City}}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Province</label>
                                                        <input type="text" name="province" class="form-control" placeholder="Province" value="{{$custom->Province}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Postal Code</label>
                                                        <input type="text" name="postalCode" class="form-control" placeholder="Postal Code" value="{{$custom->PostalCode}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="pt-4 pb-2">Shipping Address</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Address</label>
                                                        <input type="text" name="shipping_address" class="form-control" placeholder="Address" value="{{$custom->shipping_Address}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">City</label>
                                                        <input type="text" name="shipping_city" class="form-control" placeholder="City" value="{{$custom->shipping_City}}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Province</label>
                                                        <input type="text" name="shipping_province" class="form-control" placeholder="Province" value="{{$custom->shipping_Province}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-label">Postal Code</label>
                                                        <input type="text" name="shipping_postalCode" class="form-control" placeholder="Postal Code" value="{{$custom->shipping_PostalCode}}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-form mr-2 mt-3">Update</button>
                                            <a href="{{route('customer-info')}}" class="btn btn-secondary btn-form mr-2 mt-3">Back</a>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            @elseif($cart->count() == 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle" style="min-width: 400px;">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Postal Code</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$customer->firstName}}</td>
                                                <td>{{$customer->lastName}}</td>
                                                <td>{{$customer->email}}</td>
                                                <td>{{$customer->Phone}}</td>
                                                <td>{{$customer->Address}}</td>
                                                <td>{{$customer->City}}</td>
                                                <td>{{$customer->PostalCode}}</td>
                                                <td >

                                                    <a href="{{url("/admin/customerMoreInfo?customer_id=$customer->id")}}" class="btn btn-primary">View</a>
                                                    <a href="{{url("/admin/customerEdit?customer_id=$customer->id")}}" class="btn btn-secondary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="my-5 h2">Customer Info</h1>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <label class="text-label">First Name:&emsp;{{$custom->firstName}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label">Last Name:&emsp;{{$custom->lastName}}</label>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <label class="text-label">Email Address:&emsp;{{$custom->email}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label">Phone Number:&emsp;{{$custom->Phone}}</label>
                                    </div>
                                </div>
                                <h4 class="pt-3">Billing Address</h4>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <label class="text-label">Address:&emsp;{{$custom->Address}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label">City:&emsp;{{$custom->City}}</label>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <label class="text-label">Province:&emsp;{{$custom->Province}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label">Postal Code:&emsp;{{$custom->PostalCode}}</label>
                                    </div>
                                </div>
                                <h4 class="pt-3">Shipping Address</h4>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <label class="text-label">Address:&emsp;{{$custom->shipping_Address}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label">City:&emsp;{{$custom->shipping_City}}</label>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <label class="text-label">State:&emsp;{{$custom->shipping_Province}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label">Postal Code:&emsp;{{$custom->shipping_PostalCode}}</label>
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
                                            <a class="btn btn-warning float-right ml-2" href="{{url("/admin/customer-info")}}">Back</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            @endif


        </div>
    </div>

@endsection
@section('extra_script')
    <script src="{{asset('assets/js/ajax_cust.js')}}"></script>
@endsection
