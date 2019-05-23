@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h2>Facilities information</h2>
            <div class="row">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td>Facility name：</td>
                        <td>{{$data->name}}</td>
                    </tr>
                    <tr>
                        <td>
                            Opening time：
                        </td>
                        <td>
                            {{$data->start_date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            end time：
                        </td>
                        <td>
                            {{$data->end_date}}
                        </td>
                    </tr>
                    {{--<tr>--}}
                    {{--<td>--}}
                    {{--Bookable status--}}
                    {{--</td>--}}
                    {{--<td>--}}
                    <?php
                    /*$status = 'text-danger';
                    $txt = 'unavailable for booking';
                    $sta_isdis = 'disabled';
                    $admin_isdis = 'display: none';
                    if ($data->status == '1') {
                        $status = 'text-success';
                        $txt = 'available for booking';
                        $sta_isdis = '';
                    }*/
                    $admin_isdis = 'display: none';
                    $usertype = '';
                    if (Auth::guard('user')->check()) {
                        $usertype = Auth::guard('user')->user()->type;
                    }
                    if ($usertype == '1') $admin_isdis = '';
                    //
                    ?>
                    {{--<p class="{{$status}}">{{$txt}}</p>--}}

                    {{--</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td>
                            stop booking date：
                        </td>
                        <td>
                            {{$data->sbdstart_date}}——{{$data->sbdend_date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Price：
                        </td>
                        <td>
                            {{$data->price}}  {{$data->currency}}/hour
                        </td>
                    </tr>
                    <tr>
                        <td>
                            priceForStudent：
                        </td>
                        <td>
                            {{$data->priceForStudent}}  {{$data->currency}}/hour
                        </td>
                    </tr>
                    <tr>
                        <td>
                            priceForStaff：
                        </td>
                        <td>
                            {{$data->priceForStaff}}  {{$data->currency}}/hour
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Maximum number：
                        </td>
                        <td>
                            {{$data->maximumCapacity}} people
                        </td>
                    </tr>
                    @if(Auth::guard('user')->check())
                        <tr>
                            <td>More</td>
                            <td>
                                <button type="button"
                                        class="btn btn-success"
                                        onmousedown="window.location.href = '/facilities/booking?id={{$data->id}}'">
                                    booking now
                                </button>
                                <button type="button" id="butEdit"
                                        class="btn btn-default" style="{{$admin_isdis}}"
                                        onmousedown="window.location.href = '/facilities/update?id={{$data->id}}'">
                                    Edit facility
                                </button>
                                <button type="button" id="butblock"
                                        class="btn btn-warning" style="{{$admin_isdis}}"
                                        onmousedown="window.location.href = '/facilities/nobooking?id={{$data->id}}'">
                                    block booking
                                </button>
                                <button type="button" style="{{$admin_isdis}}" id="delbut"
                                        class="btn btn-danger">
                                    Delete Facility
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
        $('#delbut').click(function () {
            if (confirm('Are you sure you want to delete it?')) {
                $.post('/facilities/dele', {'id': '{{$data->id}}', '_token': '{{csrf_token()}}'}, function (da) {
                    if (da > 0) {
                        window.location.href = '/facilities';
                    } else {
                        alert('fail to delete ');
                    }
                })
            }
        })
        if ('{{$usertype}}' == '2') {
            $('#butblock').attr('disabled', false);
        }
    </script>
@endsection