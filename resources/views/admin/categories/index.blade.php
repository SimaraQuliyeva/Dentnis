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
                        <h3 class="tile-title">Categories Page</h3>
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
                                <a style="color: #fffbe3; text-decoration: none;" href="{{route('admin.categories.create')}}">+ Add</a>
                            </button>
                        </div>
                        <div class="table-responsive">
                            @foreach(config('app.languages') as $lang)
                                <a href="{{ route('admin.categories', ['lang' => $lang]) }}" class="btn btn-secondary btn-sm custom-btn-style">
                                    {{ strtoupper($lang) }}
                                </a>
                            @endforeach
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
{{--                                        @dd($category)--}}
                                        <td>{{ $category->id }}</td>
                                        @if(isset($category) && isset($category->translations) && $category->translations->isNotEmpty())
                                        <td>{{ $category->translations->first()->name }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="post" style="display: inline;">
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
