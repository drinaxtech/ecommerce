<?php $this->setSiteTitle('drxshop - '. $product->name); ?>

<?php $this->start('body'); ?>

<?php 

$productSold = isset($ordersNumber[$product->product_id]) ? intval($ordersNumber[$product->product_id]) : 0;

$maxProductLeft = intval($product->quantity) - $productSold;

?>

<main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <img src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $product->image; ?>" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
              <a href="">
                <span id="product-name" class="badge purple mr-1"><?php echo $product->name; ?></span>
              </a>
            </div>

            <?php if(isset($ordersNumber[$product->product_id]) && $ordersNumber[$product->product_id] >= intval($product->quantity)): ?>
              <span id="product-name" class="badge red mr-1 mb-3" style="height: 30px;padding-top: 8px;width: 80px;">
                SOLD OUT
              </span>
            <?php endif; ?>  

            <p class="lead">
              <span>$<?php echo number_format($product->price, 2); ?></span>
            </p>

            <p class="lead font-weight-bold"><?php echo $product->product_name; ?></p>

            <input type="hidden" id="productName" value="<?php echo $product->product_name; ?>">

            <p><?php echo $product->description; ?></p>

            
            <?php if(isset($ordersNumber[$product->product_id]) && $ordersNumber[$product->product_id] >= intval($product->quantity)): ?>
              
            <?php else: ?>  

            <form class="d-flex justify-content-left">
              <!-- Default input -->
              <input type="number" value="1" min="0" max="<?php echo $maxProductLeft; ?>" id="quantity" data-productId="<?php echo $product->product_id; ?>" aria-label="Search" class="form-control" style="width: 100px">
              <button class="btn btn-primary btn-md my-0 p" type="button" onclick="addToCart(this, '<?php echo $product->price; ?>')">Add to cart
                <i class="fa fa-shopping-cart ml-1"></i>
              </button>

            </form>

            <?php endif; ?>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>


    </div>
  </main>

<?php $this->end(); ?>

<?php $this->start('footer'); ?>
<script>
</script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/alertify.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/home/app.js"></script>

<?php $this->end(); ?>