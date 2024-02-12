<!-- admin/categories/create.blade.php -->

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
                        <h3 class="tile-title">Doctor Info Table</h3>

                        <div class="table-responsive">
                            <form action="{{ route('admin.main-doctor.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach(config('app.languages') as $lang)
                                    <div class="mb-3">
                                        <label for="description_{{ $lang }}" class="form-label">Description ({{ strtoupper($lang) }})
                                        <textarea  class="form-control" id="editor_{{ $lang }}" name="description_{{ $lang }}"></textarea></label>
                                    </div>
                                    <script>
                                        ClassicEditor
                                            .create( document.querySelector( '#editor_{{ $lang }}' ) )
                                            .then( editor => {
                                                console.log( editor );
                                            } )
                                            .catch( error => {
                                                console.error( error );
                                            } );
                                    </script>
                                @endforeach

                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
