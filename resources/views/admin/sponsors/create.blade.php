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
                <div class="clearfix"></div>

                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Responsive Table</h3>
                        <div class="table-responsive">
                            <form action="{{route('admin.sponsors.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label>Sponsor Image
                                    <input type="file" name="image">
                                </label>
                                <button class="btn btn-primary" style="background-color: #00695C; font-size: 18px;" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

