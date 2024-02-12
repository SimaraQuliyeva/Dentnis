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
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="text-end" style="margin-top: 10px;">
                            <button class="btn btn-primary" style="background-color: #00695C; font-size: 18px;">
                                <a style="color: #fffbe3; text-decoration: none;" href="{{route('admin.social-networks.create')}}">+ Add</a>
                            </button>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Page Icon</th>
                                    <th>Page Name</th>
                                    <th>Page Url</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($socials as $social)
                                    <tr>
                                        <td>{{$social->id}}</td>
                                        <td><img src="{{Storage::url($social->page_icon)}}" alt="Slider Image" width="50" height="50"></td>
                                        <td>{{$social->page_name}}</td>
                                        <td>{{$social->page_url}}</td>
                                        <td>
                                            <a href="{{ route('admin.social-networks.edit', ['social' => $social->id]) }}"
                                               class="btn btn-warning btn-sm">Edit</a>
                                            <form
                                                action="{{ route('admin.social-networks.destroy', ['social' => $social->id]) }}"
                                                method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this network?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

