<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>进度</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .ui-progressbar {
            position: relative;
        }
        .progress-label {
            position: absolute;
            left: 50%;
            top: 4px;
            font-weight: bold;
            text-shadow: 1px 1px 0 #fff;
        }
    </style>
</head>
<body>

<div id="progressbar">
    <div class="progress-label">Loading...</div>
</div>

<script>
    var progressbar = $( "#progressbar" ),
        progressLabel = $( ".progress-label" );
    $(function(){
        if(typeof(inteval) != 'undefined') {
            doClearInterval;
        } else {
            inteval = null;
        }
        // 开始
            //使用JQuery从后台获取JSON格式的数据
            $.ajax({
                type:"post",//请求方式
                url:"/api/progress/{{$queue}}",//发送请求地址
                // timeout:30000,//超时时间：30秒
                dataType:"json",//设置返回数据的格式
                //请求成功后的回调函数 data为json格式
                beforeSend: function() {
                    // 开始进度条
                    begeinProgress(10);
                },
                success:function(data){
                    console.log(data);
                    if(data.code == 0){
                        doClearInterval();
                        setProgress(progressbar, 100);
                        swal(data.msg)
                    }
                },
                //请求出错的处理
                error:function(){
                    doClearInterval();
                    alert("请求出错");
                }
            });
    })


    // 进度条长度
    var width = 0;
    function begeinProgress(t) {
        width = 1;
        interval = setInterval("doProgress()", t * 10);
    }
    // 设置进度
    function setProgress(node, width) {
        if (node) {
            progressbar.progressbar({
                value: width,
            });
            progressLabel.text(width + '%');
        }
    }
    // 循环进度
    function doProgress() {
        if(width == 98) {
            doClearInterval();
        }
        setProgress(progressbar, width);
        width++;
    }
    // 清除进度
    function doClearInterval() {
        clearInterval(interval);
    }

</script>

</body>
</html>