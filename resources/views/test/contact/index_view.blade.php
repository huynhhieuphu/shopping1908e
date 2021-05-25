@extends('test_layout')

@push('stylesheet')
    <link rel="stylesheet" href="{{asset('test/css/myStyle.css')}}">
    <style>
        .nen-toi {
            background-color: #0c5460;
        }
    </style>
@endpush

@push('scriptCode')
    {{--  code js in here  --}}
    <script>
    $(document).ready(function(){
        alert('hihi');
    });
    </script>   
@endpush

@section('content')
    <h3 class="phong-chu-code nen-toi">This is contact page</h3>
@endsection
