<?php 

$values = isset($data['values']) ? $data['values'] : [];
$lastName = isset($values) && isset($values['lastName']) ? $values['lastName'] : "";
$firstName = isset($values) && isset($values['firstName']) ? $values['firstName'] : "";
$email = isset($values) && isset($values['email']) ? $values['email'] : "";
$password = isset($values) && isset($values['password']) ? $values['password'] : "";
$passwordConfirm = isset($values) && isset($values['passwordConfirm']) ? $values['passwordConfirm'] : "";

$errors = isset($data['errors']) ? $data['errors'] : [];
$lastNameError = isset($errors) && isset($errors['lastName']) ? $errors['lastName'] : "";
$firstNameError = isset($errors) && isset($errors['firstName']) ? $errors['firstName'] : "";
$emailError = isset($errors) && isset($errors['email']) ? $errors['email'] : "";
$passwordError = isset($errors) && isset($errors['password']) ? $errors['password'] : "";
$confirmPasswordError = isset($errors) && isset($errors['passwordConfirm']) ? $errors['passwordConfirm'] : "";
?>

<form action="/user/register" method="POST" class="mt-3 <?php echo APP_PAGE == 'checkout' ? 'collapse': ''; ?> review-form-box" id="formRegister">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="InputName" class="mb-0">First Name</label>
            <input type="text" class="form-control" id="InputName" name="first_name" value="<?php echo $firstName; ?>" placeholder="First Name">
            <small class="text-danger"><?php echo $firstNameError; ?></small>
        </div>

        <div class="form-group col-md-6">
            <label for="InputLastname" class="mb-0">Last Name*</label>
            <input type="text" class="form-control" id="InputLastname" name="last_name" value="<?php echo $lastName; ?>" placeholder="Last Name">
            <small class="text-danger"><?php echo $lastNameError; ?></small>
        </div>

        <div class="form-group col-md-6">
            <label for="InputEmail1" class="mb-0">Email Address*</label>
            <input type="email" class="form-control" id="InputEmail1" name="email" value="<?php echo $email; ?>" placeholder="Enter Email">
            <small class="text-danger"><?php echo $emailError; ?></small>
        </div>

        <div class="form-group col-md-6">
            <label for="InputPassword1" class="mb-0">Password*</label>
            <input type="password" class="form-control" id="InputPassword1" name="password" value="<?php echo $password; ?>" placeholder="Password">
            <small class="text-danger"><?php echo $passwordError; ?></small>
        </div>

        <div class="form-group col-md-6">
            <label for="InputPassword2" class="mb-0">Password confirm*</label>
            <input type="password" class="form-control" id="InputPassword2" name="password_confirm" value="<?php echo $passwordConfirm; ?>" placeholder="Password confirm">
            <small class="text-danger"><?php echo $confirmPasswordError; ?></small>
        </div>
    </div>

    <button type="submit" class="btn hvr-hover mb-2" name="registerBtn">Register</button>
    <p>Already registered? <a href="/login" class="ml-2 font-weight-bold">Login</a></p>
</form>