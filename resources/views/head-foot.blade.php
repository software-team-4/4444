<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>模板</title>

    <!-- Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- 自定义css -->
    <link href="./css/main.css" rel="stylesheet">
</head>
<body>
<div class="contanier">
    <div class="header">
        <div class="left">
            <div class="img">
                <img src="./img/head1.png"
                     alt=""
                     style="margin-left: 20px">
            </div>
            <div class="text-wrapper"
                 style="margin-left: 20px">
                <p style="color: #cf9ace;">
                    Durham University
                </p>
                <p style="color: #ffffff;">
                    Sport
                </p>
                <p style="color: #ffffff;">
                    Enabling Exceptional People to do Exceptional Things
                </p>
            </div>
        </div>
        <div class="right">
            <img src="./img/head2.png"
                 alt=""
                 style="margin:20px 20px 0 0">
        </div>
    </div>
    <div class="nav ul-wapper">
        <ul>
            <li><a href="https://www.teamdurham.com/">Home</a></li>
            <li><a href="https://www.teamdurham.com/about/">About Us</a></li>
            <li><a href="https://www.teamdurham.com/facilities/">Facilities</a></li>
            <li><a href="https://www.teamdurham.com/about/whycometodurham/">Why Durham?</a></li>
            <li><a href="https://www.teamdurham.com/collegesport/">College Sport</a></li>
            <li><a href="https://www.teamdurham.com/universitysport/">University Sport</a></li>
            <li><a href="https://www.teamdurham.com/leadership/">Leadership Development</a></li>
            <li><a href="https://www.teamdurham.com/alumni/">Alumni</a></li>
            <li><a href="https://www.teamdurham.com/community/">Community Outreach</a></li>
            <li><a href="https://www.teamdurham.com/holidaycamps/">Holiday Camps</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="row">
            <div class="left col-sm-3">
                <ul class="left-group " id="listsele">
                    <li class="left-group-item">
                        {{--<strong>Homepage</strong>--}}
                        <a href="/">
                            Homepage
                        </a>
                    </li>
                    <li class="left-group-item">
                        <a href="/personal">
                            My account
                        </a>
                    </li>
                    <li class="left-group-item">
                        <a href="/facilities">
                            Facilities
                        </a>
                    </li>
                    <li class="left-group-item">
                        <a href="/courses">
                            Sessions
                        </a>
                    </li>
                </ul>
            </div>
            @yield('contentRight')
        </div>
    </div>
    <div class="footer ul-wapper">
        <ul>
            <li><a href="https://www.dur.ac.uk/contactform2/?pageid=27804">Comments &amp; Questions</a></li>
            <li><a href="https://www.dur.ac.uk/about/terms/">Disclaimer</a></li>
            <li><a href="https://www.dur.ac.uk/about/trading_name/">Trading Name</a></li>
            <li><a href="https://www.dur.ac.uk/about/cookies/">Cookie usage policy</a></li>
            <li><a href="https://www.dur.ac.uk/ig/dp/privacy/">Privacy Notices</a></li>
        </ul>
    </div>
</div>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="./js/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="./js/bootstrap.min.js"></script>
<script>
    $('#listsele>li').each(function (key, val) {
        var pathname = $(val).find('a').attr('href');
        if (pathname[0] != '/') pathname = '/' + pathname;
        if(window.location.pathname==pathname){
            $(this).html('<strong>'+$(val).find('a').text()+'</strong>')
        }
    })
</script>
</body>
</html>