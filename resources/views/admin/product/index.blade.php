@extends('admin-layout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Product</h1>
        <a href="{{route('admin.product.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Add Product</a>
    </div>

    @if(!empty($message))
        <div class="row">
            <div class="col">
                {!! $message !!}
            </div>
        </div>
    @endif

    {{-- row content --}}
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            list product
        </div>
    </div>
@endsection
