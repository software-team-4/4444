@extends('head-foot')
@section('contentRight')
<div class="right col-sm-9">
    <div class="right-content">
        <h3 style="padding-left: 20px">
            Add facility
        </h3>
        <div class="row"
             style="margin-top: 20px;">
            <div class="col-sm-12 col-sm-offset-0"
                 style="max-width: 768px">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-3 control-label">Facility name</label>
                        <div class="col-sm-9">
                            <input class="form-control"
                                   id="name"
                                   placeholder="Facility name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="openTime"
                               class="col-sm-3 control-label">Opening hours</label>
                        <div class="col-sm-9">
                            <input type="text"
                                   class="form-control"
                                   id="openTime"
                                   placeholder="Opening hours">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endTime"
                               class="col-sm-3 control-label">End Time</label>
                        <div class="col-sm-9">
                            <input type="text"
                                   class="form-control"
                                   id="endTime"
                                   placeholder="End Time">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="state"
                               class="col-sm-3 control-label">Bookable status</label>
                        <div class="col-sm-9">
                            <select id="state"
                                    class="form-control">
                                <option>Bookable</option>
                                <option>Not available</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price"
                               class="col-sm-3 control-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text"
                                   class="form-control"
                                   id="price"
                                   placeholder="Price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="upperLimit"
                               class="col-sm-3 control-label">Maximum number </label>
                        <div class="col-sm-9">
                            <input type="text"
                                   class="form-control"
                                   id="upperLimit"
                                   placeholder="Maximum number of people">
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
