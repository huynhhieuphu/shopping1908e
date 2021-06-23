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
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh Đại Diện</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>SL</th>
                    <th class="text-right">Trạng thái</th>
                    <th class="text-right">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        @php
                            $avatar = json_decode($product->images);
                            $avatar = $avatar[0];
                        @endphp
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                <img src="{{asset('admin/upload/images/' .$avatar)}}" alt="{{asset('admin/upload/images/' .$avatar)}}" width="100">
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{number_format($product->price)}} VND</td>
                            <td>{{$product->quantity}}</td>
                            <td class="text-right">
                                @if($product->status == 1)
                                    <button type="button" class="btn btn-info">Active</button>
                                @elseif($product->status == 0)
                                    <button type="button" class="btn btn-warning">Deactive</button>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{route('admin.product.edit', ['id' => $product->id, 'slug' => $product->slug])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">
                {{ $products->links() }}
            </div>

        </div>
    </div>
@endsection
