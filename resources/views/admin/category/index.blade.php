@extends('admin-layout')

@push('stylesheet')
    <link rel="stylesheet" href="{{asset('admin/css/treeview.css')}}">
    <style>
        .hover-point:hover {
            cursor: pointer;
        }
    </style>
@endpush

@push('script')
    <script src="{{asset('admin/js/treeview.js')}}"></script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Category</h1>
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
                {!! $message !!}
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
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
            {{-- hiển thị danh mục category bằng treeview --}}
            {{-- #tree1 chỉ ul sẽ được thay đổi --}}
            <ul id="tree1">
                @foreach($cateView as $item)
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <li class="hover-point">
                                {{$item->name}}
                                @if(count($item->childs))
                                    {{-- ĐỆ QUY --}}
                                    @include('admin.category.child-category', ['childs' => $item->childs])
                                @endif
                            </li>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <a class="float-right mt-0"
                               href="{{route('admin.category.edit', ['id' => $item->id, 'slug' => $item->slug])}}"><i
                                    class="fas fa-edit"></i></a>
                        </div>
                    </div>
                @endforeach
            </ul>

            {{ $cateView->links() }}
        </div>
    </div>
@endsection
