<!DOCTYPE html>
<html lang="en">

@include('Front.partials.head')
<body>
    @include('Front.partials.navbar')
    @yield('content')

    @include('Front.partials.footer')

    @include('Front.partials.bottom')
    <div class="sosialMedia">
        <ul>
{{--            @dd($socials)--}}
            @foreach($socials as $social)
            <li><a href="{{url($social->page_url)}}"><img src="{{\Illuminate\Support\Facades\Storage::url($social->page_icon)}}" alt=""></a></li>

            @endforeach
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{asset('assets/front/js/mainJs.js')}}"></script>
</body>
</html>

