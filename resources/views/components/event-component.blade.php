<div class="event">
    <img src="{{asset('images/single-event-page-img2.png')}}" alt="">
    <div class="event-text">
        <h3>HR CAFFE на тема: <p>{{$type->title}}</p></h3>
        <p class="lorem-text">
            <p>{{$type->about}}</p>
            <form action="{{route('show.event' , $type->id)}}" method="GET">
                <button  class='btn' type="submit">Show more</button>
            </form>
        </p>
    </div>
</div>