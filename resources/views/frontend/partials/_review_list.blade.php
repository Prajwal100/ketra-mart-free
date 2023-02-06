@if(count($reviews)>0)
    @foreach($reviews as $review)
        <div class="review-item">
            <div class="rating">
                @for($i=0; $i<5;++$i)
                    @if($i< $review->rate)
                        @if($review->rate==$i+.5)
                            <i style="  color: #ffe28a;" class='bx bxs-star-half'></i>
                        @else
                            <i class='bx bxs-star'></i>
                        @endif
                    @else
                        <i class='bx bx-star'></i>
                    @endif
                @endfor
            </div>
            <div class="user_name_date">
                <h3>{{$review->name}}</h3>
                <span class="text-muted">{{\Carbon\Carbon::parse($review->created_at)->format('d.m.Y')}}</span>
            </div>
            <p>{{$review->review}} </p>
        </div>
    @endforeach
@endif
