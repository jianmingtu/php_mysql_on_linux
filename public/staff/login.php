
<?php
    require_once('../../private/initialize.php');

    $errors = [];
    $username = '';
    $password = '';

    if(is_post_request()) {
        $username = $_POST['username']??'';
        $password = $_POST['password']??'';

        if(is_blank($username)) {
            $errors[] = "user name can not be blank";
        }

        if(is_blank($password)) {
            $errors[] = "password can not be blank";
        }

        if(empty($error)) {

            $admin = find_admin_by_username($username);

            if($admin) {
                if(password_verify($password, $admin['hashed_password'])) {


                    $_SESSION['username'] = $username;

                    log_in_admin($admin);

                    redirect_to(url_for('/staff/index.php'));

                } else {
                    $errors[] = "login failed";
                }

            } else {
                $errors[] = "login failed";
            }
        }

    }
?>


<?php $page_title = 'Log in' ?>
<?php include('../../private/shared/staff_header.php') ?>

<div id="content">
    <h1>log in </h1>

    <?php echo display_error($errors); ?>

    <form action="login.php" method="post">

        <label for="username">User Name:</label><br />
        <input type = "text" name="username" value="<?php h($username); ?>" /><br />

        <label for="password">Password:</label><br />
        <input type = "password" name="password" value="" /><br />

        <input type="submit" name ="submit" value="Submit Password" />
    </form>

</div>


<?php include('../../private/shared/staff_footer.php') ?>