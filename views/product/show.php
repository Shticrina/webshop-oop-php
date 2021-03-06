<?php

if(!isset($_SESSION)){session_start();}

// Get current user, if connected
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$product = $data['product'];
$current_route = $_SERVER['REQUEST_URI'];
$wishlistProductIds = isset($_SESSION['wishlistProductIds']) ? $_SESSION['wishlistProductIds'] : null;

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Shop Detail Page -->
<div class="shop-detail-box-main">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
                <?php if (isset($success_message)) { ?>
                    <h3 class="text-kaki font-italic mb-2 pl-3"><?php echo $success_message; ?></h3>
                <?php } ?>

                <h3 id="successMessage" class="text-kaki font-italic mb-2 pl-3"></h3>
            </div>

			<div class="col-xl-5 col-lg-5 col-md-6">
				<div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<img class="d-block w-100" src="<?php echo APP_ROOT.''.$product['image']; ?>" alt="First slide">
						</div>

						<div class="carousel-item">
							<img class="d-block w-100" src="<?php echo APP_ROOT.''.$product['image']; ?>" alt="Second slide">
						</div>

						<div class="carousel-item">
							<img class="d-block w-100" src="<?php echo APP_ROOT.''.$product['image']; ?>" alt="Third slide">
						</div>
					</div>

					<a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>

					<a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>

					<ol class="carousel-indicators">
						<li data-target="#carousel-example-1" data-slide-to="0" class="active">
							<img class="d-block w-100 img-fluid" src="<?php echo APP_ROOT.''.$product['image']; ?>" alt="" />
						</li>
						<li data-target="#carousel-example-1" data-slide-to="1">
							<img class="d-block w-100 img-fluid" src="<?php echo APP_ROOT.''.$product['image']; ?>" alt="" />
						</li>
						<li data-target="#carousel-example-1" data-slide-to="2">
							<img class="d-block w-100 img-fluid" src="<?php echo APP_ROOT.''.$product['image']; ?>" alt="" />
						</li>
					</ol>
				</div>
			</div>

			<div class="col-xl-7 col-lg-7 col-md-6">
				<div class="single-product-details">
					<h2><?php echo ucfirst($product['name']); ?></h2>

					<h5> <del>$ <?php echo $product['price']*1.03; ?></del> $<?php echo $product['price']; ?></h5>
					<p class="available-stock"><span> More than <?php echo $product['stock']-1; ?> available / <a href="#">8 sold </a></span><p>

					<h4>Short Description:</h4>
					<p><?php echo $product['description']; ?></p>
					
					<ul>
						<li>
							<div class="form-group quantity-box">
								<label class="control-label">Quantity</label>
								<input class="form-control" id="inputQty" value="0" min="0" max="<?php echo $product['stock']; ?>" type="number">
							</div>
						</li>
					</ul>

					<div class="price-box-bar">
						<div class="cart-and-bay-btn">
							<a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a>

							<!-- <a class="btn hvr-hover" data-fancybox-close="">Add to cart</a> -->
							<a class="btn hvr-hover add-to-cart-show" data-fancybox-close="" id="addToCartBtn<?php echo $product['id']; ?>" href="javascript:void(0)" data-slug="<?php echo $product['slug']; ?>" data-quantity="1" data-image="<?php echo $product['image']; ?>" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</a>
						</div>
					</div>

					<div class="add-to-btn d-flex justify-content-between">
						<div class="add-comp flex-fill d-flex">
							<?php if ($wishlistProductIds && !in_array($product['id'], $wishlistProductIds) && $user) { ?>
								<form action="/wishlist/add" method="POST">
                                    <input type="hidden" name="current_route" value="<?php echo $current_route; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                                    <button class="btn btn-info hvr-hover" id="addtoWishBtn" type="submit" name="addtoWishBtn"><i class="fas fa-heart"></i> Add to wishlist</button>
                                </form>
							<?php } ?>

							<a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
						</div>

						<div class="share-bar flex-fill text-right">
							<a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
							<a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
							<a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
							<a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
							<a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row my-5">
			<div class="card card-outline-secondary my-4">
				<div class="card-header">
					<h2>Product Reviews</h2>
				</div>

				<div class="card-body">
					<div class="media mb-3">
						<div class="mr-2"> 
							<img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
						</div>

						<div class="media-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
							<small class="text-muted">Posted by Anonymous on 3/1/18</small>
						</div>
					</div>

					<hr>

					<div class="media mb-3">
						<div class="mr-2"> 
							<img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
						</div>

						<div class="media-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
							<small class="text-muted">Posted by Anonymous on 3/1/18</small>
						</div>
					</div>

					<hr>

					<div class="media mb-3">
						<div class="mr-2"> 
							<img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
						</div>

						<div class="media-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
							<small class="text-muted">Posted by Anonymous on 3/1/18</small>
						</div>
					</div>

					<hr>

					<a href="#" class="btn hvr-hover">Leave a Review</a>
				</div>
			</div>
		</div>

		<div class="row my-5">
			<div class="col-lg-12">
				<div class="title-all text-center">
					<h1>Featured Products</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
				</div>

				<div class="featured-products-box owl-carousel owl-theme">
					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-01.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li>
											<a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a>
										</li>
										<li>
											<a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a>
										</li>
										<li>
											<a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a>
										</li>
									</ul>

									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>

							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-02.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
									</ul>
									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>

							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-03.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
									</ul>

									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>

							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-04.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
									</ul>
									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>

							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-01.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
									</ul>

									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>

							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-02.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
									</ul>

									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>

							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-03.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
									</ul>

									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>

							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>

					<div class="item">
						<div class="products-single fix">
							<div class="box-img-hover">
								<img src="<?php echo APP_ROOT; ?>/assets/images/img-pro-04.jpg" class="img-fluid" alt="Image">

								<div class="mask-icon">
									<ul>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
										<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
									</ul>

									<a class="cart" href="#">Add to Cart</a>
								</div>
							</div>
							
							<div class="why-text">
								<h4>Lorem ipsum dolor sit amet</h4>
								<h5> $9.79</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Shop Detail Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->

<script>
	
	$("#inputQty").change(function() {
		// console.log($("#inputQty").val());
		$(".add-to-cart-show").attr('data-quantity', $("#inputQty").val());
	});

</script>