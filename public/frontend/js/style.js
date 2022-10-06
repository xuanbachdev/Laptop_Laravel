function register() {
  showCustomloading();
  let customer = {
    name: $("#nameCustomer").val(),
    email: $("#emailCustomer").val(),
    phone: $("#phoneCustomer").val(),
    message: $("#messageCustomer").val()
  };
  $.ajax({
    url: "/api/v1/customer",
    method: "POST",
    data: customer
  })
    .done(res => {
      hideCustomloading();
      $("#m-a-a").modal("show");
    })
    .fail(() => {
      hideCustomloading();
      alert(
        ""
      );
    });
}

function hideCustomloading() {
  $('#ctn-loading').fadeOut(); // will first fade out the loading animation
  $('#overlay-loading').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
}

function showCustomloading() {
  $('#ctn-loading').fadeIn(); // will first fade out the loading animation
  $('#overlay-loading').delay(350).fadeIn('slow'); // will fade out the white DIV that covers the website.
}
