<?php 

$values = isset($data['values']) ? $data['values'] : [];
$email = isset($values) && isset($values['email']) ? $values['email'] : "";
$password = isset($values) && isset($values['password']) ? $values['password'] : "";

$errors = isset($data['errors']) ? $data['errors'] : [];
$emailError = isset($errors) && isset($errors['email']) ? $errors['email'] : "";
$passwordError = isset($errors) && isset($errors['password']) ? $errors['password'] : "";
$credentialsError = isset($errors) && isset($errors['credentials']) ? $errors['credentials'] : "";
?>

<form action="/user/login" method="POST" class="mt-3 <?php echo APP_PAGE == 'checkout' ? 'collapse': ''; ?> review-form-box" id="formLogin">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="InputEmail" class="mb-0">Email Address*</label>
            <input type="email" class="form-control" id="InputEmail" name="login_email" value="<?php echo $email; ?>" placeholder="Enter Email">
            <small class="text-danger"><?php echo $emailError; ?></small>
        </div>

        <div class="form-group col-md-6">
            <label for="InputPassword" class="mb-0">Password*</label>
            <input type="password" class="form-control" id="InputPassword" name="login_password" value="<?php echo $password; ?>" placeholder="Password">
            <small class="text-danger"><?php echo $passwordError; ?></small>
        </div>
    </div>

    <?php if ($credentialsError) { ?>
        <div class="alert alert-danger"><?php echo $credentialsError; ?></div>
    <?php } ?>

    <button type="submit" class="btn hvr-hover mb-2" name="loginBtn">Login</button>
    <p>Not registered yet? <a href="/register" class="ml-2 font-weight-bold">Create an account!</a></p>
</form>