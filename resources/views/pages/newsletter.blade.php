

<div class="mtb-50 mb-md-0">
    <h4 class="p-title"><b>NEWSLETTER</b></h4>
    <p class="mb-20">Subscribe to our newsletter to get notification about new updates,
        information, discount, etc..</p>
    <form class="nwsltr-primary-1" action="/subscribe" method="post">
    {{csrf_field()}}
        <input type="text" placeholder="Your email" name="email">
        <button type="submit"><i class="ion-ios-paperplane"></i></button>
    </form>
</div><!-- mtb-50 -->