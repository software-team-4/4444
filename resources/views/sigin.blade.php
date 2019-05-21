@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                Sign in
            </h3>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal" action="/register" method="post">
                        <div class="form-group">
                            <label for="name"
                                   class="col-sm-3 control-label">UserName</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name" placeholder="UserName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email"
                                       class="form-control"
                                       id="inputEmail3" name="email"
                                       placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3"
                                   class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password"
                                       class="form-control"
                                       id="inputPassword3"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4"
                                   class="col-sm-3 control-label">Password Confirmation</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation"
                                       class="form-control"
                                       id="inputPassword4"
                                       placeholder="Password Confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name"
                                   class="col-sm-3 control-label">phoneForTainer</label>
                            <div class="col-sm-9">
                                <input type="number" maxlength="11" class="form-control" name="phone"
                                       placeholder="phoneForTainer">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Identity"
                                   class="col-sm-3 control-label">Identity</label>
                            <div class="col-sm-9">
                                {{--1=admin , 2 =trainer, 3 =student= 4= staff, 5= other--}}
                                <select id="Identity" class="form-control" name="type">
                                    {{--<option value="1">admin</option>--}}
                                    <option value="2">Coach</option>
                                    <option value="3">Students</option>
                                    <option value="4">Faculty</option>
                                    <option value="5">People outside school</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit"
                                        class="btn btn-default"
                                        style="background: #742e68;color: #ffffff">Sign in
                                </button>
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                    <div class="col-sm-9 col-sm-offset-3">
                        <p>
                            Already have an account? <a href="/login"
                                                        style="text-decoration: none;color: #742e68">login</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection