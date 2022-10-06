
// Add Supplier
$('.btn_supplier').click(function(event) {
    event.preventDefault();
    $('.sub_error').hide();
    let urlRequest = $(this).data('url');
    var _token = $("input[name='_token']").val();
    var name = $('#name').val();
    var email = $('#email').val();
    var phone_number = $('#phone_number').val();
    var address = $('#address').val();
    var active = $("input[name='active']").val();
    $.ajax({
        url: urlRequest,
        type: 'POST',
        data: { _token: _token, name: name, email: email, phone_number: phone_number, address: address, active:active },
        success: function (data) {
            if (data.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Thêm nhà cung cấp thành công',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#insert_supplier')[0].reset();
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


$('.edit_supplier').on('click',function(event){
    event.preventDefault();
    $('.sub_error').hide();
    let urlRequest = $(this).data('url');
    let data_href = $(this).data('href')
    var _token = $("input[name='_token']").val();
    var name = $('#name').val();
    var email = $('#email').val();
    var phone_number = $('#phone_number').val();
    var address = $('#address').val();
    var active = $("input[name='active']").val();
    $.ajax({
        url: urlRequest,
        type: 'POST',
        data: {_token:_token,name:name,email:email,phone_number:phone_number,address:address, active:active},
        success: function(data){
            if (data.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Sửa nhà cung cấp thành công',
                    showConfirmButton: false,
                    timer: 1500
                })
                window.setTimeout(function(){
                    location.href = data_href;
                } ,500);
            }
        },
        error: function(err){
            if (err.status == 422) { // when status code is 422, it's a validation issue
                console.log(err.responseJSON);
                // $('#success_message').fadeIn().html(err.responseJSON.message);

                // you can loop through the errors object and show it to the user
                console.warn(err.responseJSON.errors);
                // display errors on each form field
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="'+i+'"]');
                    el.after($('<span class= "sub_error" style="color: red;">'+error[0]+'</span>'));
                });
            }
        }
    });

});
// Delete Supplier

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
                            'Xóa nhà cung cấp thành công.',
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
