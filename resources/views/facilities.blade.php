@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            @include('login-sign')
            <h2>
                Facilities
            </h2>
            <div class="row facilities-wrapper">
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper"
                         onmousedown="window.location.href = '/facility-detail'">
                        <img src="./img/test.jpg"
                             alt="">
                        <div class="facility-name">
                            facility-name
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper">
                        <img src="./img/test.jpg"
                             alt="">
                    </div>
                </div>
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper">
                        <img src="./img/test.jpg"
                             alt="">
                    </div>
                </div>
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper">
                        <img src="./img/test.jpg"
                             alt="">
                    </div>
                </div>
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper">
                        <img src="./img/test.jpg"
                             alt="">
                    </div>
                </div>
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper">
                        <img src="./img/test.jpg"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection