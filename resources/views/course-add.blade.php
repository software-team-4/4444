@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                Add Sessions
            </h3>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="name"
                                   class="col-sm-3 control-label">Session name</label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       id="name"
                                       placeholder="Session name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="classTime"
                                   class="col-sm-3 control-label">Session Time</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="classTime"
                                       placeholder="Session time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="place"
                                   class="col-sm-3 control-label">location</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="place"
                                       placeholder="location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coach"
                                   class="col-sm-3 control-label">Coach</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="coach"
                                       placeholder="Coach">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact"
                                   class="col-sm-3 control-label">Contact with coach</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="contact"
                                       placeholder="Contact with coach">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit"
                                        class="btn btn-default"
                                        style="background: #742e68;color: #ffffff">Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="./js/bootstrap-datetimepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('#openTime').datetimepicker({ format: 'LT' });
    $('#endTime').datetimepicker({ format: 'LT' });
});
</script>
@endsection