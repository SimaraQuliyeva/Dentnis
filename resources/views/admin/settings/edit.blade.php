@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="bi bi-table"></i> Edit Setting Information</h1>
                    <p>Edit basic bootstrap tables</p>
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
                        <h3 class="tile-title">Edit Setting Information</h3>
                        <div class="table-responsive">
                            <div class="container-fluid">
                                <form action="{{ route('admin.settings.update', ['setting' => $setting->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="top_logo" class="form-label">Top Logo</label>
                                        <input type="file" class="form-control" name="top_logo">
                                        @error('top_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="bottom_logo" class="form-label">Bottom Logo</label>
                                        <input type="file" class="form-control" name="bottom_logo">
                                        @error('bottom_logo')
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
