@extends('admin-layout')

@push('stylesheet')

@endpush

@push('script')

@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Brand</h1>
        <a href="{{route('admin.brand.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-list fa-sm text-white-50"></i> Add Brand</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(!empty(session('stateBrand')))
        <div class="alert alert-danger">
            <span>{{session('stateBrand')}}</span>
        </div>
    @endif

    <!-- Content Row -->
    <form action="{{route('admin.brand.handle.add')}}" method="post" class="border p-3 my-3">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label for="nameBrand">Tên thương hiệu</label>
                    <input type="text" class="form-control" id="nameBrand" name="nameBrand">
                </div>
                <div class="form-group">
                    <label for="decrBrand">Mô tả</label>
                    <textarea name="decrBrand" id="decrBrand" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Add</button>
            </div>

        </div>
    </form>
@endsection
