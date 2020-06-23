@extends("layouts.backend")
@section('extra_header')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initializeMap&libraries=places" async defer></script>
    <script src="{{asset('assets/js/mapInput.js')}}"></script>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Add User</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Add New User</a>
                        </li>
                    </ol>
                </div>
            </div>
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
                            @if(Session::has('warning'))

                                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>{{Session::get('warning')}}</strong>
                                </div>
                            @endif
                            <div class="basic-form">
                                <form action="{{route('add-user')}}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">First Name</label>
                                                <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">Last Name</label>
                                                <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-label">Email Address</label>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control border-right-0" placeholder="Email" required="">
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
                                            <input type="text" name="phoneNumber" class="form-control border-right-0" placeholder="804-657-9007" required="">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" id="inputGroupPrepend5"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
										</div>
                                    </div>
									</div>
										<div class="row">
											  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-label">Create Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="password" required="">
                                    </div>
											</div>
										  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-label">Employee role</label>
                                        <select class="form-control" name="role">
{{--                                            <option class="text-muted" disabled="" selected="" style="display: none">Select Employee role</option>--}}
                                            <option value="member" selected>Crew Member</option>
                                            <option value="leader">Crew Leader</option>
                                        </select>
                                    </div>
											</div>

									</div>
                                    <div class="form-group">
                                        <label class="text-label" for="address_address">Address/Current Location</label>
                                        <input type="text" id="address-input" name="address_address" class="form-control map-input" required>
                                        <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                                        <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                                    </div>
                                    <div id="address-map-container" style="width:100%;height:400px; ">
                                        <div style="width: 100%; height: 100%" id="address-map"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-form mr-2 mt-3">Create New Employee</button>
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
