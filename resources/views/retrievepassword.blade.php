@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                Retrieve Password
            </h3>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal" action="/retrievepassword" method="post" >
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" value="{{\Illuminate\Support\Facades\Input::get('email')}}"
                                       class="form-control"
                                       id="inputEmail3" name="email"
                                       placeholder="Email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3"
                                   class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password"
                                       class="form-control"
                                       id="inputPassword3" name="password"
                                       placeholder="Password" >
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