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
                    @if($selProduct == null)
                        <div class="card transparent-card pt-5">
                            <div class="card-body p-0">
                                <div class="d-sm-flex justify-content-between mb-3 align-items-center">
                                    <h4 class="card-title">Products Details</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix product-details-table">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Product Name</th>
                                            <th>Main Image</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Inventory</th>
                                            <th>radius for delivery</th>
                                            <th>Action</th>
                                            <th scope="col">Sale Info</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->product_name}}</td>
                                                <td><img src="{{asset('/product_images/'.$product->main_image)}}" width="100" height="70"></td>
                                                <td>{{$product->product_category}}</td>
                                                <td class="text-primary">{{$product->price}}</td>
                                                <td>{{$product->inventory}}</td>
                                                <td>{{$product->geofence}}</td>
                                                <td>
                                            <span>
                                                <a href="{{url("/admin/updateProduct?product_id=$product->id")}}" style="border: none; margin-right: 20px; background: none">
                                                    <i class="fa fa-pencil color-muted"></i>
                                                </a>

                                                <a style="border: none; background: none">
                                                    <i class="fa fa-close color-danger"></i>
                                                </a>
                                            </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="{{url("/admin/ProductSale?product_id=$product->id")}}" style="border: none; background: none">
                                                            <i class="fa fa-info color-muted"> View More</i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <nav>

                                </nav>
                            </div>
                        </div>
                    @else
                        <div class="offset-sm-2 col-sm-8">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="{{asset('/product_images/'.$selProduct->main_image)}}" style="width: 120px; height: 120px" id="productPreview">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('saveUpdatedProduct')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user" value="{{Auth::user()->id}}">

                                        <div class="form-group" style="display: none">
                                            <label class="text-label">Id</label>
                                            <input type="text" name="productId" class="form-control" id="productId" value="{{$selProduct->id}}">
                                        </div>

                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-3 col-form-label text-label">Product Name</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="productName" id="productName" value="{{$selProduct->product_name}}">
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
                                                <textarea class="form-control" id="productDescription" name="description"
                                                          rows="6">{{$selProduct->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-3 col-form-label text-label">Category</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <select class="form-control" name="category" id="category">
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->category_name}}" {{$category->category_name == $selProduct->product_category? "selected": ""}}>{{$category->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-3 col-form-label text-label">Price</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="price" id="productPrice" value="{{$selProduct->price}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-3 col-form-label text-label">Inventory Quantity</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="productInventory"
                                                           name="inventory" value="{{$selProduct->inventory}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-3 col-form-label text-label">mileage radius for delivery</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="geofence"
                                                           name="geofence" value="{{$selProduct->geofence}}">
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
                                                                class="fa fa-upload color-success"></i> </span>Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_script')
    <script src="{{asset('assets/js/ajax_cust.js')}}"></script>
@endsection
