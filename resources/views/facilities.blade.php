@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            @include('login-sign')
            <h2>
                Facilities
            </h2>
            <div class="row facilities-wrapper">
                @foreach($data as $item=>$value)
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper"
                         onmousedown="window.location.href = '/facilities/detail?id={{$value->id}}'">
                        <img src="{{ltrim($value->imagepath,'.')}}"
                             alt="">
                        <div class="facility-name">
                            {{$value->name}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection