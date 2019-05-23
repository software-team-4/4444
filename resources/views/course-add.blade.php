@extends('head-foot')
@section('contentRight')
    <?php
    $url = '';
    $faxt = isset($sessdata) ? $sessdata : null;
    function getval($data, $key)
    {
        return $data ? $data->$key : '';
    }
    ?>
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                @if(!$faxt)
                    {{'Add Sessions'}}
                @else
                    <?php $url = '/courses/update?id=' . $sessdata->id;?>
                    {{'Update Sessions'}}
                @endif
            </h3>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name"
                                   class="col-sm-3 control-label">Session name</label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       id="name" name="name" value="{{getval($faxt, 'name')}}"
                                       placeholder="Session name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""
                                   class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-4">
                                <input type="text" value="" class="form-control" id="start_date" name="">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" value="" class="form-control" id="end_date" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""
                                   class="col-sm-3 control-label">Time (the left row means Mon-Sun)</label>
                            <div class="form-group col-sm-8" id="listtime">
                            </div>
                            <input type="button" class="btn" id="addtime_but" value="add">
                            {{--<input type="button" class="btn" id="test_but" value="test">--}}
                        </div>
                        <input type="hidden" name="date" id="mydate">
                        <input type="hidden" name="time" id="mytime">
                        <div class="form-group">
                            <label for="price" class="col-sm-3 control-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="price" value="{{getval($faxt, 'price')}}"
                                       id="price" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="priceForStudent" class="col-sm-3 control-label">priceForStudent</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="priceForStudent"
                                       value="{{getval($faxt, 'priceForStudent')}}" id="priceForStudent"
                                       placeholder="priceForStudent">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="priceForStaff" class="col-sm-3 control-label">priceForStaff</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="priceForStaff"
                                       value="{{getval($faxt, 'priceForStaff')}}" id="priceForStaff"
                                       placeholder="priceForStaff">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="currency" class="col-sm-3 control-label">currency</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="currency" name="currency"
                                       value="{{getval($faxt, 'currency')!=''?getval($faxt, 'currency'):'£'}}"
                                       placeholder="currency">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="state"
                                   class="col-sm-3 control-label">trainer</label>
                            <div class="col-sm-9">
                                <select name="trainerid" class="form-control" id="trainerid">
                                    @foreach($userdata as $item=>$value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="state"
                                   class="col-sm-3 control-label">facility</label>
                            <div class="col-sm-9">
                                <select id="facilityID" name="facilityid" class="form-control">
                                    @foreach($facdata as $item=>$value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="place"
                                   class="col-sm-3 control-label">discription</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"
                                          name="discription">{{getval($faxt, 'discription')}}</textarea>
                            </div>
                        </div>
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="image" class="col-sm-3 control-label">image</label>
                            <div class="col-sm-9">
                                <input type="file" id="image" name="imagepath" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" id="mysub"
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
@section('courseAdd')
    <script>
        $(document).ready(function () {
            //format: 'YYYY-MM-DD HH:mm'
            $('#start_date,#end_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#time1,#time2').datetimepicker({
                format: 'HH:mm'
            });
//            $('.time').datetimepicker({
//                format: 'HH:mm'
//            });
            //    console.log($('#facilityID').find('option:contains("zuqiu")'));

            $('#facilityID').find('option').each(function (key, val) {

                if (val.value == '{{getval($faxt, 'facilityId')}}') {
                    val.selected = true;
                    return false;
                }
            });
            $('#trainerid').find('option').each(function (key, val) {

                if (val.value == '{{getval($faxt, 'trainerId')}}') {
                    val.selected = true;
                    return false;
                }
            })

        });

        $('#addtime_but').click(function () {
            appentime();
        });
        function appentime(week, t1, t2) {
            week = week ? week : 1;
            t1 = t1 ? t1 : '00:00';
            t2 = t2 ? t2 : '00:00';
            var weektime = '<div class="col-sm-3"><input type="number" value="' + week + '" min="1" max="7" class="form-control myweek" placeholder="week"></div>';
            var time1 = '<div class="col-sm-4"><input type="time" value="' + t1 + '"  class="form-control time1" required ></div>';
            var time2 = '<div class="col-sm-5"><input type="time" value="' + t2 + '"  class="form-control time2" required ></div>';
            var time = "<div class='mytime'>" + weektime + time1 + time2 + "</div>";
            $('#listtime').append(time);
        }
        @if(!$faxt)
        appentime();
        @endif
        function getTime() {
            if ($('#end_date').val() <= $('#start_date').val()) {
                alert('The end date must be greater than the start date');
                return false;
            }
            var date = $('#start_date').val() + ',' + $('#end_date').val();
            var time = [];
            var timeIsSucc = true;
            $('.mytime').each(function (key, val) {
                //  console.log(val);
                var weektime = $(val).find('.myweek').val();
                console.log(weektime);
                var time1 = $(val).find('.time1').val();
                var time2 = $(val).find('.time2').val();
                if (weektime == '' || time1 == '' || time2 == "") {
                    timeIsSucc = false;
                    alert("Please fill in the time completely");
                } else if (time2 <= time1) {
                    timeIsSucc = false;
                    alert("The end time must be greater than the start time");
                    return false;
                }


                time.push(weektime + ',' + time1 + ',' + time2);
            });
            if (!timeIsSucc) {

                return false;
            }
            $('#mytime').val(time.join('|'));
            $('#mydate').val(date);
            console.log(date, time.join('|'));
        }
        $('#mysub').click(function () {

            return getTime();
        });
        function setDateTime() {
            var date = '{{getval($faxt, 'date')}}';
            var time = '{{getval($faxt, 'time')}}';
            //   console.log(date, time);
            if (date.indexOf(',') != -1) {
                var dates = date.split(',');
                $('#start_date').val(dates[0]);
                $('#end_date').val(dates[1])
            }
            if (time != '') {
                var times = time.split('|');
                for (var i = 0; i < times.length; i++) {
                    var weektime = times[i].split(',');
                    appentime(weektime[0], weektime[1], weektime[2])
                }
            }
        }
        setDateTime();
    </script>
@endsection