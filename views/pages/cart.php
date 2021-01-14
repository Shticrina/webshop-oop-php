<?php

if(!isset($_SESSION)){session_start();}

$cart_items = isset($_SESSION['cartItems']) ? $_SESSION['cartItems'] : null;
$cartItemsNb = isset($_SESSION['cartItemsNb']) ? $_SESSION['cartItemsNb'] : null;
$totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0;
// var_dump($cart_items);
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Cart Page -->
<div class="cart-box-main">
    <div class="container">
        <div class="d-flex justify-content-start" id="cartMessage">
            <!-- <h3 class="text-kaki font-italic mb-2">message Shopping Cart...</h3> -->
        </div>

        <?php if (isset($cartItemsNb) && $cartItemsNb > 0) { ?>
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
                                    <?php foreach ($cart_items as $item) { ?>
                                        <tr id="item<?php echo $item['id']; ?>">
                                            <td class="thumbnail-img">
                                                <a href="/product/detail/<?php echo $item['slug']; ?>">
                    								<img class="img-fluid" src="<?php echo APP_ROOT.''.$item['image']; ?>" alt="<?php echo $item['name']; ?>" />
                    							</a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="/product/detail/<?php echo $item['slug']; ?>"><?php echo ucfirst($item['name']); ?></a>
                                            </td>
                                            <td class="price-pr">
                                                <p>$ <?php echo $item['price']; ?></p>
                                            </td>
                                            <td class="quantity-box"><input type="number" size="4" value="<?php echo $item['quantity']; ?>" min="0" max="<?php echo $item['stock']; ?>" step="1" class="c-input-text qty text"></td>
                                            <td class="total-pr">
                                                <p>$ <?php echo $item['quantity']*$item['price']; ?></p>
                                            </td>
            <!-- *************************************************************** -->
                                            <td class="remove-pr">
                                                <!-- <a href="#"><i class="fas fa-times"></i></a> -->
                                                <form onsubmit="return false;" id="deleteFromCartForm">
                                                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                                    <button type="button" id="deleteFromCartBtn" class="btn btn-link text-danger" onclick="deleteFromCart(<?php echo $item['id']; ?>)"><i class="fas fa-times"></i></button>
                                                </form>
                                            </td>
            <!-- *************************************************************** -->
                                        </tr>
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
                            <div class="ml-auto font-weight-bold"> $ <span id="subTotalCart"><?php echo $totalPrice; ?></span> </div>
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
        <?php } else { ?>
            <div class="d-flex justify-content-center">
                <h2 class="text-kaki font-italic mb-2">No items yet in your Shopping Cart...</h2>
            </div>
        <?php } ?>
    </div>
</div>
<!-- End Cart Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->

<script>

    function deleteFromCart(itemId) {
        
        // ******************** js fetch Ajax example ********************
        let data = {id: itemId};
        var body = new FormData;
        body.append("id", itemId);

        fetch('http://localhost/cart/deleteItem', {
            method: "POST",
            /*headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },*/
            // body: JSON.stringify(data)
            body: body
        })
        .then((res) => res.json()) // response
        .then((data) => { // data
            console.log(data);
            // console.log(data.item);
            var itemToRemove = data.item;

            if (data.success) {
                // show success message above the table
                $("#cartMessage").append('<h3 class="text-kaki font-italic">Item successfully removed from the Shopping Cart.</h3>');

                // remove line with current id from the table
                $("#item"+itemToRemove.id).remove();

                // update sidebar cart items
                $("#sideCart"+itemToRemove.id).remove();

                // update the badge in header MyCart
                let oldNb = $("#cartBadge").text();
                $("#cartBadge").text(oldNb - itemToRemove.quantity);

                // recalculate sub total in cart page & header sidebar cart
                let oldPrice = $("#headerTotalPrice").text();
                let newPrice = oldPrice - itemToRemove.quantity*itemToRemove.price;

                $("#subTotalCart").text(newPrice);
                $("#headerTotalPrice").text(newPrice);
            }
        });

        // ******************** jQuery Ajax example ********************
        /*$.ajax({
            type: "POST",
            url: "http://localhost/cart/deleteItem",
            data: "id = "+itemId
        }).then(
            (response) => {
                var res = JSON.parse(response);
                console.log(res);
            }
        );*/
    }
</script>