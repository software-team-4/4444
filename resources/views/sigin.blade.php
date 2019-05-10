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
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-3 control-label">UserName</label>
                        <div class="col-sm-9">
                            <input type="email"
                                   class="form-control"
                                   id="name"
                                   placeholder="UserName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3"
                               class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email"
                                   class="form-control"
                                   id="inputEmail3"
                                   placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3"
                               class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password"
                                   class="form-control"
                                   id="inputPassword3"
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4"
                               class="col-sm-3 control-label">Password Confirmation</label>
                        <div class="col-sm-9">
                            <input type="password"
                                   class="form-control"
                                   id="inputPassword4"
                                   placeholder="Password Confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Identity"
                               class="col-sm-3 control-label">Identity</label>
                        <div class="col-sm-9">
                            <select id="Identity"
                                    class="form-control">
                                <option>Students</option>
                                <option>Faculty</option>
                                <option>Coach</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit"
                                    class="btn btn-default"
                                    style="background: #742e68;color: #ffffff"
                                    onmousedown="window.location.href = './error.html'">Sign in
                            </button>
                        </div>
                    </div>
                </form>
                <div class="col-sm-9 col-sm-offset-3">
                    <p>
                        Already have an account? <a href="./login.html"
                                                    style="text-decoration: none;color: #742e68">login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection