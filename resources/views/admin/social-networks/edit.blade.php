<!-- resources/views/admin/social-networks/edit.blade.php -->

@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="bi bi-table"></i> Edit Social Network</h1>
                    <p>Edit social network details</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                    <li class="breadcrumb-item">Social Networks</li>
                    <li class="breadcrumb-item active"><a href="#">Edit</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Edit Social Network</h3>

                        <div class="table-responsive">
                            <div class="container-fluid">
                                <form action="{{ route('admin.social-networks.update',  ['social' => $social->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="">

                                    <div class="mb-3">
                                        <label for="page_icon" class="form-label">Page Icon</label>
                                        <input type="file" class="form-control" name="page_icon">
                                        @error('page_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="page_name" class="form-label">Page Name</label>
                                        <input type="text" class="form-control" name="page_name" value="">
                                        @error('page_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="url" class="form-label">URL</label>
                                        <input type="text" class="form-control" name="url" value="">
                                        @error('url')
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
