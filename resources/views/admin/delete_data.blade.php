<a class="btn btn-sm btn-warning delete-data" data-toggle="modal" data-target="#myModal">条件删除</a>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title"></h4>
        </div>
        <form action="/admin/goods/delete" method="post" id="deleteData">
            <div class="modal-body">
                <div class="form-group">
                    <label>品牌</label>
                    <input type="text" id="brand" name="brand" value="" class="form-control brand action" placeholder="输入 品牌">
                </div>
                <div class="form-group">
                    <label>类型</label>
                    <input type="text" id="type" name="type" value="" class="form-control type action" placeholder="输入 类型">
                </div>
                <div class="form-group">
                    <label>型号</label>
                    <input type="text" id="model" name="model" value="" class="form-control model action" placeholder="输入 型号">
                </div>
                <div class="form-group">
                    <label>库存小于</label>
                    <input type="text" id="number" name="number" value="" class="form-control number action" placeholder="输入 库存小于">
                </div>
                <div class="form-group">
                    <label>产地</label>
                    <input type="text" id="product_area" name="product_area" value="" class="form-control product_area action" placeholder="输入 产地">
                </div>
                <div class="form-group">
                    <label>对接价格小于</label>
                    <input type="text" id="price" name="price" value="" class="form-control price action" placeholder="输入 对接价格小于">
                </div>
                <div class="form-group">
                    <label>供应商</label>
                    <input type="text" id="supplier" name="supplier" value="" class="form-control supplier action" placeholder="输入 供应商">
                </div>
                <div class="form-group">
                    <label>仓库名称</label>
                    <input type="text" id="repository" name="repository" value="" class="form-control repository action" placeholder="输入 仓库名称">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="checkForm()">提交</button>
            </div>
            {{csrf_field()}}
        </form>
    </div>
    <script>
        function checkForm() {
            Swal.fire({
                type: 'warning', // 弹框类型
                title: '删除数据', //标题
                text: "删除后将无法恢复，请谨慎操作！", //显示内容

                confirmButtonColor: '#3085d6',// 确定按钮的 颜色
                confirmButtonText: '确定',// 确定按钮的 文字
                showCancelButton: true, // 是否显示取消按钮
                cancelButtonColor: '#d33', // 取消按钮的 颜色
                cancelButtonText: "取消", // 取消按钮的 文字

                focusCancel: true, // 是否聚焦 取消按钮
            }).then((isConfirm) => {
                try {
                    //判断 是否 点击的 确定按钮
                    if (isConfirm.value) {
                        $('#deleteData').submit();
                    }
                    else {
                        Swal.fire("取消", "取消操作", "error");
                    }
                } catch (e) {
                    alert(e);
                }
            });
            return false;
        }
    </script>
    <!-- /.modal-content -->
</div>
</div>