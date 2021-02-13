<?php

if(!isset($_SESSION)){session_start();}

// Get current user, if connected
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$products = $data['products'];
$categories = $data['categories'];
$current_route = $_SERVER['REQUEST_URI'];
$wishlistProductIds = isset($_SESSION['wishlistProductIds']) ? $_SESSION['wishlistProductIds'] : null;

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Gallery Page -->
<div class="products-box" id="galleryContent">
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
                <div class="<?php echo isset($success_message) ? 'mb-4' : 'special-menu'; ?> text-center">
                    <div class="button-group filter-button-group">
                        <button class="active" data-filter="*">All</button>
                        
                        <?php foreach ($categories as $category) { ?>
                            <button data-filter=".<?php echo $category['category_slug']?>"><?php echo ucfirst($category['category_name']); ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <?php if (isset($success_message)) { ?>
                    <h3 class="text-kaki font-italic mb-1"><?php echo $success_message; ?></h3>
                <?php } ?>

                <h3 id="successMessage" class="text-kaki font-italic mb-1"></h3>
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
                                    <li><a href="/product/detail/<?php echo $product['slug']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>

                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>

                                    <?php if ($user) { ?>
                                    <li>
                                        <!-- <a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a> -->

                                        <form action="<?php echo !in_array($product['id'], $wishlistProductIds) ? '/wishlist/add' : '#galleryContent'; ?>" method="POST">
                                            <input type="hidden" name="current_route" value="<?php echo $current_route; ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                                            <button class="btn btn-link pl-2" type="submit" name="addtoWishBtn" data-toggle="tooltip" data-placement="right" title="<?php echo in_array($product['id'], $wishlistProductIds) ? 'Already in your Wishlist' : 'Add to Wishlist'; ?>"><i class="<?php echo in_array($product['id'], $wishlistProductIds) ? 'fas' : 'far'; ?> fa-heart text-white"></i></button>
                                        </form>
                                    </li>
                                    <?php } ?>
                                </ul>

                                <a class="cart" id="addToCartBtn<?php echo $product['id']; ?>" href="javascript:void(0)" data-slug="<?php echo $product['slug']; ?>" data-quantity="1" data-image="<?php echo $product['image']; ?>" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</a>
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