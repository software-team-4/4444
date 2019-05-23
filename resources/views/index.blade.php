@extends('head-foot')
@section('contentRight')


    <div class="right col-sm-9">
        <div class="right-content">
            @include('login-sign')
            <div class="row" style="margin-top: 20px">
                <form class="form-inline" action="" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="key" id="search" placeholder="search for...">
                    </div>
                    <button type="submit"
                            class="btn btn-default">Search
                    </button>

                </form>
            </div>
            <div class="row"
                 style="margin-top: 20px">
                <h3>Sessions</h3>
                <div class="row courses-wrapper">
                    @foreach($sessdata as $item=>$value)
                        <div class="col-sm-3 col-xs-4">
                            <div class="course-wrapper">
                                <a href="/courses/detail?id={{$value->id}}">
                                    <img src="{{ltrim($value->imagepath,'.')}}"
                                         alt="">
                                    <div class="course-name">
                                        {{$value->name}}
                                    </div>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <h3>Facilities</h3>
                <div class="row facilities-wrapper">
                    @foreach($facdata as $item=>$value)
                        <div class="col-sm-3 col-xs-4">
                            <div class="facility-wrapper">
                                <a href="/facilities/detail?id={{$value->id}}">
                                    <img src="{{ltrim($value->imagepath,'.')}}" alt="no images">
                                    <div class="facility-name">{{$value->name}}</div>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection