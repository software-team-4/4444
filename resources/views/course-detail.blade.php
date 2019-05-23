@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h2>Session information</h2>
            <div class="row">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td>Session name：</td>
                        <td>{{$sessdata->name}}</td>
                    </tr>
                    <tr>
                        <td>
                            Session date：
                        </td>
                        <td>
                            {{$sessdata->date}}
                            {{$sessdata->time}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            discription
                        </td>
                        <td>
                            {{$sessdata->discription}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Trainer：
                        </td>
                        <td>
                            {{$sessdata->user->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            phone：
                        </td>
                        <td>
                            {{$sessdata->user->phone}}
                        </td>
                    </tr>
                    <?php
                    $admin_isdis = 'display: none';
                    $islog = Auth::guard('user')->check();
                    if ($islog) {
                        $usertype = Auth::guard('user')->user()->type;
                        if ($usertype == '1' || $usertype == '2') $admin_isdis = '';
                    }
                    ?>
                    @if($islog)
                        <tr>
                            <td>More</td>
                            <td>

                                <button type="button"
                                        class="btn btn-default" style="{{$admin_isdis}}"
                                        onclick="window.location.href='/courses/update?id={{$sessdata->id}}'">
                                    Editing
                                </button>
                                <button type="button" id="delebut" style="{{$admin_isdis}}"
                                        class="btn btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $('#delebut').click(function () {
            if (confirm('Are you sure you want to delete it?')) {
                $.post('/courses/dele', {'id': '{{$sessdata->id}}', '_token': '{{csrf_token()}}'}, function (da) {
                    if (da > 0) {
                        window.location.href = '/courses';
                    } else {
                        alert('fail to delete ');
                    }
                })
            }
        })
    </script>
@endsection