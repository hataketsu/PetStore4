<div class="ui container">
    <div id="caro">
        @foreach(\App\Ads::all() as $ads)
            <a href="{{$ads->url}}" style="padding: 4px">
                <img src="/images/{{$ads->image}}" style="width: 100%">
            </a>
        @endforeach
    </div>

    <div class="ui divider"></div>
</div>
