@extends('admin-layout')

@push('stylesheet')

@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Brand</h1>
        <a href="{{route('admin.brand.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Add Brand</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if(!empty($stateInsert))
                {{-- thông báo insert brand --}}
                <div class="alert alert-success">
                    <span>{{$stateInsert}}</span>
                </div>
            @endif


            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th colspan="2" width="5%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listBrand as $item)
                    <tr>
                        <td>
                            <a href="{{route('admin.brand.edit', ['id' => $item->id, 'slug' => $item->slug])}}">
                                {{$item->id}}
                            </a>
                        </td>
                        <td>
                            <a href="{{route('admin.brand.edit', ['id' => $item->id, 'slug' => $item->slug])}}">
                                {{$item->name}}
                            </a>
                        </td>
                        <td>{!! $item->description !!}</td>
                        <td>{{$item->status == 1 ? 'Active' : 'Deactive'}}</td>
                        <td>
                            <a href="{{route('admin.brand.edit', ['id' => $item->id, 'slug' => $item->slug])}}"
                               class="btn btn-success">
                                Edit
                            </a>
                        </td>
                        <td>
                            @if($item->status == 1)
                                <button data-status="0" id="{{$item->id}}" class="btn btn-danger js-delete-brand">
                                    Block
                                </button>
                            @else
                                <button data-status="1" id="{{$item->id}}" class="btn btn-info js-delete-brand">
                                    Unblock
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
                {{-- Hiển thị phân trang --}}
                {{$listBrand->links()}}
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        // lấy ra đường dẫn xử lý hàm delete
        var urlBrand = "{{route('admin.brand.handle.delete')}}";
    </script>
    <script src="{{asset('admin/js/admin-brand.js')}}"></script>
@endpush
