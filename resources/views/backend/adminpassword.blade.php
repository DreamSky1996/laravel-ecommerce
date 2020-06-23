@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Reset Admin Password</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Reset Admin Password</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <form action="{{route('resetAdminPassword')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-label">New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-label">New Password Confirm</label>
                                <input type="password" name="re_password" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6" style="padding-top: 35px">
                            <button type="submit" class="btn btn-primary btn-form mr-2">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('extra_script')
    <script src="{{asset('assets/js/ajax_cust.js')}}"></script>
@endsection
