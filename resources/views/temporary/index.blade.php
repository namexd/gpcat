<html>
<head>
    <title> @yield('title')</title>
    <link href="http://www.gpmro.com/home/css/category.css" rel="stylesheet" type="text/css" />

</head>
@include('temporary.header')

<body>
@include('temporary.top')

<!-- 主体内容 -->
<input type="hidden" id="order_input" value="" />
<input type="hidden" id="page_input" value="" />
<input type="hidden" id="suppliers_input" value=""/>
<input type="hidden" id="brand_input" value="" />
<input type="hidden" id="days_input" value="" />
<input type="hidden" id="search_input" value="" />
  <div class="prolist">
    <table class="filters content">
      <thead>
        <tr>
          <td style="background: #f5f5f5; padding: 5px 15px;" colspan="3"><span style="font-size: 16px;color: #686868; font-weight: bold;"><!--<span class="onelevelTop">&nbsp;&nbsp;{$catStr}&nbsp;&nbsp;</span>--></span>&nbsp;&nbsp;<span>商品筛选</span></td>
        </tr>
      </thead>
      <tbody>
{{--        <tr>--}}
{{--          <td>供应商：</td>--}}
{{--          <td colspan="2" style="padding-top: 7px;">--}}
{{--            <ul id="suppliers_list" style="width: 930px;">--}}
{{--            </ul>--}}
{{--           </td>--}}
{{--        </tr>--}}
{{--       <tr >--}}
{{--            <td>品牌：</td>--}}
{{--            <td style="padding-top: 7px;">--}}
{{--                <ul id="brand_list">--}}
{{--            </ul>--}}
{{--            </td>--}}
{{--        </tr>--}}
      </tbody>
    </table>
  </div>
</div>

<div class="pro-bar content">
    <div class="pnav">
        <ul class="sort content">
            <li><a onclick="go_order(1)"  class="order order_kc">库存<i></i></a></li>
            <li><a onclick="go_order(2)"  class="order order_pr">价格<i></i></a></li>
        </ul>
        <div class="c"></div>
    </div>
    <script>
        $('body').delegate('.selectstockbox','change',function(){
            $('#stock_id').val($(this).val());
            $('#formsubmit').submit();
        })
    </script>
    <form id="search" >
    <div class="selectstock">
        型号：
        <select name="brand" class="selectstockbox" id="brand_select" >
            <option value="0">请选择型号</option>
        </select>
    </div>
    <div style="margin-right: 5px;float: left">
        <input name="days" id="days" type="text"  style="width: 100px" class="input-box2" value=""  placeholder="输入到货天数" />
    </div>
  <div style="margin:auto;float: left">
      <input name="keywords" id="key" type="text" class="input-box2" value=""  placeholder="请输入产品、品牌关键字" />
      <input  type="button" onclick="go_search()" value="搜索" class="search-btn2" />
  </div>
    </form>
  <div class="ppage"><!--<a class="p01">1/20</a><a class="p02"><</a><a class="p02">></a>--></div>
  <div class="c"></div>

</div>
<div class="c"></div>
<div class="tish_inopro" style="line-height: 80px; font-size: 16px; padding-left: 50px;display: none;"> <img style="margin-right: 5px;width: 32px;height: 30px;vertical-align: middle;" src="http://www.gpmro.com/home/images/tsww.jpg">小编正在努力的整理资料…… </div>
<div class="product"> 
  <!--购买仓库数量-->
  <div class="gmshuliangBox">
    <form action="/Users/mallConfirmSave" method="get" class="form">
      <input type="hidden" name="checkFlag" id="checkFlag" value="" />
      <input type="hidden" name="ticket_id" value="{$goods.id}" />
      <div class="gmshuliangBoxCenter"> </div>
    </form>
  </div>
    <table class="proshowList" id="goods_list" cellpadding="0" cellspacing="0" border="1">
    </table>
  <div class="c"></div>
  <div class="page-bar">

      <div class="page-bar">
          <div id="page">
          </div>
      </div>
  </div>
</div>
@include('temporary.footer')
@include('temporary.rightnav')

<script type="text/javascript">
    jQuery(".douban").slide({
        mainCell: ".bd ul",
        effect: "left",
        delayTime: 800,
        vis: 5,
        scroll: 5,
        pnLoop: false,
        trigger: "click",
        easing: "easeOutCubic"
    });</script>
<script>
    window.onload = function() {
        get_goods();
        get_supplier();
        get_brand();
    }
    //商品列表
    function get_goods() {
        var order = '',p='',search='',supplier='',brand='',days='';
        order = $('#order_input').val();
        p = $('#page_input').val();
        search = $('#search_input').val();
        supplier = $('#suppliers_input').val();
        brand = $('#brand_input').val();
        days = $('#days_input').val();
        var html='<tr><th style="padding: 15px; border: none;" class="pinpai">ID</th>' +
            '        <th style="padding: 15px; border: none;" class="xinghao">品牌</th>' +
            '        <th style="padding: 15px; border: none;" class="xinghao">型号</th>' +
            '        <th style="padding: 15px; border: none;" class="leibei">类别</th>' +
            '        <th style="padding: 15px; border: none;" class="leibei">仓库</th>' +
            '        <th style="padding: 15px; border: none;" class="zhongliang">重量</th>' +
            '        <th style="padding: 15px; border: none;" class="kucun">库存</th>' +
            '        <th style="padding: 15px; border: none;" class="qihuo">期货</th>' +
            '        <th style="padding: 15px; border: none;" class="jiage">价格</th></tr>';
        var brand_images='';
        var repository = '';
        var weight = '';
        var price = '';
        var page_html='';
        var goods_type ='';
        var next ='';
        var next_next ='';
        var goods_days ='';
        var pre ='';
        var p = p;
        $.ajax({
            type: "POST",
            url:"{{url('api/goods')}}",
            contentType: "application/x-www-form-urlencoded",
            dataType: 'JSON',
            data:{page:p,search:search,supplier:supplier,brand:brand,order:order,days:days},
            success:function(ret){
                var data = ret.data;
                if(data.length>0){
                    $.each(data, function(k, goods) {
                        if(goods.image.length==0){
                            brand_images = '<img src="http://www.gpmro.com/home/images/gpmro.gif" width="82" height="42">';
                        }else{
                            brand_images = ' <img src="http://'+goods.image+'" width="82" height="42">';
                        }
                        if(goods.weight){
                            weight = goods.weight+ ' KG';
                        }else{
                            weight = '暂无';
                        }
                        if(goods.repository){
                            repository = goods.repository;
                        }else{
                            repository = '未知';
                        }

                        if (goods.type)
                        {
                            goods_type=  goods.type;
                        }else {
                            goods_type='未知';
                        }
                        if (goods.days)
                        {
                            goods_days=  goods.days;
                        }else {
                            goods_days='未知';
                        }

                        html += '<tr>' +
                            '          <td class="pinpai" style="width: 150px;padding:0;">' + goods.id + ' </td>\n' +
                            '          <td class="pinpai" style="width: 150px;padding:0;">' + goods.brand + ' </td>\n' +
                            '          <td class="xinghao" style=" width:150px; padding:0; overflow:hidden;">' + goods.model +'</td>' +
                            '          <td class="leibei" style="width: 110px;padding:0;">'+goods_type+'</td>\n' +
                            '          <td class="leibei" style="width: 110px;padding:0;">'+ repository+ '</td>\n' +
                            '          <td class="zhongliang" style="width: 110px;padding:0;">'+weight+'</td>\n' +
                            '          <td class="kucun" style="width: 110px;padding:0;">'+ goods.number +'</td>\n'+
                            '          <td class="kucun" style="width: 110px;padding:0;">'+ goods_days +'</td>\n'

                        if(goods.price_a>0){
                            html+= '          <td class="leibei" style="width: 110px;padding:0;"><span>￥'+goods.price_a+'</span></td>\n';
                        }else{
                            html+= '          <td class="leibei" style="width: 110px;padding:0;"><a href="javascript:;" title="电话/微信：18051116758">请咨询</a></td>\n';

                        }
                        html+= '        </tr>'
                    });
                    $('#goods_list').html(html);
                    var page = ret.meta;
                    var current_page = page.pagination.current_page;
                    var total_pages = page.pagination.total_pages;
                    var num_page = 0;
                    if(current_page >6){
                        num_page =current_page-1;
                        page_html += '<a class="first" onclick="page(1)">1...</a>'+
                            '<a class="prev" onclick="page('+ num_page +')">&lt;&lt;</a>';
                    }else if(current_page>1){
                        num_page =current_page-1;
                        page_html +='<a class="prev" onclick="page('+ num_page +')">&lt;&lt;</a>';
                    }else{
                        page_html +='<a class="prev" onclick="page('+ current_page +')">&lt;&lt;</a>';
                    }
                    for(var i=1,j=5;i<=5;i++,j--){
                        num_page = current_page-j;
                        if(0 < num_page){
                            pre += '<a class="num" onclick="page('+ num_page +')">'+ num_page+'</a>';
                        }
                        num_page = current_page+i;
                        if(total_pages>=num_page){
                            next += '<a class="num" onclick="page('+ num_page +')">'+ num_page+'</a>';
                        }
                        num_page = current_page+5+i;
                        if(current_page<6&&num_page<13&&num_page<=total_pages){
                            next_next += '<a class="num" onclick="page('+ num_page +')">'+ num_page+'</a>';
                        }
                    }
                    page_html = page_html+pre +
                        '<span class="current">'+current_page+'</span>'+
                        next+next_next+'<a class="next"onclick="page('+ current_page+1 +')">&gt;&gt;</a>'+ '<a class="end"  onclick="page('+ total_pages +')">'+
                        total_pages +'</a>';
                    $('#page').html(page_html);
                }
                else {
                    $('#page').empty();
                    $('#goods_list').html( '<div style="text-align: center">暂无数据</div>');
                }

            }
        });
    }
    function page(p){
        $('#page_input').val(p);
        get_goods();

    }
    function go_search() {
        var key_words = $('#key').val();
        $('#search_input').val(key_words);
        $('#page_input').val(1);
        $('#order_input').val('');
        // $('#suppliers_input').val('');
        $('#brand_input').val($("#brand_select").val());
        $('#days_input').val($("#days").val());
        console.log($("#days").val())
        go_order(0);
    }
    function go_order(a) {
        $('#page_input').val(1);
        if(a==1){
            $('.order').removeClass('active');
            $('.order_kc').addClass('active');
            if($('.order_kc').hasClass('down')){
                $('.order').removeClass('down');
                $('#order_input').val('number_asc');
            }else{
                $('.order').removeClass('down');
                $('.order_kc').addClass('down');
                $('#order_input').val('number_desc');
            }
        }else if(a==2){
            $('.order').removeClass('active');
            $('.order_pr').addClass('active');
            if($('.order_pr').hasClass('down')){
                $('.order').removeClass('down');
                $('#order_input').val('price_asc');
            }else{
                $('.order').removeClass('down');
                $('.order_pr').addClass('down');
                $('#order_input').val('price_desc');
            }
        }else{
            $('.order').removeClass('active');
            $('.order').removeClass('down');
            $('#order_input').val('');
        }
        get_goods();
    }

    function go_suppliers(a) {
        $('#suppliers_input').val(a);
        // $('#search_input').val('');
        $('#page_input').val(1);
        $('#order_input').val('');
        // $('#brand_input').val('');
        $('.typeIdClick').removeClass('valueListLi');
        $('.typeIdClick').removeClass('b5f8409');
        $('#'+a).addClass('b5f8409');
        $('#'+a).addClass('valueListLi');
        go_order(0);
    }
    function go_brand(a) {
        // $('#search_input').val('');
        $('#page_input').val(1);
        $('#order_input').val('');
        // $('#suppliers_input').val('');
        $('#brand_input').val(a);
        $('.typeIdClick').removeClass('valueListLi');
        $('.typeIdClick').removeClass('b5f8409');
       var aa=document.getElementById(a)
        aa.className +=' b5f8409';
        aa.className +=' valueListLi';
        go_order(0);
    }
    //供应商列表
    function get_supplier() {
        var html='';
        var cs_more = '';
        $.ajax({
            type: "GET",
            url:"{{url('api/suppliers')}}",
            contentType: "application/x-www-form-urlencoded",
            dataType: 'JSON',
            success:function(ret){
                var data = ret;
                if(data.length > 16){
                    cs_more = 'more';
                }
                if(data.length>0){
                    $.each(data, function(m, suppliers) {
                        html += '<li id="'+suppliers+'" onclick="go_suppliers(\''+suppliers+'\')" class=" '+cs_more+' typeIdClick b5f8409 ">'+suppliers+'</li>'
                    });
                    html += '<div class="clear-both"></div>';
                    $('#suppliers_list').html(html);
                }
            }
        });
    }


    //仓库列表
    function get_brand() {
        var html='';
        var html2='<option   value="" >请选择型号</option>';
        $.ajax({
            type: "GET",
            url:"{{url('api/brands')}}",
            contentType: "application/x-www-form-urlencoded",
            dataType: 'JSON',
            success:function(ret){
                var data = ret;
                if(data.length>0){
                    $.each(data, function(m, brand) {
                        // html += '<li id="'+brand+'" onclick="go_brand(\''+brand+'\')" class="typeIdClick stockIdclick b5f8409">'+brand+'</li>';
                        html2 += '<option id="'+brand+'" value="'+brand+'" >'+brand+'</option>';
                    });
                    // html2 += '<div class="clear-both"></div>';
                    $('#brand_select').html(html2);
                }
            }
        });
    }
    $(function(){

        $('.filters tr td:first').css('width','74px');

        if($('.product ul').length>0){
            if($('.product li').length==0){
                $('.tish_inopro').show();
            }
        }
        if( $(".noproductts").length > 0){
            $('.tish_inopro').hide();
        }


        var t =  $('.peizhifangan');
        t.val('如果您对想要购买的产品不够了解，可以写下您对产品的需求，包括产品型号、品牌、数量及交货期等，也可以告诉我们您的工况及期许，提交成功后我们将立即与您联系确认。');
        var default_value = t.val();
        t.focus(function(){
            if(t.val()==default_value){
                t.val("");
            }
        });
        t.blur(function(){
            if(t.val()==""){
                t.val(default_value);
            }
        });
        /*//增加数量
         $('.btn_plus').click(function(){
         var num	=	parseInt($('#num').val())+1;
         if( num > $(this).attr('data') ){
         layer.alert('订购数量超出限制,最多为'+$(this).attr('data')+'件');
         return false;
         }
         $('#num').val(num);
         });
         $('.btn_reduce').click(function(){
         var num	=	parseInt($('#num').val())-1<1?1:parseInt($('#num').val())-1;
         $('#num').val(num);
         });
         //商城产品加入购物车
         $('body').delegate('.addCart','click',function(){
         $('#checkFlag').val('0');
         $('.'+$(this).attr('id')).attr('action','/Users/mallReserveSave');
         formSubmit($(this));
         });*/


        $(".nrr li").click(function(){
            var that = $(this);
            that.addClass("brandType").siblings().removeClass("brandType");
            /*  $(".brand li").click(function(){
             var that = $(this);
             that.addClass("brandClick").siblings().removeClass("brandClick");
             });*/


            that.parent().parent().next().find('li').each(function(){
                if($(this).attr("type") ==that.attr("data")){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });
        });

    })

</script>
<script src="http://www.gpmro.com/home/js/category.js"></script>

</body>
</html>


