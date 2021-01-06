<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Login Page -->
<div class="container d-flex justify-content-center py-5">
    <div class="col-lg-8">
	    <div class="title-left">
	        <h3>Account login</h3>
	    </div>

	    <?php include('./views/layouts/loginForm.php'); ?>
	</div>
</div>
<!-- End Login Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->