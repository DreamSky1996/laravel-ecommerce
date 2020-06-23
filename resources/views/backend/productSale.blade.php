@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Products Management</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Products Management</a>
                        </li>
                    </ol>
                </div>
            </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="my-5 h2">{{$name}}</h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Order</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $key => $item)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{ $item->product_category }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                {{ $item->address }}
                                            </td>
                                            <td>{{ $item->city  }}</td>
                                            <td>{{ $item->created_at  }}</td>
                                            <td>
                                                <a href="{{url("/admin/orderInfo?order_id=$item->order_id")}}">
                                                    <i class="fa fa-info color-muted"> View </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="pt-md-5">
                                        <td colspan="7">
                                            <a class="btn btn-warning float-right ml-2" href="{{url("/admin/product-manage")}}">Back</a>
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
