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
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name and Surname</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{ $message->id }}</td>
                                        <td>{{ $message->fullname }}</td>
                                        <td>{{ $message->phone }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ $message->message }}</td>

                                        <td>
                                            <form action="{{ route('admin.messages.destroy', ['message' => $message->id]) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
            </div>
        </main>
@endsection

