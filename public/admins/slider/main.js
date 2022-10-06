
// Delete slider

$('.action_delete').click(function(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');

    let that = $(this);
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xoá?',
        // text: "Bạn sẽ không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Không',
        confirmButtonText: 'Xác nhận'
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
                            'Xóa slider thành công.',
                            'success'
                        )
                    }
                },
                error: function(){
                }

            });
        }
    });
});
