
$('.btn_category').click(function (event) {
    event.preventDefault();
    $('.sub_error').hide();
    var _token = $("input[name='_token']").val();
    var name = $('#name').val();
    var parent_id = $('#parent_id').val();
    var status =  $('input[name="status"]:checked').val();
    let urlRequest = $(this).data('url');
    $.ajax({
        url: urlRequest,
        type: 'POST',
        data: { _token: _token, name: name, parent_id: parent_id, status: status },
        success: function (data) {
            if (data.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Thêm danh mục thành công',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#add_category')[0].reset();
            }
            setTimeout(function(){
                window.location.reload(1);
            }, 500);
        },
        error: function (err) {
            if (err.status == 422) { // when status code is 422, it's a validation issue
                console.log(err.responseJSON);
                // $('#success_message').fadeIn().html(err.responseJSON.message);

                // you can loop through the errors object and show it to the user
                console.warn(err.responseJSON.errors);
                // display errors on each form field
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.after($('<span class= "sub_error" style="color: red;">' + error[0] + '</span>'));
                });
            }
        }
    });
});


// Delete Category

$('.action_delete').click(function(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xoá?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonText: 'Không',
        confirmButtonText: 'Có, xoá nó!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success:function (data){
                    if (data.code == 200){
                        that.parent().parent().remove();
                        Swal.fire(
                            'Đã Xóa!',
                            'Xóa danh mục sản phẩm thành công.',
                            'success'
                        )
                    }
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 500);
                },
                error: function(){
                }

            });
        }
    });
});
