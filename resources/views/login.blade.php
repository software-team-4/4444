@extends('head-foot')
@section('contentRight')
    <div class="right col-sm-9">
        <div class="right-content">
            <h3 style="padding-left: 20px">
                Login
            </h3>
            <div class="row"
                 style="margin-top: 20px;">
                <div class="col-sm-12 col-sm-offset-0"
                     style="max-width: 768px">
                    <form class="form-horizontal" action="/login" method="post" accept="application/json">
                        <div class="form-group">
                            <label for="inputEmail3"
                                   class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" value="1260854194@qq.com"
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
                                       placeholder="Password" value="123456">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="online" value="1"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit"
                                        class="btn btn-default"
                                        style="background: #742e68;color: #ffffff">Login
                                </button>

                            </div>
                        </div>
                    </form>
                    <div class="col-sm-9 col-sm-offset-3">
                        <p>
                            Don't have an account yet? <a href="/sigin" style="text-decoration: none;color: #742e68">Sign
                                in</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="text-decoration: none;color: #742e68;cursor: pointer"
                                                                       id="a1">forget the password</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#a1').click(function () {
            var email = prompt('Please enter email address');
            window.location.href = '/sedemailretpaw?email=' + email;
        })
    </script>
@endsection