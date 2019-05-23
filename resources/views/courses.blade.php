@extends('head-foot')
@section('contentRight')
<div class="right col-sm-9">
    <div class="right-content">
        @include('login-sign')
        <h2>Sessions</h2>
        <div class="row courses-wrapper">
            @foreach($sessdata as $item=>$value)
                <div class="col-sm-3 col-xs-4">
                    <div class="course-wrapper"
                         onmousedown="window.location.href = '/courses/detail?id={{$value->id}}'">
                        <img src="{{ltrim($value->imagepath,'.')}}"
                             alt="">
                        <div class="course-name">
                            {{$value->name}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
