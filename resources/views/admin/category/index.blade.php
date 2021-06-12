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
            {{-- hiển thị form add category --}}

        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            {{-- hiển thị danh mục category --}}
        </div>
    </div>
@endsection

@push('script')

@endpush

