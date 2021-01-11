<?php

if(!isset($_SESSION)){session_start();}

$errors = isset($data['errors']) ? $data['errors'] : [];
$nameError = isset($errors) && isset($errors['contact_name']) ? $errors['contact_name'] : "";
$emailError = isset($errors) && isset($errors['contact_email']) ? $errors['contact_email'] : "";
$subjectError = isset($errors) && isset($errors['contact_subject']) ? $errors['contact_subject'] : "";
$messageError = isset($errors) && isset($errors['contact_message']) ? $errors['contact_message'] : "";

$values = isset($data['values']) ? $data['values'] : [];
$name = isset($values) && isset($values['contact_name']) ? $values['contact_name'] : "";
$email = isset($values) && isset($values['contact_email']) ? $values['contact_email'] : "";
$subject = isset($values) && isset($values['contact_subject']) ? $values['contact_subject'] : "";
$message = isset($values) && isset($values['contact_message']) ? $values['contact_message'] : "";

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);
?>

<!-- HTML content -->
<?php include('./views/layouts/master.php'); ?>
<?php include('./views/layouts/header.php'); ?>

<!-- Start Contact Page -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <?php if (isset($success_message)) { ?>
                    <h3 class="text-kaki font-italic mt-2 pl-3"><?php echo $success_message; ?></h3>
                <?php } ?>

                <div class="contact-form-right">
                    <h2>GET IN TOUCH</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed odio justo, ultrices ac nisl sed, lobortis porta elit. Fusce in metus ac ex venenatis ultricies at cursus mauris.</p>

                    <form id="contactForm" action="/contact/sendMessage" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="contactName" placeholder="Your Name*" value="<?php echo $name; ?>" required data-error="Please enter your name">
                                    <div class="help-block with-errors"><?php echo $nameError; ?></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Your Email" class="form-control" name="contactEmail" value="<?php echo $email; ?>" required data-error="Please enter your email*">
                                    <div class="help-block with-errors"><?php echo $emailError; ?></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="contactSubject" placeholder="Subject" value="<?php echo $subject; ?>" required data-error="Please enter your Subject*">
                                    <div class="help-block with-errors"><?php echo $subjectError; ?></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="contactMessage" placeholder="Your Message*" rows="4" data-error="Write your message" required><?php echo $message; ?></textarea>
                                    <div class="help-block with-errors"><?php echo $messageError; ?></div>
                                </div>

                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" type="submit" name="contactBtn">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 col-sm-12">
                <div class="contact-info-left">
                    <h2>CONTACT INFO</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>

                    <ul>
                        <li>
                            <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 9000 <br>Preston Street Wichita,<br> KS 87213 </p>
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
<!-- End Contact Page -->

<?php include('./views/layouts/instagramFeed.php'); ?>
<?php include('./views/layouts/footer.php'); ?>
<!-- end HTML content -->