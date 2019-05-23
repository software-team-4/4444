@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                Modify Personal Information
            </h3>
            <?php
            $uname=Auth::guard('user')->user()->name;
            $uphone=Auth::guard('user')->user()->phone;
            ?>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal" action="/user/update" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name"
                                   class="col-sm-3 control-label">UserName</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="name" name="name"
                                       value="{{$uname}}"
                                       placeholder="UserName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email"
                                       disabled
                                       value="{{Auth::guard('user')->user()->email}}"
                                       class="form-control"
                                       id="inputEmail3"
                                       placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone"
                                   class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number"
                                       class="form-control"
                                       id="phone" name="phone"
                                       value="{{$uphone}}"
                                       placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3"
                                   class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="inputPassword3"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4"
                                   class="col-sm-3 control-label">Password Confirmation</label>
                            <div class="col-sm-9">
                                <input type="password"
                                       value=""
                                       class="form-control" name="password_confirmation"
                                       id="inputPassword4"
                                       placeholder="Password Confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Identity"
                                   class="col-sm-3 control-label">Identity</label>
                            <div class="col-sm-9">
                                <select id="Identity" class="form-control" name="type" disabled>
                                    <option value="1">admin</option>
                                    <option value="2">Trainer</option>
                                    <option value="3">Student</option>
                                    <option value="4">Staff</option>
                                    <option value="5">People outside school</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit"
                                        class="btn btn-default"
                                        style="background: #742e68;color: #ffffff">submit
                                </button>
                                <button style="margin: 20px 0"
                                        type="button"
                                        class="btn btn-default">
                                    <a href="/personal">Back</a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#Identity').find('option').each(function (key, val) {

            if (val.value == '{{Auth::guard('user')->user()->type}}') {
                val.selected = true;
                return false;
            }
        })
    </script>
@endsection