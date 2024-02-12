<!-- admin/quotes/edit.blade.php -->

@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="bi bi-table"></i> Edit Blog</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="table-responsive">
                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('admin.blogs.update', ['blog' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="blogId" value="{{ $blog->id }}">

                                @foreach(config('app.languages') as $lang)
                                    @php
                                        $blogTranslation = $blog->translations
                                            ->where('language.lang', $lang)->first();
//                                        dd($blog);
                                    @endphp
                                    <div class="form-group">
                                        <label for="{{ $lang }}-title">Title ({{ strtoupper($lang) }})</label>
                                        <input type="text" name="{{ $lang }}[title]"
                                               value='{{$blogTranslation ? $blogTranslation->title : ''}}'
                                               {{--         value="{{$quoteTranslation ? $quoteTranslation->title : ''}}"--}}
                                               {{--       {{ old($lang.'.title', $quote->translation($lang)->title) }}--}}
                                               class="form-control" id="{{ $lang }}-title">
                                        @error("$lang.title")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="{{ $lang }}-description">Description ({{ strtoupper($lang) }})
                                            <textarea type="text" name="{{ $lang }}[description]"
                                                       id="editor_{{ $lang }}"
                                                      class="form-control">{{ $blogTranslation ? $blogTranslation->description : '' }}</textarea></label>
                                        {{--         {{ old($lang.'.description', $quote->translation($lang)->description) }}--}}
                                        @error("$lang.description")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                <div class="form-group py-3">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control" id="summernote">
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-success" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
