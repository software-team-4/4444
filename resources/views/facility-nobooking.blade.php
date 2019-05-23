@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                Block booking
            </h3>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal" action="/facilities/nobooking?id={{$facdata['id']}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="fname"
                                   class="col-sm-3 control-label">Facility name</label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       id="fname" value="{{$facdata['name']}}"
                                       placeholder="Facility name" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="startTime"
                                   class="col-sm-3 control-label">Start time</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control" name="start_date"
                                       id="startTime" value="{{$facdata['start_date']}}"
                                       placeholder="startTime">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endTime"
                                   class="col-sm-3 control-label">End time</label>
                            <div class="col-sm-9">
                                <input type="text" name="end_date"
                                       class="form-control"
                                       id="endTime" value="{{$facdata['end_date']}}"
                                       placeholder="endTime">
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
@section('facilityNoBooking')
    <script>
        $(document).ready(function () {
            $("#startTime,#endTime").datetimepicker({
                format: 'YYYY-MM-DD HH:mm'
            });
        });
    </script>
@endsection