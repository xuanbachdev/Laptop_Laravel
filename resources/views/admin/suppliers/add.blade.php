<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm nhà cung cấp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form role="form" id="insert_supplier" }>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="InputName">Tên nhà cung cấp:</label>
                        <input type="text" name="name" id="name" class="form-control"
                               placeholder="Nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="InputName">Email:</label>
                        <input type="text" name="email" id="email" class="form-control"
                               placeholder="Nhập Email">
                    </div>
                    <div class="form-group">
                        <label for="InputName">Số Điện Thoại:</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                               placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="InputName">Địa Chỉ:</label>
                        <input type="text" name="address" id="address" class="form-control"
                               placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group">
                        <label>Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                            <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                            <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>
                @include('errors.check_error')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                    <button type="button" data-url="{{ route('suppliers.store') }}" class="btn btn-primary btn_supplier">Thêm nhà cung cấp</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
