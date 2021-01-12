<?php

if(!isset($_SESSION)){session_start();}

// Get current user, if connected
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$wishlist_items = $data['wishlist_items'];

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Wishlist Page -->
<div class="wishlist-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php if (isset($success_message)) { ?>
                    <h3 class="text-kaki font-italic mb-2"><?php echo $success_message; ?></h3>
                <?php } ?>
                    <!-- <h3 class="text-kaki font-italic mb-2">Your message</h3> -->

                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Unit Price </th>
                                <th>Stock</th>
                                <th>Add Item</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($wishlist_items)) {
                                foreach ($wishlist_items as $item) { ?>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="/product/detail/<?php echo $item['slug']; ?>">
                                            <img class="img-fluid" src="<?php echo APP_ROOT.''.$item['image']; ?>" alt="" />
                                        </a>
                                    </td>

                                    <td class="name-pr">
                                        <a href="/product/detail/<?php echo $item['slug']; ?>"><?php echo ucfirst($item['name']); ?></a>
                                    </td>

                                    <td class="price-pr">
                                        <p>$ <?php echo $item['price']; ?></p>
                                    </td>

                                    <td class="quantity-box"><?php echo $item['stock'] > 0 ? 'In stock' : 'Out of stock'; ?></td>

                                    <td class="add-pr">
                                        <a class="btn hvr-hover <?php echo $item['stock'] == 0 ? 'disabled' : ''; ?>" href="#" >Add to Cart</a>
                                    </td>

                                    <td class="remove-pr">
                                        <!-- <a href="#"><i class="fas fa-times"></i></a> -->
                                        <form action="/wishlist/delete" method="POST" id="deleteWishItemForm">
                                            <input type="hidden" name="wishlist_id" value="<?php echo $item['wishlist_id']; ?>">
                                            <button type="submit" name="deletewishBtn" class="btn btn-link text-dark"><i class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Wishlist Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->