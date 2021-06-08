{{-- kế thừa layou t test_layout.blade.php --}}
@extends('test-layout')
{{-- hiển thị vùng chỉ định --}}
@section('content')
    <h3 class="text-center">This is dashboard page</h3>
    <div><b>My name:</b> {{$fullname}}</div>
    <div><b>Role: </b> {{$role}}</div>
    <table class="table table-striped table-hover border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lstUser as $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{!!$item['username']!!}</td>
                    <td>{{$item['email']}}</td>
                    <td>{{$item['gender'] === 1 ? 'male' : 'female'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
