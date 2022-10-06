<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form role="form" id="add_category" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="menu">Tên danh mục</label>
                        <input class="form-control  @error('name') is-invalid  @enderror" name="name" id="name" placeholder="Nhập tên danh mục">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="InputName">Chọn danh mục cha:</label>
                        <select id="parent_id" class="form-control" name="parent_id">
                            <option value="0">Danh mục cha</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="status" checked="">
                            <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="status" >
                            <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>
                @include('errors.check_error')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                    <button type="submit" data-url="{{route('categories.store')}}" class="btn btn-primary btn_category" >Thêm danh mục</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
