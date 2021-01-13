<?php

if(!isset($_SESSION)){session_start();}

$cart_items = isset($_SESSION['cartItems']) ? $_SESSION['cartItems'] : null;
$cartItemsNb = isset($_SESSION['cartItemsNb']) ? $_SESSION['cartItemsNb'] : null;
$totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0;
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Cart Page -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($cartItemsNb) && $cartItemsNb > 0) { ?>
                                <?php foreach ($cart_items as $item) { ?>
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="/product/detail/<?php echo $item['slug']; ?>">
                								<img class="img-fluid" src="<?php echo APP_ROOT.''.$item['image']; ?>" alt="<?php echo $item['name']; ?>" />
                							</a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="/product/detail/<?php echo $item['slug']; ?>"><?php echo $item['name']; ?></a>
                                        </td>
                                        <td class="price-pr">
                                            <p>$ <?php echo $item['price']; ?></p>
                                        </td>
                                        <td class="quantity-box"><input type="number" size="4" value="<?php echo $item['quantity']; ?>" min="0" max="<?php echo $item['stock']; ?>" step="1" class="c-input-text qty text"></td>
                                        <td class="total-pr">
                                            <p>$ <?php echo $item['quantity']*$item['price']; ?></p>
                                        </td>
                                        <td class="remove-pr">
                                            <a href="#">
                								<i class="fas fa-times"></i>
                							</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>No items yet in your cart...</tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-6 col-sm-6">
                <div class="coupon-box">
                    <div class="input-group input-group-sm">
                        <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                        
                        <div class="input-group-append">
                            <button class="btn btn-theme" type="button">Apply Coupon</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6">
                <div class="update-box">
                    <input value="Update Cart" type="submit">
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>

            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>

                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> $ <?php echo $totalPrice; ?> </div>
                    </div>

                    <div class="d-flex">
                        <h4>Discount</h4>
                        <div class="ml-auto font-weight-bold"> $ 40 </div>
                    </div>

                    <hr class="my-1">

                    <div class="d-flex">
                        <h4>Coupon Discount</h4>
                        <div class="ml-auto font-weight-bold"> $ 10 </div>
                    </div>

                    <div class="d-flex">
                        <h4>Tax</h4>
                        <div class="ml-auto font-weight-bold"> $ 2 </div>
                    </div>

                    <div class="d-flex">
                        <h4>Shipping Cost</h4>
                        <div class="ml-auto font-weight-bold"> Free </div>
                    </div>

                    <hr>

                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> $ 388 </div>
                    </div>
                    
                    <hr>
                </div>
            </div>

            <div class="col-12 d-flex shopping-box">
                <a href="/checkout" class="ml-auto btn hvr-hover">Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- End Cart Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->