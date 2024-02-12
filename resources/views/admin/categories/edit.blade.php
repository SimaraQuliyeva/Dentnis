<!-- admin/categories/edit.blade.php -->
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
                            <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="category_id" value="{{ $category->id }}">

                                @foreach(config('app.languages') as $lang)
                                    @php
                                        $categoryTranslation = $category->translations
                                            ->where('language.lang', $lang)->first();
//                                        dd($categoryTranslation);
                                        @endphp
                                    <div class="mb-3">
                                        <label for="name_{{ $lang }}" class="form-label">Category Name
                                            ({{ strtoupper($lang) }})</label>
                                        <input type="text" class="form-control" id="name_{{ $lang }}"
                                               name="name_{{ $lang }}" value="{{$categoryTranslation ? $categoryTranslation->name : ''}}">
                                        {{--                                        {{ $category->translate($lang)->name }}--}}
                                        @error("name_{{$lang}}")
                                        <div>{{$message}}</div>
                                        @enderror
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
