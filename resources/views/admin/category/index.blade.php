@extends('admin-layout')

@push('stylesheet')

@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Category</h1>
        <a href="{{route('admin.brand.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Add Category</a>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($message))
                @if($message == 'addSuccess')
                    <div class="alert alert-success">
                        Add Success
                    </div>
                @elseif($message == 'addError')
                    <div class="alert alert-danger">
                        Add Fail
                    </div>
                @endif
            @endif

            {{-- hiển thị form add category --}}
            <form action="{{route('admin.category.handle.add')}}" method="post" class="border rounded my-3 p-3">
                @csrf
                <div class="form-group">
                    <label for="nameCate">Tên danh mục</label>
                    <input type="text" name="nameCate" id="nameCate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="parentCate">Danh mục cha</label>
                    <select name="parentCate" id="parentCate" class="form-control">
                        <option value="0">Root</option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="btnAddCate" class="btn btn-primary">Tạo mới</button>
            </form>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            {{-- hiển thị danh mục category --}}

        </div>
    </div>
@endsection

@push('script')

@endpush

