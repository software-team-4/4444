@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                Booking facility
            </h3>
            <div class="row" style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0" style="max-width: 768px">
                    <form class="form-horizontal" action="/facilities/booking/add" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="fname"
                                   class="col-sm-3 control-label">Facility name</label>
                            <div class="col-sm-9">
                                <input class="form-control" disabled
                                       id="fname"
                                       placeholder="Facility name"
                                       value="{{$facdata->name}} {{$facdata->start_date}}——{{$facdata->end_date}} {{$facdata->status}}">
                            </div>
                        </div>
                        <div class="form-group" style="display: none">
                            <label for="color"
                                   class="col-sm-3 control-label">color</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="color" type="color"
                                       id="color"
                                       placeholder="color">
                            </div>
                        </div>
                        <input type="hidden" name="bookinguserid" value="{{Auth::guard('user')->user()->id}}">
                        <input type="hidden" name="facilityid" value="{{$facdata->id}}">
                        <?php
                        $isReadonly = 'readonly';
                        $name = Auth::guard('user')->user()->name;;
                        $email = Auth::guard('user')->user()->email;
                        $userid = Auth::guard('user')->user()->id;
                        if (Auth::guard('user')->user()->type == '1') {
                            $isReadonly = '';
                        }
                        ?>
                        <input type="hidden" name="userid" id="userid" value="{{$userid}}">
                        <div class="form-group">
                            <label for="uname"
                                   class="col-sm-3 control-label">email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="unregisteredemail" value="{{$email}}"
                                       {{$isReadonly}}
                                       id="email"
                                       placeholder="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uname"
                                   class="col-sm-3 control-label">who use it?</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="uname" {{$isReadonly}}   value="{{$name}}"
                                       id="uname"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="startTime"
                                   class="col-sm-3 control-label">start time</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="startTime" name="start_date"
                                       placeholder="startTime">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endTime"
                                   class="col-sm-3 control-label">end time</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="endTime" name="end_date"
                                       placeholder="endTime">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title"
                                   class="col-sm-3 control-label">Additional Information</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="title" value=" "
                                       id="title"
                                       placeholder="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-3 control-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" {{$isReadonly}} name="price" value="{{$logprice}}"
                                       id="price"
                                       placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit"
                                        class="btn btn-default"
                                        style="background: #742e68;color: #ffffff">submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('facilityBooking')
    <script>
        $(document).ready(function () {
            $("#startTime").datetimepicker({
                format: 'YYYY-MM-DD HH:mm'
            });
            $("#endTime").datetimepicker({
                format: 'YYYY-MM-DD HH:mm'
            });
        });

        $('#email').change(function () {

            $.post('/facilities/booking/getprice', {
                '_token': '{{csrf_token()}}',
                'email': $(this).val(),
                'facid': '{{\Input::get('id')}}'
            }, function (date) {
                if (date == '') {
                    // $('#price').attr('readonly', false);

                } else {
                    // $('#price').attr('readonly', 'readonly');
                }
                $('#price').val(date)
            });


            $.post('/facilities/booking/getuname', {
                'email': $(this).val(),
                '_token': '{{csrf_token()}}'
            }, function (dd) {
                if (dd) {
                    var data = JSON.parse(dd);
                    $('#uname').val(data.name);
                    $('#userid').val(data.id);
                } else {
                    $('#userid').val('');
                }
            })
        });
        function randomColor() {
            var str = '';
            for (var i = 0; i < 3; i++) {
                var ran = parseInt((Math.random() * 16)).toString(16);
                if (ran.toString().length == 1) {
                    ran += '0';
                }
                str += ran;
            }
            $('#color').val('#' + str);
        }
        randomColor();
    </script>

@endsection