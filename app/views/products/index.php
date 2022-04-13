<?php $this->setSiteTitle('drxshop - Home'); ?>

<?php $this->start('head'); ?>

<style>

.single-item__image img {
    max-width: 100%;
    object-fit: cover;
    min-width: 100%;
    min-height: 100%;
}

.single-item__image {
    position: relative;
    height: 20vw;
    max-height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

</style>

<?php $this->end(); ?>


<?php $this->start('body'); ?>



<!--Main layout-->
<main style="margin-top: 100px">
    <div class="container">

      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

        <!-- Navbar brand -->
        <span class="navbar-brand">Categories:</span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active filter-bar">
              <a class="nav-link" href="javascript:;" onclick="showAllProducts(this)">All
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php if(is_countable($categories) && count($categories)): ?>
            <?php foreach($categories as $category): ?>
            <li class="nav-item filter-bar">
              <a class="nav-link" href="javascript:;" onclick="getCategoryProduct(this, '<?php echo $category->name; ?>')"><?php echo ucfirst($category->name); ?></a>
            </li>
            <?php endforeach; ?>
            <?php endif; ?>

          </ul>
          <!-- Links -->

          <form class="form-inline">
            <div class="md-form my-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div>
          </form>
        </div>
        <!-- Collapsible content -->

      </nav>
      <!--/.Navbar-->

      <!--Section: Products v.3-->
      <section class="text-center mb-4">

        <!--Grid row-->
        <div class="row wow fadeIn">


        <?php if(count($products) > 0): ?>
          <!-- Product column-->
          <?php foreach($products as $product): ?>
          <div class="col-lg-3 col-md-6 mb-4 product <?php echo $product->name; ?>">

            <!--Card-->
            <a href="<?php echo BASE_URL; ?>product/item/<?php echo $product->product_id; ?>">
            <div class="card">

              <!--Card image-->
              <div class="view overlay single-item__image">
                <img src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $product->image; ?>" class="card-img-top" alt="">
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--Card image-->

              <!--Card content-->
              <div class="card-body text-center">
                <!--Category & Title-->
                <a href="" class="grey-text">
                  <h5><?php echo ucfirst($product->name); ?></h5>
                </a>
                <h5>
                  <strong>
                    <a href="<?php echo BASE_URL; ?>product/item/<?php echo $product->product_id; ?>" class="dark-grey-text"><?php echo ucfirst($product->product_name); ?>
                    </a>
                  </strong>
                </h5>

                <h4 class="font-weight-bold blue-text">
                  <strong><?php echo number_format($product->price, 2); ?>$</strong>
                </h4>

              </div>
              <!--Card content-->

            </div>
           </a>
            <!--Card-->

          </div>
          <!-- End Product column-->
          <?php endforeach; ?>

        <?php endif; ?>

        </div>
        <!--Grid row-->


        <!--Grid row-->

      </section>
      <!--Section: Products v.3-->

      <!--Pagination
      <nav style="visibility: hidden" class="d-flex d-none justify-content-center wow fadeIn">
        <ul class="pagination pg-blue">

       
          <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>

          <li class="page-item active">
            <a class="page-link" href="#">1
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">4</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">5</a>
          </li>

          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
      Pagination-->

    </div>
  </main>
  <!--Main layout-->



<?php $this->end(); ?>

<?php $this->start('footer'); ?>

<script>

  function getCategoryProduct(el, category) {
    $('.filter-bar').removeClass('active');
    $(el).closest('li').addClass('active');
    $('.product').hide();
    $('.'+category).show();
  }

  function showAllProducts(el) {
    $('.filter-bar').removeClass('active');
    $(el).closest('li').addClass('active');
    $('.product').show();
  }

</script>

<?php $this->end(); ?>