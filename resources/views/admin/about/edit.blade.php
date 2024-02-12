@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="bi bi-table"></i> Edit About</h1>
                    <p>Edit about information</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active"><a href="#">Edit About</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Edit About Information</h3>

                        <div class="table-responsive">
                            <div class="container-fluid">
                                <form action="{{ route('admin.about.update', ['about' => $about->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="aboutId" value="{{ $about->id }}">

                                @foreach(config('app.languages') as $lang)
                                        <div class="mb-3">
                                            <label for="description_{{ $lang }}" class="form-label"> Description ({{ strtoupper($lang) }})</label>
                                            <textarea class="form-control" id="editor_{{ $lang }}" name="description_{{ $lang }}"></textarea>
{{--                                            {{ $about->getTranslation('description', $lang) }}--}}
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
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="youtube" class="form-label">Youtube Link</label>
                                        <input type="text" class="form-control" name="youtube" value="{{ $about->youtube }}">
                                        @error('youtube')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
