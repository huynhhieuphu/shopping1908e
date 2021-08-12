@extends('admin-layout')

@push('stylesheet')
    <link href="{{asset('admin/css/image-uploader.min.css')}}" rel="stylesheet">
    <style>
        span.preloaded {
            display: none;
            visibility: hidden;
        }
    </style>
@endpush

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product: {{$product->name}}</h1>
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
    <form action="{{route('admin.product.update')}}" method="post" enctype="multipart/form-data"
          class="border rounded my-3 p-2">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <input type="hidden" name="idProd" value="{{$product->id}}">
                <div class="form-group">
                    <label for="nameProd" class="@error('nameProd') text-danger @enderror"> Tên sản phẩm (*)</label>
                    <input type="text" name="nameProd" id=nameProd"
                           class="form-control @error('nameProd') is-invalid @enderror"
                           value="{{$product->name}}"
                    >
                    @error('nameProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="priceProd" class="@error('priceProd') text-danger @enderror"> Giá (*)</label>
                    <input type="text" name="priceProd" id="priceProd"
                           class="form-control @error('priceProd') is-invalid @enderror"
                           value="{{$product->price}}"
                    >
                    @error('priceProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantityProd" class="@error('quantityProd') text-danger @enderror"> Số lượng (*)</label>
                    <input type="number" name="quantityProd" id=quantityProd"
                           class="form-control @error('quantityProd') is-invalid @enderror"
                           value="{{$product->quantity}}"
                    >
                    @error('quantityProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="saleOff"> Khuyến mãi </label>
                    <input type="number" name="saleOff" id=saleOff" class="form-control" value="{{$product->sale_off}}">
                </div>
                <div class="form-group">
                    <label for="code"> Mã KM </label>
                    <input type="text" name="code" id=code" class="form-control" value="{{$product->code}}">
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="brandProd" class="@error('brandProd') text-danger @enderror"> Thương hiệu (*)</label>
                    <select name="brandProd" id="brandProd"
                            class="form-control js-select-brand">
                        <option value="">--- Vui lòng chọn ---</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}"
                                    @if($brand->id == $product->brand_id) selected @endif>{{$brand->name}}</option>
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
                            <option value="{{$category->id}}"
                                    @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('categoryProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sizeProd" class="@error('sizeProd') text-danger @enderror"> Kích cỡ (*)</label>

                    <select name="sizeProd[]" id="sizeProd" class="form-control js-select-size" multiple>
                        <?php
                        foreach ($sizes as $optionSize) {
                        $flagColor = false;
                        foreach ($selectedSizes as $selectedSize) {
                            if ($optionSize->id == $selectedSize->size_id) {
                                $flagColor = true;
                            }
                        }
                        ?>
                        <option
                            value="{{$optionSize->id}}" <?= $flagColor ? 'selected' : '' ?>>{{$optionSize->size_number}}</option>
                        <?php } ?>
                    </select>

                    @error('sizeProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="colorProd" class="@error('colorProd') text-danger @enderror"> Màu sắc (*)</label>
                    <select name="colorProd[]" id="colorProd" class="form-control js-select-color" multiple>
                        @foreach($colors as $opColor)
                            @php $flagColor = false; @endphp
                            @foreach($selectedColors as $selectedColor)
                                @if($opColor->id == $selectedColor->color_id)
                                    @php $flagColor = true; @endphp
                                @endif
                            @endforeach
                            <option value="{{$opColor->id}}" @if($flagColor) selected @endif>{{$opColor->name}}</option>
                        @endforeach
                    </select>
                    @error('colorProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tagProd" class="@error('tagProd') text-danger @enderror"> Tag (*)</label>
                    <select name="tagProd[]" id="tagProd" class="form-control js-select-tag" multiple>
                        @foreach($tags as $opTag)
                            @php $flagTag = false @endphp
                            @foreach($selectedTags as $selectedTag)
                                @if($opTag->id == $selectedTag->tag_id)
                                    @php $flagTag = true @endphp
                                @endif
                            @endforeach
                            <option value="{{$opTag->id}}" @if($flagTag) selected @endif>{{$opTag->name}}</option>
                        @endforeach
                    </select>
                    @error('tagProd')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="statusProd"> Trạng thái </label>
                    <select name="statusProd" id="statusProd" class="form-control">
                        <option value="0" @if($product->status == 0) selected @endif>Deactive</option>
                        <option value="1" @if($product->status == 1) selected @endif>Active</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="imageProd"> Hình ảnh </label>
                    <div class="input-images"></div>
                    <span class="preloaded">{{$product->images}}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-danger">Xoá Sản Phẩm</button>
            </div>
            <div class="col text-right">
                <button type="submit" class="btn btn-success">Cập nhật</button>
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
            url = "{{asset('admin/upload/images')}}";
            strImages = $('span.preloaded').html();
            arrImages = JSON.parse(strImages);
            preloaded = [];

            arrImages.forEach(function (item, index) {
                preloaded.push({
                    'id': item,
                    'src': url + "/" + item
                });
            });

            $('.input-images').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'newImages',
                preloadedInputName: 'oldImages',
            });

            $('#priceProd').maskMoney({precision: 0});
        });
    </script>
@endpush
