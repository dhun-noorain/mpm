$(document).ready(function () {
  alert("Hi");
  let typeInput = $('#type');
  let priceInput = $('#price');
  let quantityInput = $('#quantity');
  let orderBtn = $('.btn-order');

  orderBtn.click(function() {
    quantityInput.val(1);
    let values = $(this).val().split(' ');
    let type = values[0];
    let price = values[1];
    typeInput.val(type);
    priceInput.val('N'+price);
  });

  quantityInput.change(function() {
    let cur_price = 0;
    switch(typeInput.val()) {
      case 'regular':
        cur_price = quantityInput.val() * 200;
        break;
      case 'vip':
        cur_price = quantityInput.val() * 250;
        break;
      case 'vvip':
        cur_price = quantityInput.val() * 300;
        break;
    }
    priceInput.val('N'+cur_price);
  });
});
