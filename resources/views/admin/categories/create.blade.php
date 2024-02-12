<!-- admin/categories/create.blade.php -->

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
                            <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach(config('app.languages') as $lang)
                                    <div class="mb-3">
                                        <label for="name_{{ $lang }}" class="form-label">Category Name ({{ strtoupper($lang) }})</label>
                                        <input type="text" class="form-control" id="name_{{ $lang }}" name="name_{{ $lang }}">
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
