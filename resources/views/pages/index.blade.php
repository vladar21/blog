@extends('layouts.layout')

@section('content')

<div class="container">

    <div class="row">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
    
        @include('pages.recentnews')
        
        <div class="d-none d-md-block d-lg-none col-md-3"></div>
        <div class="col-md-6 col-lg-4">
            <div class="pl-20 pl-md-0">
                
                @include('pages.popular')

                @include('pages.newsletter')
                
            </div><!--  pl-20 -->
        </div><!-- col-md-3 -->
        
    </div><!-- row -->
</div><!-- container -->
@endsection