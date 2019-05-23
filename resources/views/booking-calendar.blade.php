@extends('head-foot')
@section('contentRight')
    <style>
        table {
            cursor: pointer;
        }
    </style>
    <script src="/js/jquery.contextify.js"></script>
    <script src="/js/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="/css/fullcalendar.min.css"/>
    <div class="right col-sm-9">
        <div class="right-content">
            <h2>
                All bookings
            </h2>
            <div class="row">
                <div id="allBooking">
                    <div class="row">
                        <div class="col-sm-4">
                            <select id="facilitys" class="form-control">
                                <option value="all">all facility</option>
                                @foreach($facdata as $val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-11 ">

                            <div class="panel panel-defult">
                                <div class="panel-heading" style="background:#2e6da4; color: white;">
                                    booking Calendar
                                </div>
                                <div class="panel-body">
                                    {!! $calendar->calendar()!!}
                                    {!! $calendar->script()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <button type="button" class="btn btn-primary" id="but_model" data-toggle="modal" data-target="#exampleModal"
            style="display: none" data-whatever="@mdo"></button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">update</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">start time</label>
                        <input type="text" class="form-control" id="startTime">
                    </div>
                    <div class="form-group">
                        <label class="control-label">wnd time</label>
                        <input type="text" class="form-control" id="endTime">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sub_but">submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        $("#startTime").datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $("#endTime").datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });


        $('#facilitys >option').each(function (k, val) {
            if ('{{\Illuminate\Support\Facades\Input::get('facid')}}' == $(val).val()) {
                val.selected = true;
            }
        });
        $('#facilitys').change(function () {
            window.location.href = '/calendarView?facid=' + $(this).val();
        });
        $(".panel-body").bind("contextmenu", function () {
            return false;
        });
        var bookfacid = null;
        var email = null;
        var fudom = '';
        $('.panel-body').on('contextmenu', '.fc-event', function (e) {
            fudom = this;
            var data = $(this).find('.fc-title').text().split('|');
            if (data.length >= 2) {
                bookfacid = data[0];
                email = data[1];
            } else {
                $('#contextify-menu').hide();
                bookfacid = null;
                email = null;
            }


        });
        $('.panel-body').on('click', '.fc-button-group', function (ev) {
            $('.fc-event').contextify(options);
        });

        $(function () {
            $('.fc-event').contextify(options);
        });

        // console.log(test.children())

        $('#sub_but').click(function () {
            $.post('/facilities/updatebookingfacili', {
                start_date: $("#startTime").val(),
                end_date: $("#endTime").val(),
                '_token': '{{csrf_token()}}',
                'id': bookfacid,
                'unregisteredemail': email
            }, function (data) {
                if (data == '1') {
                    window.location.reload();
                } else {
                    alert(data);
                }
            })
        });
        var options = {
            items: [
                {header: 'memu'},
                {divider: true},
                {
                    text: 'update',
                    onclick: function (e) {
                        if (bookfacid) {
                            $.post('/bookinfacility/getdatetime', {
                                id: bookfacid,
                                '_token': '{{csrf_token()}}'
                            }, function (data) {
                                var data = JSON.parse(data);
                                $("#startTime").val(data.start_date);
                                $("#endTime").val(data.end_date);
                                $('#but_model').trigger('click');
                            });
                            if ('{{Auth::guard('user')->user()->type}}' == '1' || '{{Auth::guard('user')->user()->email}}' == email) {
                                $('#sub_but').show();
                            } else {
                                $('#sub_but').hide();
                            }
                        }
                    }
                },
                {
                    text: 'delete',
                    onclick: function () {
                        if (!bookfacid) {
                            return false;
                        }
                        if ('{{Auth::guard('user')->user()->type}}' != '1' && '{{Auth::guard('user')->user()->email}}' != email) {
                            alert("You can't delete it");
                        } else {
                            if (confirm('Are you sure you want to delete it?')) {
                                $.post('/bookinfacility/del', {
                                    id: bookfacid,
                                    '_token': '{{csrf_token()}}'
                                }, function (data) {
                                    if (data == '1') {
                                        window.location.href = '/calendarView';
                                    } else {
                                        alert('fail to delete');
                                    }
                                    //
                                })
                            }
                        }

                    }
                }
            ]
        };
        //  $('.panel-body').contextify(options);


    </script>
@endsection