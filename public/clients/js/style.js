// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}
$('.add_to_cart').click(function (event) {
    event.preventDefault()
    let urlRequest = $(this).data('url')
    $.ajax({
        url: urlRequest,
        type: 'GET',
        // dataType: 'json',
        success: function (response) {
                RenderCart(response)
                alertify.set('notifier','position', 'top-right');
                alertify.success('Thêm vào giỏ hàng thành công');
        },
        error:function (error) {
            alertify.error('Thêm sản phẩm không thành công');
        }

    })
})

function RenderCart(response){
    $("#change-item-cart").empty();
    $("#change-item-cart").html(response);
    $("#total-quanty-show").text($("#total-quanty-cart").val());
}

// Update cart

function updateListItemCart(id){
    let pro_quanty = $('#pro_quantity').val()
    let button = $(this);
    let quantity = $("#quanty-item-"+id).val()
    $.ajax({
        url: 'cart/update-cart/'+id+'/'+ quantity,
        type: 'GET',
        success: function(response) {
            if(pro_quanty <= quantity) {
                let quanty = $(this).parents('tr').find('input.quantity').val()
                console.log(quanty)
                alertify.warning('Vui lòng nhập số lượng sản phẩm nhỏ hơn ' + pro_quanty);
            }
            if(pro_quanty > quantity){
                RenderListCart(response);
                alertify.success('Đã cập nhật sản phẩm');
                // location.reload()
            }


        },
        error: function (err){
            console.error(err)

        }
    })
}

function RenderListCart(response){
    $("#list-cart").empty();
    $("#list-cart").html(response);
    $("#total-quanty-show").text($("#total-quanty-cart").val());
}


function cartDelete(event){
    event.preventDefault();
    let id = $(this).data('id');
    let urlDelete = $(this).data('url')
    $.ajax({
        type: 'GET',
        url: urlDelete,
        data: {id: id},
        success:function (data) {
            if(data.code === 200){
                RenderListCart(data);
            }
            alertify.set('notifier','position', 'top-right');
            alertify.success('Xóa giỏ hàng thành công');
            location.reload();
        },
        error:function (error) {

        }
    })
}

$(function () {
    $('.cart_delete').click(cartDelete)
})


// Delete Item cart
// $("#change-item-cart").on("click", ".si-close i" , function(){
//     $.ajax({
//         url: 'Delete-Item-Cart/'+$(this).data("id"),
//         type: 'GET',
//     }).done(function(response) {
//         RenderCart(response);
//         alertify.success('Đã xóa sản phẩm');
//     });
// });


