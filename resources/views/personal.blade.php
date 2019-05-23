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
                    <a href="/personal-edit">
                        <button style="margin: 20px 0"
                                type="button"
                                class="btn btn-default">
                            Modify
                        </button>
                    </a>

                </div>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td>Username：</td>
                        <td>{{Auth::guard('user')->user()->name}}</td>
                    </tr>
                    <tr>
                        <td>
                            E-mail：
                        </td>
                        <td>
                            {{Auth::guard('user')->user()->email}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Identity：
                        </td>
                        <td>
                            <?php
                            switch (Auth::guard('user')->user()->type) {
                                case '1':
                                    echo 'admin';
                                    break;
                                case '2':
                                    echo 'Trainer';
                                    break;
                                case '3':
                                    echo 'Student';
                                    break;
                                case '4':
                                    echo 'Staff';
                                    break;
                                case '5':
                                    echo 'People outside school';
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Phone：
                        </td>
                        <td>
                            {{Auth::guard('user')->user()->phone}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--已定设备-->
            <div class="row">
                <h2 style="padding: 0 15px">
                    All facilities booking records
                </h2>
                <p style="padding: 0 15px">
                    <button type="button"
                            class="btn btn-default"
                            onmousedown="window.location.href = '/calendarView'">
                        calendarView
                    </button>
                </p>
            </div>
            <!--管理所有设备-->
            @if(isset($facdata))
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
                                onmousedown="window.location.href = '/facilities/add'">
                            Add
                        </button>
                    </div>
                </div>
                <div class="row courses-wrapper">

                    @foreach($facdata as $item=>$value)
                        <div class="col-sm-3 col-xs-4">
                            <div class="course-wrapper">
                                <img src="{{ltrim($value->imagepath,'.')}}"
                                     alt="">
                                <div class="course-name">
                                    {{$value->name}}
                                </div>
                                <div class="operator-warpper">
                                    <button type="button"
                                            class="btn btn-success">
                                        <a href="/facilities/update?id={{$value->id}}"
                                           style="color: #ffffff">Modify</a>
                                    </button>
                                    <button type="button" data-facid="{{$value->id}}"
                                            class="btn btn-danger facdelebut">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        <!--管理所有课程-->
            @if(isset($sessdata))
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
                                onmousedown="window.location.href = '/courses/add'">
                            Add
                        </button>
                    </div>
                </div>
                <div class="row facilities-wrapper">

                    @foreach($sessdata as $item=>$value)
                        <div class="col-sm-3 col-xs-4">
                            <div class="facility-wrapper">
                                <img src="{{ltrim($value->imagepath,'.')}}"
                                     alt="">
                                <div class="facility-name">
                                    {{$value->name}}
                                </div>
                                <div class="operator-warpper">
                                    <button type="button"
                                            class="btn btn-success">
                                        <a href="/courses/update?id={{$value->id}}"
                                           style="color: #ffffff">Modify</a>
                                    </button>
                                    <button type="button" data-sessid="{{$value->id}}"
                                            class="btn btn-danger sessdelebut">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        </div>
    </div>
    <script>
        $('.sessdelebut').click(function () {
            if (confirm('Are you sure you want to delete it?')) {
                $.post('/courses/dele', {'id': $(this).data('sessid'), '_token': '{{csrf_token()}}'}, function (da) {
                    if (da > 0) {
                        window.location.href = '/personal';
                    } else {
                        alert('fail to delete');
                    }
                })
            }
        })
        $('.facdelebut').click(function () {
            if (confirm('Are you sure you want to delete it?')) {
                $.post('/facilities/dele', {'id': $(this).data('facid'), '_token': '{{csrf_token()}}'}, function (da) {
                    if (da > 0) {
                        window.location.href = '/personal';
                    } else {
                        alert('fail to delete ');
                    }
                })
            }
        })
    </script>
@endsection