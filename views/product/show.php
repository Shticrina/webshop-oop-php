<?php
include('helpers/variables.php');
$product = $data['product'];
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<section id="showProduct" class="container mx-auto row py-5">
    <div class="col-lg-4 col-sm-8 mx-auto text-center mb-4">
	    <h3 class="text-center">Product name: <?php echo $product['name']; ?></h3>
	    <hr class="bg-info">
	</div>

	<div class="col-12">
		<?php //if (isset($data['products']) && count($data['products']) > 0) { ?>
	</div>
</section>

<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->