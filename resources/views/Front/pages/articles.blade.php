@extends('Front.Layouts.front')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div class="all">
        <div class="under-nav">
            <div class="content">
                <div class="top-title">
                    {{__("Makaleler")}}
                </div>
                <div class="bottom-title">
                    <div class="bottom-left"><a href="">{{__("Anasayfa")}}</a></div>
                    <div class="icon"> ></div>
                    <div class="bottom-right"><a href="">{{__("Makaleler")}}</a></div>
                </div>
            </div>
        </div>


        <div class="container-article">
            <div class="all-article">
{{--                @for($i = 0; $i < 12; $i++)--}}
                            @foreach($blogs as $blog)
                    <div class="card" >
{{--                        style="width: 18rem;"--}}
                        <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title">{{$blog->translations->first()->title}}</h3>
                            <p class="card-text"><span>{!! Str::limit(strip_tags($blog->translations->first()->description), 200) !!}</span></p>
                            <a href="#" class="btn btn-primary">{{__("Devamını Oku")}}</a>
                        </div>
                    </div>
                        @endforeach
{{--                @endfor--}}

            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/articles.css')}}">
@endpush
