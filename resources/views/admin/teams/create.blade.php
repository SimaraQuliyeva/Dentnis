@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection
@section('content')

<div class="card" style="width: 67%; height: auto; margin: 100px auto;">
    <div class="card-body">
        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 style="color: #117A65; display: flex; justify-content: flex-start">Add</h2>
            <div class="card card-primary card-tabs">
                <div style="background-color: #A9DFBF; padding: 5px; border-radius: 8px;">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        @foreach(config('app.languages') as $lang)
                            <li class="nav-item">
                                <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                   style="color: #27AE60; border: 1px solid #fff; border-radius: 5px; margin-right: 5px;"
                                   id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#tab-{{$lang}}" role="tab"
                                   aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        @foreach(config('app.languages') as $index => $language)
                            <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$language}}" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-home-tab">
                                <div class="form-group">
                                    <label for="{{$language}}-position">Position</label>
                                    <input type="text" placeholder="Position" name="{{$language}}[position]"
                                           value="{{old($language.'position')}}"
                                           class="form-control" id="{{$lang}}-position">
                                    @error("$language.position")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group py-2">
                <label>Name and Surname</label>
                <input name="name" class="form-control" type="text"/>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group py-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
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
