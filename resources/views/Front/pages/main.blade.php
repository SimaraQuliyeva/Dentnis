@extends('Front.Layouts.front')

@section('content')
<div class="slider">
    <div id="image-container">
        @foreach($sliders as $slider)
            <img class="mySlides" src="{{Storage::url($slider->image)}}">
        @endforeach
    </div>
    <div class="buttons">
        <button id="prevBtn" onclick="prevImage()"><</button>
        <button id="nextBtn" onclick="nextImage()"> ></button>
    </div>
</div>

    <div class="section1">
        <h1>{{__("Estetik Diş Hekimliği")}}</h1>
        <div class="row">
            @foreach($quotes as $quote)
                <div class="col">
                    <img src="{{ Storage::url($quote->image) }}" alt="Quote Image">

                    <p class="title">{{$quote->translations->first()->title}}</p>
                    <p>{{$quote->translations->first()->description}}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- sponsor slider start -->
{{--    <div class="containerSponsor">--}}
{{--        <div class="swiper mySwiper my">--}}
{{--            <div class="swiper-wrapper">--}}
{{--                @foreach($sponsors as $sponsor)--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <div class="ust-padding">--}}
{{--                            <div class="for-padding">--}}
{{--                                <img src="{{ Storage::url($sponsor->image) }}" alt="Sponsor Image">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="swiper-pagination"></div>--}}
{{--        <div class="swiper-button-next"></div>--}}
{{--        <div class="swiper-button-prev"></div>--}}
{{--    </div>--}}



@if ($sponsors->isNotEmpty())

    <div class="containerSponsor">
        <div class="swiper mySwiper my">
            <div class="swiper-wrapper">
                @foreach($sponsors as $sponsor)
                    <div class="swiper-slide">
                        <div class="ust-padding">
                            <div class="for-padding">
                                <img src="{{Storage::url($sponsor->image)}}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
@endif
    <!-- sponsor slider end -->
    <!-- YouTube start-->
    <div class="youtube">
        @foreach($youtube as $video)
            <iframe src="{{$video->url}}"
                    title="Dentnis İmplantoloji ve Estetik Diş Kliniği" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        @endforeach
    </div>
    <!-- YouTube end-->

    <!-- Ekibimiz start -->
    <div class="ekibimiz-container">
        <h1>{{__("Ekibimiz")}}</h1>
        <div class="swiper-2 mySwiper my2">
            <div class="swiper-wrapper">
                @foreach($teams as $team)
                    <div class="swiper-slide mz">
                        {{--                         @dd($team->translations->first()->position)--}}
                        <div class="top-section">
                            <img src="{{ Storage::url($team->image) }}" alt="Team Image">
                        </div>
                        <div class="bottom-section">
                            <h3 class="doctor-name">{{$team->title}}</h3>
                            <div class="ekibimiz-line"></div>
                            <h5 class="doctor-position">{{$team->translations->first()->position}}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <!--Ekibimiz end-->

    <!--Estetik dis hekimligi start-->
    <div class="section2">
        <h2>{{__("Estetik Diş Hekimliği")}}</h2>
        <div class="container1">
            @foreach($blogs as $blog)
                <div class="image-container">
                    <img src="{{ Storage::url($blog->image) }}" alt="Image"
                         style="width: 100%; height: 100%;">
                    <div class="image-overlay"></div>
                    <div class="image-title">{{$blog->translations->first()->title}}</div>
                    <div class="underline"></div>
                </div>
            @endforeach
        </div>
    </div>
    <!--Estetik dis hekimligi end-->

    <!--Article section start-->
    <div class="articles">
        <h2>{{__("Makaleler")}}</h2>
        <div class="container1">
            @for ($i = 0; $i < 3; $i++)
                @php
                    $blog = $blogs[$i] ?? null;
                @endphp
                {{--                @dd($blog)--}}
                <div class="col">
                    <div class="image">
                        <img src="{{ Storage::url($blog->image) }}" alt="Image">
                    </div>
                    <div class="content">
                        <h2>{{$blog->translations->first()->title}}</h2>
                        {{--                                            <p>{!! $blog->translations->first()->description!!} […]</p>--}}
                        <p>{!! Str::limit(strip_tags($blog->translations->first()->description), 200) !!} […]</p>
                        <button><a href="#">{{__("Devamını oku")}}</a></button>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <!--Article section end-->

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>
@endsection
