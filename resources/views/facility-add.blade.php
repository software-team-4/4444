@extends('head-foot')
@section('contentRight')

    <div class="right col-sm-9">
        <?php
        //var_dump($data);
        $url = '';
        $faxt = isset($data) ? $data : null;
        function getval($data, $key)
        {
            return $data ? $data->$key : '';
        }
        ?>
        <div class="right-content">
            <h3 style="padding-left: 20px">
                @if(!$faxt)
                    {{'Add facility'}}
                @else
                    <?php $url = '/facilities/update?id=' . $data->id;?>
                    {{'Update facility'}}
                @endif
            </h3>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal" action="{{$url}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name"
                                   class="col-sm-3 control-label">Facility name</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{getval($faxt,'name')}}"
                                       id="name" name="name"
                                       placeholder="Facility name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="openTime"
                                   class="col-sm-3 control-label">Start Time</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{getval($faxt,'start_date')}}"
                                       class="form-control"
                                       id="openTime" name="start_date"
                                       placeholder="Start time">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="endTime"
                                   class="col-sm-3 control-label">End Time</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{getval($faxt,'end_date')}}"
                                       class="form-control"
                                       id="endTime" name="end_date"
                                       placeholder="End Time">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-sm-3 control-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{getval($faxt,'price')}}" class="form-control" name="price"
                                       id="price" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="priceForStudent" class="col-sm-3 control-label">priceForStudent</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="priceForStudent" name="priceForStudent"
                                       placeholder="priceForStudent" value="{{getval($faxt,'priceForStudent')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="priceForStaff" class="col-sm-3 control-label">priceForStaff</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="priceForStaff" name="priceForStaff"
                                       placeholder="priceForStaff" value="{{getval($faxt,'priceForStaff')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="currency" class="col-sm-3 control-label">currency</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="currency" name="currency"
                                       placeholder="currency"
                                       value="{{getval($faxt,'currency')==''?'£':getval($faxt,'currency')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="upperLimit"
                                   class="col-sm-3 control-label">Maximum number </label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="upperLimit" name="maximumCapacity"
                                       placeholder="Maximum number of people"
                                       value="{{getval($faxt,'maximumCapacity')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="upperLimit"
                                   class="col-sm-3 control-label">discription </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="discription"
                                          placeholder="discription">{{getval($faxt,'discription')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-3 control-label">location</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{getval($faxt,'location')}}" class="form-control"
                                       name="location" placeholder="location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-sm-3 control-label">image</label>
                            <div class="col-sm-9">
                                <input type="file" name="imagepath" id="image" class="file" accept="image/*">
                            </div>
                        </div>
                        {{csrf_field()}}
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
@section('facilityAdd')
    <script>
        $(document).ready(function () {
            $('#openTime').datetimepicker({
                format: 'HH:mm'
            });
            $('#endTime').datetimepicker({
                format: 'HH:mm'
            })
        });
    </script>
@endsection