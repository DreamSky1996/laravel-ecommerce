@extends('layouts.app')

@section('extra_header')

    <link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
        .panel-title {
            display: inline;
            font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
    </style>

@endsection

@section('content')
   <div class="container product_container cart-page"> 
    <div class="wow fadeIn">
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        <h2 class="my-5 h2 text-center">Payment</h2>
        <div class="row pl-lg-5 pr-lg-5 ">
            <div class="col-md-12 mb-5 pl-lg-5 pr-lg-5">
                <div class="card">


                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                          data-cc-on-file="false"
                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                          id="payment-form">
                        @csrf

                        <div class='form-row row pl-2 pr-2'>
                            <div class='col-md-12 md-form  required'>
                                <input type='text' size='4' placeholder='Name on Card' class='form-control ' />
                            </div>
                        </div>

                        <div class='form-row row pl-2 pr-2'>
                            <div class='col-md-12 md-form  required'>
                                <input type='text' autocomplete='off' size='20' placeholder='Card Number'  class='form-control card-number' />
                            </div>
                        </div>

                        <div class='form-row row pl-2 pr-2'>
                            <div class='col-sm-4 col-md-4 md-form  required'>
                                <input type='text' size='4' placeholder='CVC(ex. 311)'  class='form-control card-cvc' />
                            </div>
                            <div class='col-sm-4 col-md-4 md-form  required'>
                                <input type='text' size='2' placeholder='Expiration Month(MM)'  class='form-control card-expiry-month' />
                            </div>
                            <div class='col-sm-4 col-md-4 md-form expiration required'>
                                <input type='text' size='4' placeholder='Expiration Year(YYYY)'  class='form-control card-expiry-year' />
                            </div>
                        </div>

                        <div class='form-row row '>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-12 ">
                                <button class="btn btn-primary btn-block tt-btn" type="submit">Pay Now</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-12 mb-4 pl-lg-5 pr-lg-5">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
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
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;
                $errorMessage.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('d-none');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    console.log($form.data('stripe-publishable-key'));
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    console.log($('.card-number').val());
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endsection
