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
                        <h3 class="tile-title">Blogs Page</h3>
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
                                <a style="color: #fffbe3; text-decoration: none;" href="{{route('admin.blogs.create')}}">+ Add</a>
                            </button>
                        </div>
                        <div class="table-responsive">
                            @foreach(config('app.languages') as $lang)
                                <a href="{{ route('admin.blogs', ['lang' => $lang]) }}" class="btn btn-secondary btn-sm custom-btn-style">
                                    {{ strtoupper($lang) }}
                                </a>
                            @endforeach
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Blog Title</th>
                                    <th>Blog Description</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td><img src="{{Storage::url($blog->image)}}" alt="Blog Image" width="50"
                                                 height="50"></td>
                                        {{--    @dd($blog)--}}
                                        @if($blog->translations && $blog->translations->count() > 0)
                                            <td>{{ $blog->translations->first()->title }}</td>
                                            <td>{{  Str::limit(strip_tags($blog->translations->first()->description ), 20 ) }}</td>
                                        @else
                                            <td>No Translation</td>
                                            <td>No Translation</td>
                                        @endif

                                        <td>
                                            <a href="{{ route('admin.blogs.edit', ['blog' => $blog->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.blogs.destroy', ['blog' => $blog->id]) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                            {{ $users->appends(request()->all())->links('pagination::bootstrap-5') }}--}}

                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
