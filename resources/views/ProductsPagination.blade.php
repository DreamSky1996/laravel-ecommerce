<div class="row">
    @if($sel_option == '0')
        @foreach($categories as $category)
            @foreach($products as $product)
                @if($product->product_category == $category->category_name)
                    <div class="col-md-12 p-4 dash-cat-title">
                        <h2 align="left">{{$category->category_name}}</h2>
                    </div>
                    @break
                @endif
            @endforeach

            @foreach($products as $product)
                @if($product->product_category == $category->category_name)
	
                    <div class="col-md-6">
                        <div class="product_des">
                            <img class="product_img img-fluid"   src="{{asset('/product_images/'.$product->main_image)}}" alt=" {{$product->product_name}}">
                            <div class="product_content">
                                <h2 align="left">{{$product->product_name}}</h2>
                                <div class="product_price" align="left">${{$product->price}}</div>
                                {{-- <div><i>CATEGORY:</i>   {{$product->product_category}}</div>--}}
                                {{--                            <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                                <form method="POST" action="{{url('cart')}}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="product_check" align="left"><button type="submit" class="btn btn-outline-danger product_btn_details"><i class="fas fa-shopping-bag"></i> Add to bag</button></div>
                                </form>
                                <div class="product_details"><a href="{{url('productDetail?product_id='.$product->id)}}" class="btn btn-outline-danger product_btn_details"> Learn More</a></div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
	<div class="col-md-12"><hr class="cat-div"/></div>
        @endforeach
    @else
        @foreach($products as $product)
            <div class="col-md-6">
                <div class="product_des" >
                    <img class="product_img img-fluid"   src="{{asset('/product_images/'.$product->main_image)}}" alt=" {{$product->product_name}}">
                    <div class="product_content">
                        <h2 align="left">{{$product->product_name}}</h2>
                        <div class="product_price" align="left">${{$product->price}}</div>
                        {{-- <div><i>CATEGORY:</i>   {{$product->product_category}}</div>--}}
                        {{--                            <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                        <form method="POST" action="{{url('cart')}}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="product_check" align="left"><button type="submit" class="btn btn-outline-danger product_btn_details"><i class="fas fa-shopping-bag"></i> Add to bag</button></div>
                        </form>
                        <div class="product_details"><a href="{{url('productDetail?product_id='.$product->id)}}" class="btn btn-outline-danger product_btn_details"> Learn More</a></div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
