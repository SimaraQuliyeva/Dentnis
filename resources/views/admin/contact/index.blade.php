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
                        <h3 class="tile-title">Contact Informaton Page</h3>
                        <div class="text-end" style="margin-top: 10px;">
                            <button class="btn btn-primary" style="background-color: #00695C; font-size: 18px;">
                                <a style="color: #fffbe3; text-decoration: none;" href="{{route('admin.contacts.create')}}">+ Add</a>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Instagram Profile</th>
                                    <th>Map</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->address }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->instagram }}</td>
                                        <td>{{ $contact->map }}</td>
                                        <td>{{ $contact->created_at }}</td>
                                        <td>{{ $contact->updated_at }}</td>

                                        <td>
                                            <a href="{{ route('admin.contacts.edit', ['contact' => $contact->id]) }}" ><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('admin.contacts.destroy', ['contact' => $contact->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-white border-0 text-danger"><i class="fa-regular fa-trash-can"></i>
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

