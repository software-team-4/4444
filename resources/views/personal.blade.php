@extends('head-foot')
@section('contentRight')
<div class="right col-sm-9">
    <div class="right-content">
        <!--个人资料-->
        <div class="row">
            <div class="col-xs-6">
                <h2>
                    Personal information
                </h2>
            </div>
            <div class="col-xs-6 text-right">
                <button style="margin: 20px 0"
                        type="button"
                        class="btn btn-default">
                    <a href="/sigin">Modify</a>
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td>Username：</td>
                    <td>william</td>
                </tr>
                <tr>
                    <td>
                        E-mail：
                    </td>
                    <td>
                        xxxx@gmail.com
                    </td>
                </tr>
                <tr>
                    <td>
                        E-mail：
                    </td>
                    <td>
                        xxxx@gmail.com
                    </td>
                </tr>
                <tr>
                    <td>
                        Phone：
                    </td>
                    <td>
                        123445678901
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!--已定设备-->
        <div class="row">
            <h2 style="padding: 0 15px">
                Booked facilities
            </h2>
        </div>
        <!--管理所有设备-->
        <div class="row">
            <div class="col-xs-6">
                <h2>
                    Manage Facilities
                </h2>
            </div>
            <div class="col-xs-6 text-right">
                <button style="margin: 20px 0"
                        type="button"
                        class="btn btn-primary"
                        onmousedown="window.location.href = '/facility-add'">
                    Add
                </button>
            </div>
        </div>
        <div class="row courses-wrapper">
            <div class="col-sm-3 col-xs-4">
                <div class="course-wrapper">
                    <img src="./img/test2.jpg"
                         alt="">
                    <div class="course-name">
                        course-name
                    </div>
                    <div class="operator-warpper">
                        <button type="button"
                                class="btn btn-success">
                            <a href="/login"
                               style="color: #ffffff">Modify</a>
                        </button>
                        <button type="button"
                                class="btn btn-danger">
                            <a href="/sigin"
                               style="color: #ffffff">Delete</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--管理所有课程-->
        <div class="row">
            <div class="col-xs-6">
                <h2>
                    Manage sessions
                </h2>
            </div>
            <div class="col-xs-6 text-right">
                <button style="margin: 20px 0"
                        type="button"
                        class="btn btn-primary"
                        onmousedown="window.location.href = '/course-add'">
                    Add
                </button>
            </div>
        </div>
        <div class="row facilities-wrapper">
            <div class="col-sm-3 col-xs-4">
                <div class="facility-wrapper">
                    <img src="./img/test.jpg"
                         alt="">
                    <div class="facility-name">
                        facility-name
                    </div>
                    <div class="operator-warpper">
                        <button type="button"
                                class="btn btn-success">
                            <a href="/login"
                               style="color: #ffffff">Modify</a>
                        </button>
                        <button type="button"
                                class="btn btn-danger">
                            <a href="/sigin"
                               style="color: #ffffff">Delete</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection