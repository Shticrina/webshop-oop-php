<?php
session_start();

$products = $data['products'];
$categories = $data['categories'];
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Gallery Page -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Our Gallery</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        <button class="active" data-filter="*">All</button>
                        
                        <?php foreach ($categories as $category) { ?>
                            <button data-filter=".<?php echo $category['category_slug']?>"><?php echo ucfirst($category['category_name']); ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row special-list">
            <?php foreach ($products as $product) { ?>
                <div class="col-lg-3 col-md-6 special-grid <?php echo $product['category_slug']; ?>">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Sale</p>
                            </div>

                            <img src="<?php echo APP_ROOT.''.$product['image']; ?>" class="img-fluid" alt="Image">
                            
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Gallery Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->