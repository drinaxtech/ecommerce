<?php $this->setSiteTitle('drxshop - '. $product->name); ?>
<?php $this->start('head'); ?>

    <link href="<?php echo BASE_URL; ?>assets/css/alertify_default.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/alertify.min.css" rel="stylesheet">

<?php $this->end(); ?>



<?php $this->start('body'); ?>

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

            <p class="lead">
              <span>$<?php echo number_format($product->price, 2); ?></span>
            </p>

            <p class="lead font-weight-bold"><?php echo $product->product_name; ?></p>

            <input type="hidden" id="productName" value="<?php echo $product->product_name; ?>">

            <p><?php echo $product->description; ?></p>

            <form class="d-flex justify-content-left">
              <!-- Default input -->
              <input type="number" value="1" id="quantity" data-productId="<?php echo $product->product_id; ?>" aria-label="Search" class="form-control" style="width: 100px">
              <button class="btn btn-primary btn-md my-0 p" type="button" onclick="addToCart(this, '<?php echo $product->price; ?>')">Add to cart
                <i class="fa fa-shopping-cart ml-1"></i>
              </button>

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Additional information</h4>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit voluptates,
            quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">

          <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>

<?php $this->end(); ?>

<?php $this->start('footer'); ?>
<script>
const BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/alertify.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/home/app.js"></script>

<?php $this->end(); ?>