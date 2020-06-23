@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Update Profile</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">My Profile</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="card forms-card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">My Information</h4>
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>{{Session::get('message')}}</strong>
                                </div>
                            @endif
                            <div class="basic-form">
                                <form action="{{route('profile')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="currentUser" value="{{Auth::user()->id}}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">First Name</label>
                                                <input type="text" name="firstName" class="form-control" value="{{Auth::user()->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">Last Name</label>
                                                <input type="text" name="lastName" class="form-control" value="{{Auth::user()->last_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Email Address*</label>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control border-right-0" value="{{Auth::user()->email}}" required="">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" id="inputGroupPrepend3"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Phone Number*</label>
                                        <div class="input-group">
                                            <input type="text" name="phoneNumber" class="form-control border-right-0" value="{{Auth::user()->phone}}" required="">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" id="inputGroupPrepend5"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Password*</label>
                                        <input type="password" name="password" class="form-control" placeholder="password" required="">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-form mr-2">Update</button>
                                </form>
                            </div>
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
