@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="padding-top: 20px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>User Panel</h2>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4><i>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</i> is logged in!</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
