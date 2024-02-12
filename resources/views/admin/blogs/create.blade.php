@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="bi bi-table"></i> Basic Tables</h1>
                    <p>Basic bootstrap tables</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active"><a href="#">Simple Tables</a></li>
                </ul>
            </div>
            @php
                $categoryTranslation =[];
                   foreach ($categories as $category){
                    $categoryTranslation[] = $category->translations
                        ->where('language.lang', 'tr')->first();
                    }
//                                    dd($categories);
//                                       echo '<pre>';
//                                       print_r($categoryTranslation);
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Responsive Table</h3>

                        <div class="table-responsive">
                            <div class="container-fluid">
                                <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>

                                    @foreach(config('app.languages') as $index=>$lang)
                                        <div class="mb-3" id="">
                                            <label for="title_{{ $lang }}" class="form-label">Blog Title ({{ strtoupper($lang) }})</label>
                                            <input type="text" class="form-control" id="title_{{ $lang }}" name="title_{{ $lang }}">
                                        </div>

                                        <div class="mb-3" >
                                            <label for="description_{{ $lang }}" class="form-label">Blog Description ({{ strtoupper($lang) }})
                                            <textarea class="form-control" id="editor_{{ $lang }}"  name="description_{{ $lang }}" ></textarea></label>
                                            <script>
                                                ClassicEditor
                                                    .create( document.querySelector( '#editor_{{ $lang }}' ) )
                                                    .then( editor => {
                                                        console.log( editor );
                                                    } )
                                                    .catch( error => {
                                                        console.error( error );
                                                    } );
                                            </script>
                                        </div>
                                    @endforeach
                                    <label>Category</label>
                                    <select name="category" class="form-control" id="categorySelect">
                                        <option value="">Select a category</option>
                                        @foreach($categoryTranslation as $item)
                                            @foreach($categories as $category)
                                                @if($category->id == $item->category_id)
                                                    <option value="{{$category->id ?? ''}}">{{ $item->name ?? '' }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                            </div>

{{--                            <div id="summernote"><p>Hello Summernote</p></div>--}}
{{--                            <script>--}}
{{--                                $(document).ready(function() {--}}
{{--                                    $('#summernote').summernote();--}}
{{--                                });--}}
{{--                            </script>--}}
{{--                            <script>--}}
{{--                                $('#summernote').summernote({--}}
{{--                                    placeholder: 'Description blogs',--}}
{{--                                    tabsize: 5,--}}
{{--                                    height: 700,--}}
{{--                                    toolbar: [--}}
{{--                                        ['style', ['style']],--}}
{{--                                        ['font', ['bold', 'underline', 'clear']],--}}
{{--                                        ['color', ['color']],--}}
{{--                                        ['para', ['ul', 'ol', 'paragraph']],--}}
{{--                                        ['table', ['table']],--}}
{{--                                        ['insert', ['link', 'picture', 'video']],--}}
{{--                                        ['view', ['fullscreen', 'codeview', 'help']]--}}
{{--                                    ]--}}
{{--                                });--}}
{{--                            </script>--}}


                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
