$(document).ready(function () {
  $('.btn').on('click', function (e) {
      e.preventDefault();
      var form = $(this).closest('form');
      var formData = form.serialize();

      $.ajax({
          type: 'POST',
          url: 'add_to_cart.php',
          data: formData,
          dataType: 'json',
          success: function (response) {
              if (response.success) {
                  alert(response.message); // Thông báo thành công
                  // Cập nhật số lượng sản phẩm trong giỏ hàng (nếu cần)
              } else {
                  alert(response.message); // Thông báo lỗi
              }
          }
      });
  });
});
