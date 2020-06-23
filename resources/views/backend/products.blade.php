@extends("layouts.backend")
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Product</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Product</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card forms-card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Product</h4>
                            @if(Session::has('message'))

                                <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>{{Session::get('message')}}</strong>
                                </div>
                            @endif
                            <div class="basic-form">
                                <form action="{{route('product-create')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user" value="{{Auth::user()->id}}">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label text-label">Product Name</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="productName"
                                                       placeholder="product name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label text-label">MainImage</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="mainImage"
                                                       placeholder="main image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label text-label">Description</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <textarea class="form-control" id="textarea1" name="description"
                                                          rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label text-label">Category</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select class="form-control" name="category">
                                                    <option class="text-muted" disabled="" selected="" style="display: none">Select Product Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label text-label">Price</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="price"
                                                       placeholder="ex.$249">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label text-label">Inventory Quantity</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="inventory quantity"
                                                       name="inventory">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label text-label">Image Gallery</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="file" name="galleries[]"
                                                       placeholder="images for gallery" multiple/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-label">Upload</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-rounded btn-success"><span
                                                            class="btn-icon-left text-success"><i
                                                                class="fa fa-upload color-success"></i> </span>Upload
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
