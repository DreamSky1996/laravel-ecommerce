@extends('layouts.app')

@section('content')
    <div class="container cart-page">
		<h3><a href="/"><i class="fas fa-chevron-left"></i> Back to Storefront</a></h3>
        <h1>{{$product->product_name}}</h1>
		<p class="lead font-weight-bold cat-pro">Category: <span class="badge badge-danger">{{$product->product_category}}</span></p>
                      
        <section class="text-center mb-4">

            <div class="row wow fadeIn">

                <div class="col-md-6 mb-4">

                    <img src="{{asset('/product_images/'.$product->main_image)}}" class="img-fluid" alt="">

                </div>

                <div class="col-md-6 mb-4">

                    <!--Content-->
                    <div class="p-4">

                        <h2 align="left">${{$product->price}}</h2>

                     
                        <p align="left">{{$product->description}}</p>

{{--                        <form class="d-flex justify-content-left">--}}
{{--                            <!-- Default input -->--}}
{{--                            <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px">--}}
{{--                            <button class="btn btn-primary btn-md my-0 p" type="submit">--}}
{{--                                Add to cart--}}
{{--                                <i class="fas fa-shopping-cart ml-1"></i>--}}
{{--                            </button>--}}
{{--                        </form>--}}

                        <form method="POST" action="{{url('cart')}}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="product_check" align="left">
                                <button type="submit" class="btn btn-primary tt-btn">
                                    <i class="fas fa-shopping-bag"></i> Add to bag</button>
                                <a href="{{url("")}}" class="btn btn-danger btn-md ml-2 tt-btn"><i class="fas fa-shopping-basket"></i> Continue shopping</a>
                            </div>

                        </form>

                    </div>
                    <!--Content-->
                </div>
            </div>

            <hr>

{{--            <div class="row d-flex justify-content-center wow fadeIn">--}}

{{--                <!--Grid column-->--}}
{{--                <div class="col-md-6 text-center">--}}

{{--                    <h4 class="my-4 h4">Additional information</h4>--}}

{{--                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit--}}
{{--                        voluptates,--}}
{{--                        quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>--}}

{{--                </div>--}}
{{--                <!--Grid column-->--}}

{{--            </div>--}}

{{--            <div class="row wow fadeIn">--}}

{{--                <!--Grid column-->--}}
{{--                <div class="col-lg-4 col-md-12 mb-4">--}}

{{--                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="">--}}

{{--                </div>--}}
{{--                <!--Grid column-->--}}

{{--                <!--Grid column-->--}}
{{--                <div class="col-lg-4 col-md-6 mb-4">--}}

{{--                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="">--}}

{{--                </div>--}}
{{--                <!--Grid column-->--}}

{{--                <!--Grid column-->--}}
{{--                <div class="col-lg-4 col-md-6 mb-4">--}}

{{--                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="">--}}

{{--                </div>--}}
{{--                <!--Grid column-->--}}

{{--            </div>--}}
        </section>
    </div>
@endsection
