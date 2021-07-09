

<div class="container mt-3">

<div class="row row-cols-1 row-cols-md-4 g-4">
  <?php foreach ($params['products'] as $product) :?>
  <div class="col">
    <div class="card h-100">
      <img src="https://images-na.ssl-images-amazon.com/images/I/61oQly6YbHL._AC_SL1500_.jpg" class="card-img-top" alt="">
      <div class="card-body">
        <h5 class="card-title"><?php echo $product['name'] ?></h5>
        <p class="card-text"><?php echo $product['price'].' ₺' ?></p>
        <div class="row">
          <div class="col-7">
            <button button type="button"  class="btn btn-primary" onclick="addItem(<?php echo  $product['id'] ?>)">Sepete Ekle</button>
          </div>
          <div class="col-5">
            <input type="number" class="form-control"  name="" min="1" value="1" id="quantity-<?php echo  $product['id'] ?>">
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

</div>

<script></script>
<script>
function addItem(product_id){
  let quantity= $('#quantity-'+product_id).val();
  $.post( "<?php echo  url('basket') ?>", { "product_id": product_id, "quantity": quantity })
  .done(function( data ) {
    response = JSON.parse(data);
    console.log(response);
    $.notify(response.message, "info");
  });
}
</script>