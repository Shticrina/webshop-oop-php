<?php

if(!isset($_SESSION)){session_start();}
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<section id="404page" class="container d-flex justify-content-center py-5">
    <div class="text-center my-4">
	    <h2 class="text-danger display-4 pb-3">Sorry!... Page not found!</h2>
		<img src="https://media4.giphy.com/media/6uGhT1O4sxpi8/giphy.gif?cid=ecf05e4745ed5d329a1ce979278cb6762c70355283a5dcc6&rid=giphy.gif" alt="404NotFound">
	</div>
</section>

<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->