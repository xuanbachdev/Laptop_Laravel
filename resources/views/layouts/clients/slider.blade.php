<div class="col-12">
    <div class="banner_slider slider_two">
        <div class="slider_active owl-carousel">
            @php
                $count=1;
            @endphp
            @foreach ($slider as $key => $sliders)
                @if ($count<=5)
                    <div class="single_slider m-5" style="background-image: url({{$sliders->image_path}})">
                        <div class="slider_content">
                            <div class="slider_content_inner">
                                <h1>{{ $sliders->name }}</h1>
                                <p>{{ $sliders->content }}</p>
                                <a href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                    @php
                        $count++;
                    @endphp
                @else
                    @break
                @endif
            @endforeach
        </div>
    </div>
</div>
