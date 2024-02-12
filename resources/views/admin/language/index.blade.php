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
                        <h3 class="tile-title">Language Information Page</h3>
                        <div class="text-end" style="margin-top: 10px;">
                            <button class="btn btn-primary" style="background-color: #00695C; font-size: 18px;">
                                <a style="color: #fffbe3; text-decoration: none;" href="{{route('admin.language.create')}}">+ Add</a>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Language</th>
                                    <th>Image</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>

                                </tr>
                                </thead>
                                <tbody>
                                                                @foreach($languages as $language)
                                                                    <tr>
                                                                        <td>{{ $language->id }}</td>
                                                                        <td>{{ $language->lang}}</td>
                                                                        <td><img src="{{Storage::url($language->image)}}" alt="Lang Image" width="50" height="50"></td>
                                                                        <td>{{ $language->created_at }}</td>
                                                                        <td>{{ $language->updated_at}}</td>

                                                                        <td>
                                                                            <a href="{{ route('admin.language.edit', ['language' => $language->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                                                            <form action="{{ route('admin.language.destroy', ['language' => $language->id]) }}" method="post" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slider?')">Delete</button>
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
