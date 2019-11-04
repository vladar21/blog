<div class="mtb-50">
<h4 class="p-title mt-30"><b>POPULAR NEWS</b></h4>
<div class="row">
@foreach($popularPosts->take(2) as $post)
	<!--main content start-->	
    <div class="col-sm-6">
        <img src="{{$post->getImage()}}" alt="">
        <h4 class="pt-20"><a href="#"><b>{{$post->title}}</b></a></h4>
        <ul class="list-li-mr-20 pt-10 mb-30">        
            <li class="color-lite-black">by <a href="#" class="color-black"><b>{{$post->author->name}},</b></a><br>
            {{$post->getDate()}}</li>
            <li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
            <li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>47</li>
        </ul>
    </div><!-- col-sm-6 -->
@endforeach    


<!-- end main content-->

    

    
</div><!-- row -->
</div>