@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <h4 class="p-title"><b>ALL NEWS</b></h4>
            <div class="row">
                <div class="pl-20 pl-md-0">
                @foreach($posts as $post)
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                    <div class="wh-100x abs-tlr"><img src="{{$post->getImage()}}" alt=""></div>
                    <div class="ml-120 min-h-100x">
                        <h5><b>{{$post->title}}</b></h5>
                        <h6 class="color-lite-black pt-10">by <span class="color-black"><b>{{$post->author->name}},</b></span> {{$post->getDate()}}</h6>
                    </div>
                    </a><!-- oflow-hidden -->
                @endforeach    
                </div>
                
                
            </div>
            {{$posts->links('paginate.paginate')}} 
        </div>
        
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
    

