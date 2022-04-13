<?php $this->setSiteTitle('Dashboard'); ?>
<?php $this->start('body'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="icon-big text-center">
                                    <i class="teal fas fa-shopping-cart"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="detail text-center">
                                    <p>Total Orders</p>
                                    <span class="number"><?php echo $totalOrders; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="fas fa-redo-alt"></i> Updated in real time
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>

<?php $this->end(); ?>