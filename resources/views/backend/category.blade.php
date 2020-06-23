@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Categories Management</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Categories Management</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="basic-form">
                        <form action="{{route('crateCategory')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-label">Category Name</label>
                                        <input type="text" name="categoryName" class="form-control" placeholder="Category 1">
                                    </div>
                                </div>
                                <div class="col-sm-6" style="padding-top: 35px">
                                    <button type="submit" class="btn btn-primary btn-form mr-2">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-padded table-responsive-fix product-details-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>
                                <span>
                                    <button style="border: none; margin-right: 20px; background: none">
                                        <i class="fa fa-pencil color-muted edit_category"></i>
                                    </button>

                                    <button style="border: none; background: none">
                                        <i class="fa fa-close color-danger delete_category"></i>
                                    </button>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal" id="myModalCategory" style="margin-top: 50px">
        <div class="offset-sm-4 col-sm-4">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('saveUpdatedCategory')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-9" style="display: none">
                                <div class="form-group">
                                    <label class="text-label">Category Name</label>
                                    <input type="text" name="categoryId" class="form-control" id="categoryId">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="text-label">Category Name</label>
                                    <input type="text" name="categoryName" class="form-control" id="categoryName">
                                </div>
                            </div>
                            <div class="col-sm-3" style="padding-top: 35px">
                                <button type="submit" class="btn btn-primary btn-form mr-2">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_script')
    <script src="{{asset('assets/js/ajax_cust.js')}}"></script>
@endsection
