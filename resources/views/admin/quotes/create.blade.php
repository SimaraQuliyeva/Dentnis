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
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Responsive Table</h3>

                        <div class="table-responsive">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <div class="card-body">
                                    <form action="{{route('admin.quotes.store')}}" method="POST" enctype="multipart/form-data">
                                        {{--                {{ isset($model) ? route($routeName.'.update', $model->id) : route($routeName.'.store') }}--}}
                                        @csrf
                                        <div class="card card-primary card-tabs">
                                            <div class="card-header p-0 pt-1">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                    @foreach(config('app.languages') as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                                               id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#tab-{{$lang}}"
                                                               role="tab"
                                                               aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                                    @foreach(config('app.languages') as $index => $language)
                                                        <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$language}}"
                                                             role="tabpanel"
                                                             aria-labelledby="custom-tabs-one-home-tab">


                                                            <div class="form-group">
                                                                <label for="{{$language}}-title">Title</label>
                                                                <input type="text" placeholder="Title" name="{{$language}}[title]"
                                                                       value="{{old($language.'.title')}}"
                                                                       class="form-control" id="{{$language}}-title">
                                                                @error("$language.title")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group my-2">
                                                                <label for="{{$language}}-description">Description</label>
                                                                <input type="text" name="{{$language}}[description]"
                                                                       id="{{$language}}-description"
                                                                       value="{{ old($language.'.description')}}"
                                                                       class="form-control blogs"/>
                                                                @error("$language.description")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group py-3">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control" id="summernote">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button class="btn btn-success">Save</button>
                                    </form>

                                </div>
                    </div>

                    <!-- Include Bootstrap JS and Popper.js (required for Bootstrap) -->
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
                    <!-- Include Summernote JS -->
                    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Initialize Bootstrap Tabs
                            var tabs = new bootstrap.Tab(document.querySelector('#custom-tabs-one-home-tab'));
                            tabs.show();

                            // Initialize Summernote Editor
                            @foreach(config('app.languages') as $index => $lang)
                            new Summernote($('#summernote{{$index}}'), {
                                placeholder: 'desc{{$lang}}',
                                height: 200,
                                // Add other Summernote options as needed
                            });
                            @endforeach
                        });
                    </script>
@endsection
