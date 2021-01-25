<?php 

$current_route = $_SERVER['REQUEST_URI'];
$email = isset($_SESSION['values']) && isset($_SESSION['values']['email']) ? $_SESSION['values']['email'] : "";
$emailError = isset($_SESSION['errors']) && isset($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : "";
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;

unset($_SESSION['success_message']);
unset($_SESSION['values']);
unset($_SESSION['errors']);
?>
    <!-- Start Footer  -->
    <footer>
        <div class="footer-main" id="footerMain">
            <div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-sm-12">
						<div class="footer-top-box">
							<h3>Business Time</h3>

							<ul class="list-time">
								<li>Monday - Friday: 08.00am to 05.00pm</li> <li>Saturday: 10.00am to 08.00pm</li> <li>Sunday: <span>Closed</span></li>
							</ul>
						</div>
					</div>

					<div class="col-lg-4 col-md-12 col-sm-12">
						<div class="footer-top-box">
							<h3>Newsletter</h3>

							<form action="/newsletter/create" method="POST" class="newsletter-box">
                                <input type="hidden" name="current_route" value="<?php echo $current_route; ?>">
								<div class="form-group">
									<input class="" type="email" name="news_email" value="<?php echo $email; ?>" placeholder="Email Address*" />
									<i class="fa fa-envelope"></i>
                                    <p class="text-danger"><?php echo $emailError; ?></p>
								</div>

								<button class="btn hvr-hover" type="submit" name="newsletterBtn">Submit</button>
							</form>

                            <?php if (isset($success_message)) { ?>
                                <h4 class="text-white font-italic mt-3 pb-0"><?php echo $success_message; ?></h4>
                            <?php } ?>
						</div>
					</div>

					<div class="col-lg-4 col-md-12 col-sm-12">
						<div class="footer-top-box">
							<h3>Social Media</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

							<ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
						</div>
					</div>
				</div>

				<hr>

                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About Freshshop</h4>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> 
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> 							
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>

                            <ul>
                                <li><a href="/about">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>

                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 3756 <br>Preston Street Wichita,<br> KS 67213 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :
            <a href="https://html.design/">html design</a>
        </p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="<?php echo APP_ROOT; ?>/assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/popper.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/bootstrap.min.js"></script>

    <!-- ALL PLUGINS -->
    <script src="<?php echo APP_ROOT; ?>/assets/js/jquery.superslides.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/bootstrap-select.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/inewsticker.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/bootsnav.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/images-loded.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/isotope.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/baguetteBox.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/form-validator.min.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/contact-form-script.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/custom.js"></script>
    <script src="<?php echo APP_ROOT; ?>/assets/js/main.js"></script>
</body>
</html>