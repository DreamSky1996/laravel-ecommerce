@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card transparent-card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mt-2">Recent Orders List</h4>
                            <div class="table-action float-sm-right mt-6">
                                <select class="selectpicker show-tick" data-width="200">
                                    <option selected="selected" value="0">Last 30 Days</option>
                                    <option value="1">Last Month</option>
                                    <option value="2">Last 6 Months</option>
                                    <option value="3">Last Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body p-0" id="table_data">
                            @include('backend/pagination_orders')
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
