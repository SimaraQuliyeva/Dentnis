<!-- admin/teams/edit.blade.php -->

@extends('layouts.admin')

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="bi bi-table"></i> Edit Team Member</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
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
                            <form action="{{ route('admin.teams.update', ['team' => $team->id]) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="teamId" value="{{ $team->id }}">

                                @foreach(config('app.languages') as $lang)
                                    <div class="form-group">
                                        <label for="{{ $lang }}-position">Position ({{ strtoupper($lang) }})</label>
                                        <input type="text" name="{{ $lang }}[position]"
                                               value=""
{{--                                               {{ old($lang.'.position', $team->translation($lang)->position) }}--}}
                                               class="form-control" id="{{ $lang }}-position">
                                        @error("$lang.position")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                        <div class="form-group py-3">
                            <label>Name and Surname</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                <div class="form-group py-3">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-success">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
    </div>
        </main>
    </div>
@endsection
