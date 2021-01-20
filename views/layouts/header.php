<?php 

// Get current user, if connected
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$cart_items = isset($_SESSION['cartItems']) ? $_SESSION['cartItems'] : null;
$cartItemsNb = isset($_SESSION['cartItemsNb']) ? $_SESSION['cartItemsNb'] : null;
$totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0;
// var_dump($totalPrice);
?>

<!-- Start Main Top -->
<div class="main-top" id="mainBanner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="custom-select-box">
                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
						<option>¥ JPY</option>
						<option>$ USD</option>
						<option>€ EUR</option>
					</select>
                </div>

                <div class="right-phone-box">
                    <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                </div>

                <div class="our-link">
                    <ul>
                        <li><a href="/myAccount"><i class="fa fa-user s_color"></i> My Account</a></li>
                        <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>
                        <li><a href="/contactUs"><i class="fas fa-headset"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-between">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT30
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now 
                            </li>
                        </ul>
                    </div>
                </div>

				<!-- <div class="login-box">koooo
					<select id="basic" class="selectpicker show-tick form-control" data-placeholder="Sign In">
						<option><a href="/register">Register Here</a></option>
						<option><a href="/login">Sign In</a></option>
					</select>
				</div> -->

                <?php if ($user && $user['is_connected']) { ?> <!-- if connected -->
                    <div class="text-right">
                        <a class="text-light mr-3" href="/myAccount">Hello <span class="text-capitalize"><?php echo $user['first_name']; ?></span>!</a>
                        <a class="text-kaki" href="/user/logout"><i class="fa fa-sign-in fa-1x" aria-hidden="true"></i>&nbsp; Sign out</a>
                    </div>
                <?php } else { ?> <!-- if not connected -->
                    <div class="text-right">
                        <a class="text-light mr-3" href="/login">Sign in</a>
                        <a class="text-kaki" href="/register">Sign up</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Header -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
	                <i class="fa fa-bars"></i>
	            </button>
                <a class="navbar-brand" href="/"><img src="<?php echo APP_ROOT; ?>/assets/images/logo.png" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">SHOP <i class="fas fa-caret-down ml-2"></i></a>

                        <ul class="dropdown-menu">
							<li><a href="/shop">Sidebar Shop</a></li>
							<!-- <li><a href="/shopDetail">Shop Detail</a></li> -->
                            <li><a href="/cart">Cart</a></li>

                            <?php if (isset($cartItemsNb) && $cartItemsNb > 0) { ?>
                                <li><a href="/checkout">Checkout</a></li>
                            <?php } ?>

                            <?php if ($user && $user['is_connected']) { ?> <!-- if connected -->
                                <li><a href="/myAccount">My Account</a></li>
                                <li><a href="/wishlist/all">Wishlist</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contactUs">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu">
						<a href="#">
							<i class="fa fa-shopping-bag"></i>
							<span class="badge" id="cartBadge"><?php echo isset($cartItemsNb) ? $cartItemsNb : '0'; ?></span>
							<p>My Cart</p>
						</a>
					</li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>

        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>

            <li class="cart-box">
                <ul class="cart-list" id="cart-list-header">
                    <?php if (isset($cartItemsNb) && $cartItemsNb > 0) { ?>
                        <?php foreach ($cart_items as $item) { ?>
                            <li id="sideCart<?php echo $item['id']; ?>" class="cart-item-header">
                                <a href="/product/detail/<?php echo $item['slug']; ?>" class="photo"><img src="<?php echo APP_ROOT.''.$item['image']; ?>" class="cart-thumb" alt="" /></a>
                                <h6><a href="/product/detail/<?php echo $item['slug']; ?>"><?php echo ucfirst($item['name']); ?></a></h6>
                                <p>
                                    <span id="itemQty<?php echo $item['id']; ?>"><?php echo $item['quantity']; ?></span>x - <span class="price">$<?php echo $item['price']; ?></span></p>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <li class="no-items">No items yet in your Shopping Cart...</li>
                    <?php } ?>

                    <li class="total">
                        <a href="/cart" id="viewCartBtnHeader" class="btn btn-default hvr-hover btn-cart <?php echo !$cartItemsNb || $cartItemsNb == 0 ? 'disabled' : ''; ?>">VIEW CART</a>
                        <span class="float-right"><strong>Total: </strong> $<span id="headerTotalPrice"><?php echo $totalPrice; ?></span></span>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Header -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <form action="/product/search" method="POST">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                <button type="submit" name="searchBtn" class="d-none"></button>
            </div>
        </form>
    </div>
</div>
<!-- End Top Search -->

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?php echo ucfirst(APP_PAGE); ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst(APP_PAGE); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->