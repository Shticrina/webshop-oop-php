<?php

if(!isset($_SESSION)){session_start();}

// Get current user, if connected
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$current_route = $_SERVER['REQUEST_URI'];
$products = isset($_SESSION['products']) ? $_SESSION['products'] : $data['products'];
$categories = $data['categories'];
unset($_SESSION['products']);

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);

$wishlistProductIds = isset($_SESSION['wishlistProductIds']) ? $_SESSION['wishlistProductIds'] : null;
// var_dump($current_route, $wishlistProductIds, $products);
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Shop Page -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php if (isset($success_message)) { ?>
                    <h3 class="text-kaki font-italic mb-2"><?php echo $success_message; ?></h3>
                <?php } ?>
            </div>

            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div class="right-product-box">
                    <div class="product-item-filter row">
                        <div class="col-12 col-sm-8 text-center text-sm-left">
                            <div class="toolbar-sorter-right">
                                <span>Sort by </span>
                                <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
    								<option data-display="Select">Nothing</option>
    								<option value="1">Popularity</option>
    								<option value="2">High Price → High Price</option>
    								<option value="3">Low Price → High Price</option>
    								<option value="4">Best Selling</option>
    							</select>
                            </div>

                            <p>Showing all <?php echo count($products); ?> results</p>
                        </div>

                        <div class="col-12 col-sm-4 text-center text-sm-right">
                            <ul class="nav nav-tabs ml-auto">
                                <li>
                                    <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row">

                                    <?php foreach ($products as $product) { ?>
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">                         
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <?php if (isset($product['label'])) { ?>
                                                        <div class="type-lb">
                                                            <p class="<?php echo $product['label']; ?>"><?php echo ucfirst($product['label']); ?></p>
                                                        </div>
                                                    <?php } ?>

                                                    <img src="<?php echo APP_ROOT.''.$product['image']; ?>" class="img-fluid" alt="Image">

                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="/product/detail/<?php echo $product['slug']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>

                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>

                                                            <?php if ($user) { ?>
                                                            <li>
                                                                <!-- <a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a> -->

                                                                <form action="<?php echo !in_array($product['id'], $wishlistProductIds) ? '/wishlist/add' : ''; ?>" method="POST">
                                                                    <input type="hidden" name="current_route" value="<?php echo $current_route; ?>">
                                                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                                                                    <button class="btn btn-link pl-2" type="submit" name="addtoWishBtn" data-toggle="tooltip" data-placement="right" title="<?php echo in_array($product['id'], $wishlistProductIds) ? 'Already in your Wishlist' : 'Add to Wishlist'; ?>"><i class="<?php echo in_array($product['id'], $wishlistProductIds) ? 'fas' : 'far'; ?> fa-heart text-white"></i></button>
                                                                </form>
                                                            </li>
                                                            <?php } ?>
                                                        </ul>

                                                        <a class="cart" id="addToCartBtn<?php echo $product['id']; ?>" href="javascript:void(0)" data-price="<?php echo $product['price']; ?>" data-quantity="1" data-image="<?php echo $product['image']; ?>" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</a>
                                                    </div>
                                                </div>

                                                <div class="why-text">
                                                    <h4><?php echo $product['name']; ?></h4>
                                                    <h5> $<?php echo $product['price']; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="list-view">
                                <?php foreach ($products as $product) { ?>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <?php if (isset($product['label'])) { ?>
                                                            <div class="type-lb">
                                                                <p class="<?php echo $product['label']; ?>"><?php echo ucfirst($product['label']); ?></p>
                                                            </div>
                                                        <?php } ?>

                                                        <img src="<?php echo APP_ROOT.''.$product['image']; ?>" class="img-fluid" alt="Image">

                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="/product/detail/<?php echo $product['slug']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>

                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>

                                                                <?php if ($user) { ?>
                                                                <li>
                                                                    <!-- <a href="/wishlist/all" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a> -->

                                                                    <form action="<?php echo !in_array($product['id'], $wishlistProductIds) ? '/wishlist/add' : ''; ?>" method="POST">
                                                                        <input type="hidden" name="current_route" value="<?php echo $current_route; ?>">
                                                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                                                                        <button class="btn btn-link pl-2" type="submit" name="addtoWishBtn" data-toggle="tooltip" data-placement="right" title="<?php echo in_array($product['id'], $wishlistProductIds) ? 'Already in your Wishlist' : 'Add to Wishlist'; ?>"><i class="<?php echo in_array($product['id'], $wishlistProductIds) ? 'fas' : 'far'; ?> fa-heart text-white"></i></button>
                                                                    </form>
                                                                </li>
                                                            <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4><?php echo $product['name']; ?></h4>
                                                    <h5> <del>$ <?php echo $product['price']*1.03; ?></del> $<?php echo $product['price']; ?></h5>
                                                    <p><?php echo $product['description']; ?>... Integer tincidunt aliquet nibh vitae dictum. In turpis sapien, imperdiet quis magna nec, iaculis ultrices ante. Integer vitae suscipit nisi. Morbi dignissim risus sit amet orci porta, eget aliquam purus sollicitudin. Cras eu metus felis.</p>

                                                    <a class="btn hvr-hover" id="addToCartBtn<?php echo $product['id']; ?>" href="javascript:void(0)" data-price="<?php echo $product['price']; ?>" data-quantity="1" data-image="<?php echo $product['image']; ?>" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="search-product">
                        <form action="/product/search" method="POST">
                            <input class="form-control" name="search" placeholder="Search here..." type="text">
                            <button type="submit" name="searchBtn"> <i class="fa fa-search"></i> </button>
                        </form>
                    </div>

                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>Categories</h3>
                        </div>

                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">

                            <?php foreach ($categories as $category) { ?>
                                <div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between" href="#sub-men<?php echo $category['category_id']; ?>" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men<?php echo $category['category_id']; ?>">
                                        <div>
                                            <span><?php echo ucfirst($category['category_name']); ?></span>
                                            <small class="text-muted">(<?php echo count($category['products']); ?>)</small>
                                        </div>

                                        <i class="fas fa-angle-down"></i>
                                    </a>

                                    <div class="collapse show" id="sub-men<?php echo $category['category_id']?>" data-parent="#list-group-men">
                                        <div class="list-group">
                                            <?php foreach ($category['products'] as $prod) { ?>
                                                <a href="/product/detail/<?php echo $prod['slug']; ?>" class="list-group-item list-group-item-action active"><?php echo $prod['name']?> <small class="text-muted">(<?php echo $prod['stock']?>)</small></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="filter-price-left">
                        <div class="title-left">
                            <h3>Price</h3>
                        </div>

                        <div class="price-box-slider">
                            <div id="slider-range"></div>

                            <p>
                                <input type="text" id="amount" readonly style="border:0; color:#fbb714; font-weight:bold;">
                                <button class="btn hvr-hover" type="submit">Filter</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->