@extends('layouts.app')
@section('extra_header')
  <!---  <link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet">--->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{asset('assets/js/ajax_front.js')}}"></script>
@endsection

@section('content')
<div class="mast_img">
	<img src="/assets/home/home_mast.jpg" />
	<h1>Truetimber Store</h1>
</div>

<div class="container product_container">

    <div class="product_search">
		<div class="card">
        <form>
            <div class="form-row align-items-center">
                <div class="col-sm-12 col-md-4 my-1">

                    <select class="custom-select mr-sm-2 categorySelect" id="inlineFormCustomSelect">
                        <option value="0" selected>Select by Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 my-1 py-3">
                    <input id="searchKey" type="text" class="ml-lg-5 p-1 pl-lg-3 rounded" style="width:100%" placeholder="Type to Search" >
                </div>
                <div class="col-sm-12 col-md-2 pl-lg-5 my-1">
                    <a style="width: 100%" class="btn btn-primary product_btn_details" id="SearchClick">Search</a>
                </div>
            </div>
        </form>
    </div>
	 </div>

    <section class="text-center mb-4" id="product_data">
        @include('ProductsPagination')
    </section>
</div>
@endsection

