<!--
 右侧导航条
 -->
<style>
  /*  .tsts{
        float: left; line-height: 75px;padding-left: 25px; margin-left: 25px;color: red;display: none;  background: url("http://www.gpmro.com/home/images/wwd_03.jpg") 0px center no-repeat;
    }*/
    .layui-layer{
        z-index: 999999999999999999!important;
    }
  #msg{position:fixed; top:300px; right:35px; z-index:10000; width:1px; height:52px; line-height:52px; font-size:20px; text-align:center; color:#fff; background:#ffac13; display:none}
  .layui-layer{
      top: inherit;
  }
</style>
<div id="msg">已成功加入购物车！</div>
<div class="right_NavBox ie_fixed">
    <div id="right_Nav">
        <div class="nav_z">
        
        
            <div class="huiyuan vipuser" id="gpmUser">
                <i class="tab-ico"></i>
                <span class="tab-text">会员中心</span>
            </div>

    
    
    
            <div class="huiyuan" id="shoppingCart">
                <div class="count mallcart"></div>
                <i class="tab-ico7"></i>
                <span class="tab-text">购物车</span>
            </div>
            <div class="huiyuan" id="weixinicon">
                <i class="tab-ico2"></i>
                <img class="erweima" src="http://www.gpmro.com/home/images/follow_qr.jpg">
            </div>
            <div class="huiyuan"  id="qqzixuna">
                <i class="tab-ico6"></i>
                <span  class="tab-text">在线咨询</span>
            </div>
            <div class="huiyuan" id="ali">
                <a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=%E5%B7%A5%E5%93%81%E7%8C%AB%E4%BF%A1%E6%81%AF%E7%A7%91%E6%8A%80&site=cnalichn&s=10&charset=UTF-8">
                    <i class="tab-ico5"></i>
                    <span class="tab-text">旺旺客服</span>
                </a>
            </div>
            <div class="huiyuan" id="onlicikMessage">
                <i class="tab-ico4"></i>
                <span class="tab-text">意见反馈</span>
            </div>
            <div class="huiyuan returnTop" id="fhdb">
                <i class="tab-ico3"></i>
                <span class="tab-text">返回顶部</span>
            </div>
        </div>
    </div>
    <div class="cartBox">
        <img style="margin-top: 50px; margin-left: 100px;" id="loader" src="http://www.gpmro.com/home/images/loader.gif" width="80" height="80">
    </div>
</div>
<!--在线咨询-->
<div class="diloge" id="onlineContact">
    <div class="contactBox">
        <div class="contactBox_contain">
            <img class="close" src="http://www.gpmro.com/home/images/close.png">
            <ul class="kefuNav">
                <li class="on">在线客服</li>
                <li>发票政策</li>
                <li>售后政策</li>
                <li>关于我们</li>
            </ul>
            <div class="kefu_contain active">
                <div class="qq">
                    <img src="http://www.gpmro.com/home/images/dfew_03.jpg">
                    <ul>
                        <li><a href="http://wpa.qq.com/msgrd?v=3&uin=3354826692&site=qq&menu=yes" target="_blank">轴承客服</a></li>
                        <li><a href="http://wpa.qq.com/msgrd?v=3&uin=2437184354&site=qq&menu=yes" target="_blank">电器客服</a></li>
                        <!--<li><a href="tencent://message/?uin=202744518&Site=工品猫&Menu=yes" target="_blank">投诉与建议</a></li>-->
                    </ul>
                </div>
                <div class="qq wangwang">
                    <img style="margin-right: 8px;" src="http://www.gpmro.com/home/images/dfew_05.jpg">
                    <ul>
                        <li><a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=%E5%B7%A5%E5%93%81%E7%8C%AB%E4%BF%A1%E6%81%AF%E7%A7%91%E6%8A%80&site=cnalichn&s=10&charset=UTF-8">商城客服</a></li>
                        <li><a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=%E5%B7%A5%E5%93%81%E7%8C%AB&site=cnalichn&s=10&charset=UTF-8">投诉与建议</a></li>
                    </ul>
                </div>
            </div>
            <div class="kefu_contain">
                <span style="font-size: 16px;font-weight: bold;">如何开具发票</span><br>
                如需开具发票，请在确认订单信息时勾选需要开具的发票类型。<br>
                如果您是首次开具增值税专用发票，需填写纳税人识别号等开票信息（如图），<br>
                <img src="/upload/image/20161122/20161122040118_54678.png" width="523" height="292">
                并提供加盖公章的营业执照副本、税务登记证副本、一般纳税人资格证书及银行开户许可证扫描件给到对应拓展商，收到您的开票资料后，我们会尽快审核。<br>
                <br>
                <span style="font-size: 16px;font-weight: bold;">发票交付方式</span><br>
                发票为重要文件，为保护贵方的权益，所有发票不随货发送，将另行通过快递寄送。<br>
                相关注意事项<br>
                1、为保证发票及时准确的送达，请确保联系人及邮寄地址正确无误；收到工品猫的发票后，请您正楷签收。<br>
                2、企业用户的开票信息可在“<span style="font-weight: bold;">用户中心→开票资料</span>”中进行编辑修改。
            </div>
            <div class="kefu_contain">
                <span style="font-weight: bold; font-size: 14px;">工品猫工业品采购网有限保证（180天有限质量保证）</span><br>
                工品猫工业品采购网向客户保证，除非另有规定，自购买日后一百八十（180）天内，在正常使用的情况下，所有商品均无工艺或材料缺陷。自购买日后一百八（180）天内，如果发生商品的工艺或材料的质量问题，根据工品猫的确认后您可将商品送至工品猫指定的地点选择换货或维修（消耗性商品及部分商品除外），同时须附上发票原件和相关文件。<br>
                制造商质量保证与工品猫有限质量保证时效相比，以较长时间的一方为准。<br>
                商品在材料商或工艺上是否存在缺陷，由工品猫确定。维修或换货是工品猫对客户可能提供的全部补偿。除上述保证以及工品猫或商品的制造商明确做出保证以外，工品猫未作出适用法律规定以外的任何默示或其它的保证。<br>
                以下情况将不适用与工品猫有限保证：<br>
                1、未能出具工品猫开具的购买发票的；<br>
                2、因不可抗力造成损坏的；<br>
                3、因自身使用、维护、保管不当造成损坏的；<br>
                4、商品经非工品猫授权维修者拆动或维修造成损坏的；<br>
                5、目录商品选择不当或应用不当的。<br>
                <span style="font-weight: bold; font-size: 14px;">维修说明</span><br>
                工品猫工业品采购网在商品对应的质量保质期内对商品质量问题提供免费维修服务；工品猫工业品采购网在商品对应的质量保证期内非商品质量问题（包括耗材）及超过工品猫保质期的商品提供收费维修服务。现金客户需确认收到客户维修费才能寄回修复商品。<br>
                <span style="font-weight: bold; font-size: 14px;">寄回产品说明</span><br>
                客户寄回商品时需要在包装里要有如下书面内容：受理编号、客户联系人及联系方式，需退换修的商品工品猫编号、数量。<br>
                客户需保证商品原包装完整、数量准确，客户快递单不能直接粘贴在商品原包装上。<br>
                客户需要对返回的商品妥善包装，如果是由于客户原因导致包装过于简单，造成的物流损坏，工品猫不承担商品完整责任。<br>
                寄回运费由客户自行负责，因工业品属于大件，本平台不承担维修运费。<br>
            </div>
            <div class="kefu_contain">
                工品猫（www.gpmro.com）是一个专门做工业品线上销售、线下服务的互联网平台。凭借多年从事工业贸易积累的经验和优秀的管理运营团队，通过去中间化，控制物流渠道，提高 服务质量，努力为企业提供专业化、个性化、全方位、一站式服务，帮助生产制造型企业降低采购成本、杜绝假冒伪劣产品，降低“中国制造”的实际成本，提升产品品质和国际竞争力。<br>
                工品猫本着“以提升效能为本，帮助客户专注核心优势，降低采购及营销成本，优化供应链，增强客户竞争力 ”的经营理念指导理念，坚持“正品，方便”的价值观，不断努力开拓，贴近客户，换位思考，竭诚为客户选择和提供性价比最高的产品和服务，帮助客户减少采购、销售和运营成本，更加专注自身核心优势，最终达到提升客户竞争力之目的。互联网没有国界，努力服务好每一个客户是我们的责任。“助力中国制造不断向前”一直是我们的愿景和努力的方向，选择工品猫就是选择最优合作伙伴，助力您就是成就我们的未来！<br>
                企业愿景：打造国内首家互联网+工业品采购平台<br>
                经营理念：服务大于天，用心做好每一个客户<br>
                价 值 观：用心服务做正品<br>
                联系电话：0512-62626660<br>
                客服：0512-62933899<br>
                传真：0512-62933898<br>
            </div>
            <div class="kefuFooter">
                <img src="http://www.gpmro.com/home/images/dfew_10.jpg">
                <div>
                    0512-6262 6660<br>
                    <span>周一至周日 7:00—22:00</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--在线反馈-->
<div class="diloge onlineMessage" id="onlineMessage">
    <div class="contactBox">
        <form  method="post" id="messageForm">
            <div class="contactBox_contain">
                <img class="close" src="http://www.gpmro.com/home/images/close.png">
                <p>
                    请留下你对工品猫的意见或建议，感谢！<br>
                    <span>（如果有个人问题需要解决，请拨打0512-6262 6660）</span>
                </p>
                <div style="clear: both; overflow: hidden;">
                    <div style="padding-top: 20px;">
                        <p>反馈内容</p> <textarea id="textareafk" name="content"></textarea>
                    </div>
                    <div style="padding-top: 20px;line-height: 32px;">
                        <p>联系电话</p>
                        <input class="phonenum" id="phonenum"  type="text" name="phone">
                    </div>
                </div>
                <input class="tijiao  liuyanbtn" value="提 交" type="button">

                <!--<div class="tsts">rthrt</div>-->
            </div>
        </form>
    </div>
</div>


<script>

    $('.onliner li a').click(function(){
        var kefu = $(this).text();
        $.get(
                '/Public/liaotian',function(data){
                    layer.open({
                        type:1,
                        title:'正在和'+kefu+'聊天',
                        skin: 'layui-layer-lan',
                        maxmin: true,
                        area:['600px','512px'],
                        shade: 0 ,//不显示遮罩
                        content:data,

                        //最小化按钮的回调
                        min: function(layero){
                            layero.css({
                                left: 'auto',
                                top: 'inherit',
                                'right': 0,
                                'bottom':0
                            });
                        }
                    });
                }
        )
    });

    $('body').delegate('.liuyanbtn','click',function(){
        var content=$('#textareafk').val();
        var phone = $('#phonenum').val();
        var reg = /^1[3|4|5|7|8]\d{9}$/;
        if(content.length==0){
            layer.alert('请输入您的宝贵意见');
            return false;
        }
        if(!reg.test(phone)){
            layer.alert('请输入合法手机号');
            return false;
        }
        $.post('/Common/feedbackdo',{content:content,phone:phone},function(data){
            console.log(data);
            var dataArray = data.split('|||');
            if(dataArray[0] == '1'){
                layer.msg(dataArray[1],{ time: 1000 });
                $('#onlineMessage').fadeOut(150);
                $('#onlineMessage .contactBox').removeClass('ho');
                $('#textareafk').val('');
                $('#phonenum').val('');
            }else{
                layer.msg(dataArray[1],{ time: 1000 });
                $('#onlineMessage').fadeOut(150);
                $('#onlineMessage .contactBox').removeClass('ho');
                $('#textareafk').val('');
                $('#phonenum').val('');
            }
        });
    });

   $(function(){
       $('#qqzixuna').bind('click',function(){
           console.log('sdfds')
           $('#onlineContact').fadeIn(150);
           $('#onlineContact .contactBox').addClass('ho')
       });
   })
</script>


<!--
右侧导航条结束
-->