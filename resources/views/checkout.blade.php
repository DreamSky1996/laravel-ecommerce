@extends('layouts.app')

@section('extra_header')
    <link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet">
@endsection

@section('content')
   <div class="container product_container cart-page">
        <h2 class="my-5 h2" align="left">Checkout</h2>
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">

                <form class="card-body needs-validation" method="POST" action="{{url('checkContinue')}}" novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h3>Billing address</h3>
                    <div class="form-row">
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" id="validationFN" name="validationFN" placeholder="First Name" value=""
                                   required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid First Name.
                            </div>
                        </div>
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" id="validationLN" name="validationLN" placeholder="Last Name" value=""
                                   required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Last Name.
                            </div>
                        </div>
                        <div class="col-md-12 md-form mb-5">
                            <input type="text" class="form-control" id="validationEmail" name="validationEmail" placeholder="Email Address" value=""
                                   required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Email Address.
                            </div>
                        </div>
                        <div class="col-md-12 md-form mb-5">
                            <input type="text" class="form-control" id="validationAddress" name="validationAddress" placeholder="Address" value=""
                                   required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Address.
                            </div>
                        </div>
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" id="validationCity" name="validationCity" placeholder="City" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid City.
                            </div>
                        </div>
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" id="validationProvince" name="validationProvince" placeholder="State" aria-describedby="inputGroupPrepend2"
                                   required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid State.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" placeholder='Zip Code' id="validationPostal_Code" name="validationPostal_Code" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Zip Code.
                            </div>
                        </div>
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" placeholder='Phone' id="validationPhone" name="validationPhone" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Phone.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 md-form ml-4 py-4">
                            <input type="checkbox" class="custom-control-input" name="same_billing_address" id="same_billing_address">
                            <label class="custom-control-label" for="same_billing_address">Shipping address is the same as my Billing address</label>
                        </div>

                    </div>

                    <div class="form-row hideable_shipping_form">
                        <div class="row pt-5 ml-1" >
                            <h3>Shipping address</h3>
                        </div>
                        <div class="col-md-12 md-form mb-5">
                            <input type="text" class="form-control" id="shipping_validationAddress" name="shipping_validationAddress" placeholder="Address" value=""
                                   required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Address.
                            </div>
                        </div>
                        <div class="col-md-12 md-form mb-5">
                            <input type="text" class="form-control" id="shipping_validationCity" name="shipping_validationCity" placeholder="City" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid City.
                            </div>
                        </div>
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" id="shipping_validationProvince" name="shipping_validationProvince" placeholder="State" aria-describedby="inputGroupPrepend2"
                                   required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid State.
                            </div>
                        </div>
                        <div class="col-md-6 md-form mb-5">
                            <input type="text" class="form-control" placeholder='Zip Code' id="shipping_validationPostal_Code" name="shipping_validationPostal_Code" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Zip Code.
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary  btn-block tt-btn" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="col-md-12 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="in-cart-title">In Your cart</span>
                    <span class="badge badge-danger badge-pill">{{$cart->count()}}</span>
                </h4>
                <ul class="list-group mb-3 z-depth-1">
                    @foreach($cart as $key => $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{$item->qty}} x {{$item->name}}</h6>
                            </div>
                            <span class="text-muted">${{$item->price * $item->qty}}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{$totalPrice}}</strong>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection

@section('extra_script')
    <script type="text/javascript">
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);

        })();
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#same_billing_address').on('change', function() {
                if (this.checked) {
                    $('.hideable_shipping_form').hide();
                    $("#shipping_validationAddress").attr("required", false);
                    $("#shipping_validationCity").attr("required", false);
                    $("#shipping_validationProvince").attr("required", false);
                    $("#shipping_validationPostal_Code").attr("required", false);
                } else {
                    $('.hideable_shipping_form').show();
                    $("#shipping_validationAddress").attr("required", true);
                    $("#shipping_validationCity").attr("required", true);
                    $("#shipping_validationProvince").attr("required", true);
                    $("#shipping_validationPostal_Code").attr("required", true);
                }
            });
        });
    </script>
@endsection
