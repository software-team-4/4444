<div class="row login-group text-right">

    <button type="button" id="butlogin" class="btn btn-default" onmousedown="window.location.href = '/login'">Log in</button>
    <button type="button" id="butlogout" class="btn btn-default" onmousedown="window.location.href = '/logout'">log out</button>

    <button type="button" class="btn btn-primary" onmousedown="window.location.href = '/sigin'"> Sign up</button>
</div>
<script>
    console.log('{{Auth::guard('user')->check()}}')
    if('{{Auth::guard('user')->check()}}'=='1'){
        $('#butlogin').hide();
        $('#butlogout').show();
    }else {
        $('#butlogout').hide();
        $('#butlogin').show();
    }
</script>