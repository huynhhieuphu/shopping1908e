@extends('admin-layout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Category: <b>{{$category['name']}}</b></h1>
        <a href="{{route('admin.category.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-list fa-sm text-white-50"></i> List Category</a>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

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

            <form action="{{route('admin.category.update')}}" method="post" class="border my-3 p-3">
                @csrf
                <input type="hidden" name="idCate" id="idCate" value="{{$category['id']}}">
                <input type="hidden" name="parentOld" id="parentOld" value="{{$category['parent_id']}}">
                <div class="form-group">
                    <label for="nameCate">Name Category: </label>
                    <input type="text" name="nameCate" id="nameCate" class="form-control" value="{{$category['name']}}">
                </div>
                <div class="form-group">
                    <label for="parentCate">Parent Category: </label>
                    <select name="parentCate" id="parentCate" class="form-control">
                        <option value="0" {{$category['parent_id'] == 0 ? 'selected' : ''}}>Root</option>
                        @foreach($parentCate as $item)
                            <option value="{{$item['id']}}"
                                {{$category['parent_id'] == $item['id'] ? 'selected' : ''}}>
                                {{$item['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="statusCate">Status Category: </label>
                    <select name="statusCate" id="statusCate" class="form-control">
                        <option value="0" {{ $category['status'] == 0 ? 'selected' : '' }}>Deactive</option>
                        <option value="1" {{ $category['status'] == 1 ? 'selected' : '' }}>Active</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
