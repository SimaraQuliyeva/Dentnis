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
                <form action="{{ route('admin.users') }}" method="get">
                    <label>
                        <input type="text" name="name" class="form-control form-control-lg" value="{{ request()->get('name') }}" placeholder="Enter the user name">
                    </label>
                    <label>
                        <input type="email" name="email" placeholder="Enter the email" class="form-control form-control-lg">
                    </label>
                    <button type="submit" class=" btn btn-success mt-3 mx-1">Search</button>
                </form>

                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Responsive Table</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Creeated at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <p>{{$user->id}}</p>
                                        </td>
                                        <td>
                                            <p>{{$user->name}}</p>
                                        </td>
                                        <td>
                                            <span>{{$user->email}}</span>
                                        </td>
                                        <td>
                                            {{--                                            <span>{{$user->created_at->format('y/m/d')}}</span>--}}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $users->appends(request()->all())->links('pagination::bootstrap-5') }}

                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
