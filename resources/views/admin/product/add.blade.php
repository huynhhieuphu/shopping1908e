@extends('admin-layout')

@push('stylesheet')
    <link href="{{asset('admin/css/image-uploader.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
        <a href="{{route('admin.product.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> List Product</a>
    </div>

    @if(!empty($message))
        <div class="row">
            <div class="col">
                {!! $message !!}
            </div>
        </div>
    @endif

    {{-- row content --}}
    <form action="{{route('admin.product.handle.add')}}" method="post" enctype="multipart/form-data"
          class="border rounded my-3 p-2">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="nameProd" class="@error('nameProd') text-danger @enderror"> Tên sản phẩm (*)</label>
                    <input type="text" name="nameProd" id=nameProd"
                           class="form-control @error('nameProd') is-invalid @enderror">
                    @error('nameProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="priceProd" class="@error('priceProd') text-danger @enderror"> Giá (*)</label>
                    <input type="text" name="priceProd" id="priceProd"
                           class="form-control @error('priceProd') is-invalid @enderror">
                    @error('priceProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantityProd" class="@error('quantityProd') text-danger @enderror"> Số lượng (*)</label>
                    <input type="number" name="quantityProd" id=quantityProd"
                           class="form-control @error('quantityProd') is-invalid @enderror">
                    @error('quantityProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="saleOff"> Khuyến mãi </label>
                    <input type="number" name="saleOff" id=saleOff" class="form-control">
                </div>
                <div class="form-group">
                    <label for="code"> Mã KM </label>
                    <input type="text" name="code" id=code" class="form-control">
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="brandProd" class="@error('brandProd') text-danger @enderror"> Thương hiệu (*)</label>
                    <select name="brandProd" id="brandProd"
                            class="form-control js-select-brand">
                        <option value="">--- Vui lòng chọn ---</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    @error('brandProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoryProd" class="@error('categoryProd') text-danger @enderror"> Danh mục (*)</label>
                    <select name="categoryProd" id="categoryProd" class="form-control js-select-category">
                        <option value="">--- Vui lòng chọn ---</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('categoryProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sizeProd" class="@error('sizeProd') text-danger @enderror"> Kích cỡ (*)</label>
                    <select name="sizeProd[]" id="sizeProd" class="form-control js-select-size" multiple>
                        @foreach($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size_number}}</option>
                        @endforeach
                    </select>
                    @error('sizeProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="colorProd" class="@error('colorProd') text-danger @enderror"> Màu sắc (*)</label>
                    <select name="colorProd[]" id="colorProd" class="form-control js-select-color" multiple>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}">{{$color->name}}</option>
                        @endforeach
                    </select>
                    @error('colorProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tagProd" class="@error('tagProd') text-danger @enderror"> Tag (*)</label>
                    <select name="tagProd[]" id="tagProd" class="form-control js-select-tag" multiple>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    @error('tagProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="statusProd"> Trạng thái </label>
                    <select name="statusProd" id="statusProd" class="form-control">
                        <option value="0">Deactive</option>
                        <option value="1" selected>Active</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="imageProd"> Hình ảnh </label>
                    <div class="input-images"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                <button type="submit" class="btn btn-success">Thêm Sản Phẩm</button>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{asset('admin/js/admin-product.js')}}"></script>
    {{-- image-uploader js --}}
    <script src="{{asset('admin/js/image-uploader.min.js')}}"></script>
    {{--  number to currency  --}}
    <script src="{{asset('admin/js/jquery.maskMoney.min.js')}}"></script>
    <script>
        $(function () {
            $('.input-images').imageUploader();
            $('#priceProd').maskMoney({precision:0});
        });
    </script>
@endpush
