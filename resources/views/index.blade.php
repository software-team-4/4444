@extends('head-foot')
@section('contentRight')
<div class="right col-sm-9">
    <div class="right-content">
        <div class="row login-group text-right">
            <button type="button"
                    class="btn btn-default"
                    onmousedown="window.location.href = './login.html'">
                Login
            </button>

            <button type="button"
                    class="btn btn-primary"
                    onmousedown="window.location.href = './sigin.html'">
                Sign in
            </button>
        </div>
        <div class="row"
             style="margin-top: 20px">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text"
                           class="form-control"
                           id="search"
                           placeholder="search for...">
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
                <div class="col-sm-3 col-xs-4">
                    <div class="course-wrapper">
                        <img src="./img/test2.jpg"
                             alt="">
                        <div class="course-name">
                            course-name
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-4">
                    <div class="course-wrapper">
                        <img src="./img/test2.jpg"
                             alt="">
                        <div class="course-name">
                            course-name
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-4">
                    <div class="course-wrapper">
                        <img src="./img/test2.jpg"
                             alt="">
                        <div class="course-name">
                            course-name
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"
             style="margin-top: 20px">
            <h3>Facilities</h3>
            <div class="row facilities-wrapper">
                <div class="col-sm-3 col-xs-4">
                    <div class="facility-wrapper">
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
            </div>
        </div>
    </div>
</div>
@endsection