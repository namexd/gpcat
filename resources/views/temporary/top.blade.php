<!-- 登陆 注册 及顶部菜单 -->

<div class="top-bar" style="background-color: #F3F3F5;color: #3d3d3d;">
    <div class="content">
        <div class="local usertop"><a href="#" class="city"
                                      style="padding: 2px 2px;font-weight: bold;font-size: 12px;color: #d64249;">苏州市</a>
            <a href="#" style="padding-right:50px;color: #3d3d3d;">[切换]</a>
            <if condition="session('users_id')">欢迎您！ <a href="/Users/mallList/" class="dl"></a>&nbsp;&nbsp;&nbsp;
                <a href="http://www.gpmro.com//Users/joy" style="color: #3d3d3d">消息<span style="font-weight: bold; color:#e53935"></span></a>&nbsp;&nbsp;&nbsp;<a
                        ajax="1" class="aclick" style="color: #3d3d3d;" href="javascript:void(0);"
                        url="http://www.gpmro.com/Users/loginExit">[退出]</a>
                <else/>
                <a href="/admin" class="dl">请登录</a></if>
        </div>
        <div class="menu" style="width: 475px;">
            <div style="float: left;">
                <a href="http://www.gpmro.com/" style="color: #3d3d3d;">网站首页</a> &nbsp;&nbsp;&nbsp;<a href="/Users/"
                                                                                  style="color: #3d3d3d;"><img
                            style="margin-top: -5px;margin-right: 5px;"
                            src="http://www.gpmro.com/home/images/retrefds_09.png">用户中心<i class="down"></i></a> &nbsp;&nbsp;
                <a href="http://www.gpmro.com//Users/mallList/" style="color: #3d3d3d;">我的订单</a>&nbsp;&nbsp;&nbsp; <a
                        href="javascript:void(0)" id="qqzixun3" style="color: #3d3d3d;">客户服务<i class="down"></i></a> <a
                        class="ttel phone">0512-6262 6660</a></div>
        </div>
        <div class="c"></div>
    </div>
    <div class="c"></div>
</div>
<div class="search-bar">
    <div class="float-bar">
        <div class="content">
            <a href="http://www.gpmro.com/"><img src="http://www.gpmro.com/home/images/logo.jpg" alt="工品猫logo" width="145" height="55"/></a>
            <div class="inputs">
                <form action="http://www.gpmro.com//Mall/index/" method="get"><input id="tosearch" type="text" value="" name="keywords"
                                                                placeholder="请输入产品、品牌关键字"/><input class="search-btn"
                                                                                                  type="submit"
                                                                                                  value="搜 索"/></form>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
</div>
<!-- logo及搜索框 -->
<div class="top">
    <div class="logo"><img id="logo" style="cursor: pointer; float: left;" onclick="location.href='/';"
                           src="http://www.gpmro.com/home/images/logo.jpg" width="189" height="77" alt="工品猫logo"/></div>
    <div class="select">
        <div class="search">
            <div class="inputs">
                <form action="/http://www.gpmro.com/Mall/index/" method="get">
                    <input name="keywords" type="text" class="input-box" value="" placeholder="请输入产品、品牌关键字"/>
                    <input name="" type="submit" value="搜 索" class="search-btn"/>
                </form>
            </div>
        </div>
        <div class="search-hot"><a style="color: red;" href="/Mall/index/type_id/12">深沟球轴承</a> <a
                    href="http://www.gpmro.com//Mall/index/?keywords=轴承">轴承</a> <a href="/Mall/index/type_id/9">导轨</a> <a
                    href="http://www.gpmro.com//Mall/index/type_id/6">推力轴承</a> <a style="color: red;" href="/Mall/index/type_id/10">电器</a> <a
                    href="http://www.gpmro.com//Mall/index/type_id/11">劳保</a> <a href="/Mall/index/type_id/34">安全帽</a></div>
    </div>
    <div class="topcartBox">
        <div class="cart"><a class="topcart" href="http://www.gpmro.com//Users/cart" target="_blank"><i></i><img
                        src="http://www.gpmro.com/home/images/retrefds_25.png" width="21" height="17" border="0"
                        alt="购物车icon"/> <span>我的购物车&emsp;</span> ></a><!--{$count_mall|default=0}-->
            <div class="count mallcart"></div>
            <div class="cart_list">
                <img style="margin-top: 50px;" id="loader" src="http://www.gpmro.com/home/images/loader.gif" width="80"
                     height="80">
            </div>
        </div>
    </div>
    <div class="twx"><img src="http://www.gpmro.com/home/images/ewrfewer_25.jpg" width="85" height="85" alt="工品猫微信公众号"/><br/>
        微信公众号
    </div>
    <div class="c"></div>
</div>
<!-- 商品目录及主导航 -->
<div class="main-bar">
    <div class="main-menu">
        <div class="content">
            <div class="sub-menu" id="sub-menu">
                <div class="titlebut title"><img src="http://www.gpmro.com/home/images/dwqwqqq_34.png" width="18"
                                                 height="14"
                                                 style="padding-right:5px;margin-top: -2px;vertical-align: middle;"
                                                 alt="商品分类icon"/>所有商品分类
                    <div></div>
                </div>
                <ul class="sub-menu-list">
                </ul>
            </div>
            <ul class="hor-menu">
                <li style="width: 80px;"><a href="http://www.gpmro.com/">首页</a>
                    <div></div>
                </li>
                <li style="width: 110px;"><a href="http://www.gpmro.com//Mall/index/hot/1">爆款推荐</a><img class="baokuanpic"
                                                                                   src="http://www.gpmro.com/home/images/trhrtjhty_34.jpg"
                                                                                   width="23" height="14">
                    <div></div>
                </li>
                <li><a href="http://www.gpmro.com//Mall/index/online/1">在线商城</a>
                    <div></div>
                </li>
                <li style="width: 122px;margin-left: -10px;"><a href="http://www.gpmro.com//Mall/clearance">清仓特价.</a><img class="baokuanpic"
                                                                                                     src="http://www.gpmro.com/home/images/trhrtjhty_36.jpg"
                                                                                                     width="29"
                                                                                                     height="14">
                    <div></div>
                </li>
                <li><a href="http://www.gpmro.com//Mall/forward">期货预约</a>
                    <div></div>
                </li>
                <!--<li><a href="/Mall/brand" target="_blank">品牌购买</a><div></div></li>
                <li><a href="/Mall/index/nice/1" target="_blank">热销商品</a><img src="http://www.gpmro.com/home/images/1-140105134945-52.gif"><div></div></li>-->
                <li><a href="http://www.gpmro.com//Chaxun/" target="_blank">自助查询</a>
                    <div></div>
                </li>
                <li><a href="http://www.gpmro.com//News/">焦点资讯</a>
                    <div></div>
                </li>
                <!--  <li><a href="#" target="_blank">非标定制</a><div></div></li>-->
            </ul>
        </div>
    </div>
</div>
<script>
    $(function () {
        var keywords = $('#keywords').val();
        $('.input-box').val(keywords);
        $('#tosearch').val(keywords);
    });
    $('#qqzixun2').bind('click', function () {
        $('#onlineContact').fadeIn(150);
        $('#onlineContact .contactBox').addClass('ho')
    });
</script>

