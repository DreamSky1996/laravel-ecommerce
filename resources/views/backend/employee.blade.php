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
                    <h4>Employees</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Users/Employees</a>
                        </li>
                    </ol>
                </div>
            </div>
            @if($employee == null)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle" style="min-width: 400px;">
                                        <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Last Login</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td>{{$employee->id}}</td>
                                                <td>{{$employee->first_name}}</td>
                                                <td>{{$employee->last_name}}</td>
                                                <td>{{$employee->email}}</td>
                                                <td>{{$employee->phone}}</td>
                                                <td>{{$employee->role!="Admin"?"Crew ":""}}{{$employee->role}}</td>
                                                <td>{{$employee->loginTime?$employee->loginTime:""}}</td>
                                                @if($employee->role == 'Admin')
                                                    <td>

                                                    </td>
                                                @else
                                                    <td>
                                                <span>
                                                    <a href="{{url("/admin/employeeMoreInfo?employee_id=$employee->id")}}" style="border: none; margin-right: 20px; background: none">
                                                        <i class="fa fa-pencil color-muted"></i>
                                                    </a>

                                                    <a style="border: none; background: none">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </a>
                                                </span>
                                                    </td>
                                                @endif
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
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{route('saveUpdatedUser')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6" style="display: none">
                                            <div class="form-group">
                                                <label class="text-label">Id</label>
                                                <input type="text" name="userId" class="form-control" id="userId" value="{{$employee->id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">First Name</label>
                                                <input type="text" name="firstName" class="form-control" id="firstName" value="{{$employee->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">Last Name</label>
                                                <input type="text" name="lastName" class="form-control" id="lastName" value="{{$employee->last_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Email Address*</label>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control border-right-0" required="" id="email" value="{{$employee->email}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" id="inputGroupPrepend3"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Phone Number*</label>
                                        <div class="input-group">
                                            <input type="text" name="phoneNumber" class="form-control border-right-0" required="" id="phoneNumber" value="{{$employee->phone}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" id="inputGroupPrepend5"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Employee role*</label>
                                        <select class="form-control" name="role" id="role">
                                            {{--<option class="text-muted" disabled="" selected="" style="display: none">Select User role</option>--}}
                                            <option value="customer">Customer</option>
                                            <option value="member">Crew Member</option>
                                            <option value="leader">Crew Leader</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Lat/Lang</label>
                                        <div class="input-group">
                                            <input type="text" name="lat" class="form-control" id="lat" value="{{$employee->lat}}">
                                        </div>
                                    </div>

									<div class="form-group">
                                        <label class="text-label" for="address_address">Address</label>
                                        <input type="text" id="address-input" name="address_address" class="form-control map-input">
                                        <input type="hidden" name="address_latitude" id="address-latitude" value="{{explode (",", $employee->lat)[0]}}" />
                                        <input type="hidden" name="address_longitude" id="address-longitude" value="{{explode (",", $employee->lat)[1]}}" />
                                    </div>
                                    <div id="address-map-container" style="width:100%;height:400px; ">
                                        <div style="width: 100%; height: 100%" id="address-map"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-form mr-2 mt-3"><i class="fas fa-location-arrow"></i> Update Current Location</button>
                                </form>
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
