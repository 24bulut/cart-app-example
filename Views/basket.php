
<div class="container mt-3">

<?php if (App\Models\Customer::Authorization()) :?>
        
        
<table class="table">
  <thead>
    <tr>
      <th>Ürün adı</th>
      <th>Fotoğraf</th>
      <th>Adet</th>
      <th>Birim fiyatı</th>
      <th>Fiyat</th>
      <th>İşlemler</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $totalPrice= 0;
    $totalCount= 0;
    foreach ($params['products'] as $product) :
      $totalPrice += $product['price']*$product['quantity'];
      $totalCount += $product['quantity'];
    ?>
      <tr id="row-<?php echo  $product['basket_id'] ?>">
        <td><?php echo $product['name'] ?></td>
        <td><img src="https://images-na.ssl-images-amazon.com/images/I/61oQly6YbHL._AC_SL1500_.jpg"  style="width: 50px !important;height:auto" class="card-img-top" alt=""></td>
        <td><input  type="number" class="form-control"  name="" min="0" onchange="calculate(this)" style="width: 80px;" value="<?php echo (int)$product['quantity'] ?>" id="<?php echo  $product['basket_id'] ?>"></td>
        <td><span  id="unit-product-price-<?php echo  $product['basket_id'] ?>" ><?php echo (float)$product['price']; ?></span> ₺</td>
        <td><span  id="total-product-price-<?php echo  $product['basket_id'] ?>" ><?php echo (float)$product['price']*(float)$product['quantity']; ?></span> ₺</td>
        <td><button type="button" class="btn btn-danger" onclick="updateQuantity(0,<?php echo  $product['basket_id'] ?>)">Sepetten sil</button></td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>

<?php else:?>

<h4 class="text-center mt-5">Sepeti görüntülemek için lütfen giriş yapınız</h4>
<?php endif;?>

</div>



<script>

function calculate(input) {
  let quantity = $(input).val();
  let basketId = $(input).attr('id');
  let unitPrice = parseFloat($('#unit-product-price-'+basketId).text());
  updateQuantity(quantity,basketId);
  let total = (quantity*unitPrice);
  $('#total-product-price-'+basketId).text(Number.parseFloat(total).toFixed(2));

}
function updateQuantity(quantity,basketId) {
  if (quantity<=0) {
    $('#row-'+basketId).remove();
  }
  $.post( "<?php echo  url('basket') ?>"+"/"+basketId, { "quantity": quantity })
  .done(function( data ) {
    console.log(data);
    response = JSON.parse(data);
    $.notify(response.message, "info");
  });
}

</script>