@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="bi bi-table"></i> Slider Edit</h1>
                    <p>Edit slider information</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                    <li class="breadcrumb-item">Slider</li>
                    <li class="breadcrumb-item active"><a href="#">Edit Slider</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Edit Slider</h3>

                        <div class="table-responsive">
                            <div class="container-fluid">
                                <form action="{{ route('admin.sliders.update', ['slider' => $slider->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="url" class="form-label">Url</label>
                                        <input type="text" class="form-control" name="url" value="{{ $slider->url }}">
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
