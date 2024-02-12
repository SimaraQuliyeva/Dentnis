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
                            <div class="container-fluid">
                                <form action="{{ route('admin.social-networks.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="page_icon" class="form-label">Page Icon</label>
                                        <input type="file" class="form-control" name="page_icon">
                                    </div>
                                    <div class="mb-3">
                                        <label for="page_name" class="form-label">Page Name</label>
                                        <input type="text" class="form-control" name="page_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="url" class="form-label">Url</label>
                                        <input type="text" class="form-control" name="url">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
