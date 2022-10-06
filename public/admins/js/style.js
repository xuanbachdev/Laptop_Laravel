

$('.action_delete').click(function(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');

    let that = $(this);
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xoá?',
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
                            'Xóa thành công.',
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

// Add role

$('.checkbox_wrapper').on('click', function(){
    $(this).parents('.card-js').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
})
$('.checkall').on('click', function() {
    $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
});

function actionOff(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');

    let that = $(this);
    Swal.fire({
        title: 'Xác nhận nghỉ làm?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success:function (data){
                    if (data.code == 200){
                        that.parent().parent().remove();
                        window.location.reload();
                        Swal.fire(
                            'Đã Xong!',
                            'Người này đã chuyển sang nghỉ làm',
                            'success'
                        )

                    }
                },
                error: function(){
                }

            });
        }
    });
};

$(function(){
    $(document).on('click', '.action_off', actionOff);

});





function actionRestore(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');

    let that = $(this);
    Swal.fire({
        title: 'Xác nhận?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success:function (data){
                    if (data.code == 200){
                        that.parent().parent().remove();
                        window.location.reload();
                        Swal.fire(
                            'Đã Xong!',
                            'Người này đã đi làm trở lại',
                            'success'
                        )

                    }
                },
                error: function(){
                }

            });
        }
    });
};

$(function(){
    $(document).on('click', '.action_restore', actionRestore);

});


    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);

    window.setTimeout(function() {
        $(".sub_error").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);

    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
    $('#output_img').attr('src', e.target.result);
}
    reader.readAsDataURL(input.files[0]);
}
}
    $("#input_img").change(function() {
    readURL(this);
});

    $(document).ready(function() {
        // const loadChart = () => {
        //     let url = 'bieu-do'
        //     console.log(url);
        //     $.ajax({
        //         type: 'GET',
        //         url: url,
        //         dataType: 'json',
        //         success: function (response) {
        //             showChart(response.times, response.values);
        //         },
        //     })
        //
        // }
        // loadChart()

        //config ajax
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        //

        // $('.btn-status').click(function(event){
        //         event.preventDefault();
        //         let urlRequest = $(this).data('url');
        //         let that = $(this);
        //         $.ajax({
        //             url: urlRequest,
        //             type: 'GET',
        //             success: function () {
        //                 Swal.fire({
        //                     position: 'top-end',
        //                     icon: 'success',
        //                     title: 'Thay đổi trạng thái thành công',
        //                     showConfirmButton: false,
        //                     timer: 2000
        //                 });
        //                 window.setTimeout(function(){
        //                     location.reload();
        //                     // location.href = urlRequest;
        //                 } ,0);
        //             }
        //         });
        //
        // });


        //
        // $('#example1').DataTable({
        //     "language": {
        //         "decimal":        "",
        //         "emptyTable":     "Không có dữ liệu!",
        //         "info":           "Hiển thị _START_ tới _END_ của _TOTAL_ dòng dữ liệu",
        //         "infoEmpty":      "Hiển thị 0 tới 0 của 0 dòng dữ liệu",
        //         "infoFiltered":   "(lọc ra từ _MAX_ tổng số dữ liệu)",
        //         "infoPostFix":    "",
        //         "thousands":      ",",
        //         "lengthMenu":     "Hiển thị _MENU_ dòng dữ liệu",
        //         "loadingRecords": "Đang tải...",
        //         "processing":     "Đang tiến hành xử lý...",
        //         "search":         "Tìm kiếm:",
        //         "zeroRecords":    "Không có dữ liệu!",
        //         "paginate": {
        //             "first":      "Đầu tiên",
        //             "last":       "Cuối cùng",
        //             "next":       "Kế tiếp",
        //             "previous":   "Trở lại"
        //         },
        //         "aria": {
        //             "sortAscending":  ": kích hoạt để sắp xếp cột tăng dần",
        //             "sortDescending": ": kích hoạt để sắp xếp cột giảm dần"
        //         }
        //     }
        // });

            $('#example').DataTable({

                "info": true,
                "language": {
                    "decimal":        "",
                    "emptyTable":     "Không có dữ liệu!",
                    "info":           "Hiển thị _START_ tới _END_ của _TOTAL_ dòng dữ liệu",
                    "infoEmpty":      "Hiển thị 0 tới 0 của 0 dòng dữ liệu",
                    "infoFiltered":   "(lọc ra từ _MAX_ tổng số dữ liệu)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Hiển thị _MENU_ dòng dữ liệu",
                    "loadingRecords": "Đang tải...",
                    "processing":     "Đang tiến hành xử lý...",
                    "search":         "Tìm kiếm:",
                    "zeroRecords":    "Không có dữ liệu!",
                    "paginate": {
                        "first":      "Đầu tiên",
                        "last":       "Cuối cùng",
                        "next":       "Kế tiếp",
                        "previous":   "Trở lại"
                    },
                    "aria": {
                        "sortAscending":  ": kích hoạt để sắp xếp cột tăng dần",
                        "sortDescending": ": kích hoạt để sắp xếp cột giảm dần"
                    }
                }
            });

        // swal("Good job!", "You clicked the button!", "success");


    } );
