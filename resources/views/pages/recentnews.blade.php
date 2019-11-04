
<div class="col-md-12 col-lg-8">
    <h4 class="p-title"><b>RECENT NEWS</b></h4>
    <div class="row">
    
        <div class="col-sm-6">
            <img src="{{$recentPosts->first()->getImage()}}" alt="">
            <h4 class="pt-20"><a href="#"><b>{{$recentPosts->first()->title}}</b></a></h4>
            <ul class="list-li-mr-20 pt-10 pb-20">
                <li class="color-lite-black">by <a href="#" class="color-black"><b>{{$recentPosts->first()->author->name}},</b></a>
                {{$recentPosts->first()->getDate()}}</li>
                <li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i><b>30,190</b></li>
                <li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i><b>47</b></li>
            </ul>
            <p>{{$recentPosts->first()->content}}</p>
        </div><!-- col-sm-6 -->
           
         
        <div class="col-sm-6">     
         @foreach($recentPosts->offset(1)->take(4)->get() as $post)        
            <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                <div class="wh-100x abs-tlr"><img src="{{$post->getImage()}}" alt=""></div>
                <div class="ml-120 min-h-100x">
                    <h5><b>{{$post->title}}</b></h5>
                    <h6 class="color-lite-black pt-10">by <span class="color-black"><b>{{$post->author->name}},</b></span> {{$post->getDate()}}</h6>
                </div>
            </a><!-- oflow-hidden -->
            @endforeach
        </div><!-- col-sm-6 -->
         
        
    </div><!-- row -->
    
    <a class="dplay-block btn-brdr-primary mt-20 mb-md-50" href="/list"><b>VIEW MORE CRYPTO MINING EVENTS</b></a>
</div><!-- col-md-9 -->