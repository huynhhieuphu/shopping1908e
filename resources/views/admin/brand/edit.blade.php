@extends('admin-layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Brand: {{$dataBrand->name}}</h1>
        <a href="{{route('admin.brand.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-list fa-sm text-white-50"></i> List Brand</a>
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
    <form action="{{route('admin.brand.handle.update')}}" method="post" class="border p-3 my-3">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <input type="hidden" name="hddIdBrand" value="{{$idBrand}}">
                <div class="form-group">
                    <label for="nameBrand">Tên thương hiệu</label>
                    <input type="text" class="form-control" id="nameBrand" name="nameBrand" value="{{$dataBrand->name}}">
                </div>
                <div class="form-group">
                    <label for="decrBrand">Mô tả</label>
                    <textarea name="decrBrand" id="decrBrand" class="form-control" cols="30" rows="10">{{$dataBrand->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="sttBrand">Trạng Thái</label>
                    <select name="sttBrand" id="sttBrand" class="form-control">
                        <option value="1" {{$dataBrand->status === 1 ? 'selected' : ''}}>Active</option>
                        <option value="0" {{$dataBrand->status === 0 ? 'selected' : ''}}>Deactive</option>
                    </select>
                </div>

                <button class="btn btn-success" type="submit">Update</button>
            </div>

        </div>
    </form>
@endsection
