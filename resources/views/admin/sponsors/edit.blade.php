{{--@extends('layouts.admin')--}}
{{--@section('header')--}}
{{--    @include('admin.partials.header')--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <h2>Add</h2>--}}
{{--     <form action="{{route('admin.sponsors.store')}}" method="post" id="editor" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <label>Sponsor Image--}}
{{--                <input type="file" name="image"/>--}}
{{--            </label>--}}

{{--            <label for="" class="text-white">Product Discount--}}
{{--                <input type="number" name="discount" class="form-control form-control-lg"--}}
{{--                       value="{{request()->get('discount')}}">--}}
{{--            </label>--}}


{{--         <button type="submit">Add</button>--}}
{{--     </form>--}}

{{--    <script>--}}
{{--        CKEDITOR.replace('editor');--}}
{{--    </script>--}}
{{--@endsection--}}



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
                            <form action="{{route('admin.sponsors.update',['sponsor'=>$sponsor->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <img src="{{ Storage::url($sponsor->image) }}" alt="Current Sponsor Image" width="50" height="50">

                                <label>Sponsor Image
                                    <input type="file" name="image">
                                </label>
                                <button class="btn btn-primary" style="background-color: #00695C; font-size: 18px;" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

