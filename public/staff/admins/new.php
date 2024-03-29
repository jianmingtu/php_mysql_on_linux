<?php
    require_once('../../../private/initialize.php');
request_login();
    if(is_post_request()) {

        $admin = [];
        $admin['first_name'] = $_POST['first_name'] ?? '';
        $admin['last_name'] = $_POST['last_name'] ?? '';
        $admin['email'] = $_POST['email'] ?? '';
        $admin['username'] = $_POST['username'] ?? '';
        $admin['hashed_password'] = $_POST['hashed_password'] ?? '';
        $admin['confirmed_password'] = $_POST['confirmed_password'] ?? '';

        $result = insert_admin($admin);

        if($result === true) {
            $new_id = mysqli_insert_id($db);
            $_SESSION['message'] = 'The user was created successfully.';
            redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
        } else {
            $errors = $result;
        }
    } else {
        $admin = [];
        $admin['id'] = '';
        $admin['first_name'] = '';
        $admin['last_name']= '';
        $admin['email']= '';
        $admin['username']= '';
        $admin['hashed_password']= '';
        $admin['confirmed_password']= '';
    }

?>

<?php $page_title = 'Show Admin' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php') ?>">« Back to List</a>

    <div class="admin new">
        <h1>Create Admin</h1>

        <?php echo display_error($errors); ?>

        <form action="<?php echo "new.php" ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="<?php echo h($admin['email']); ?>"></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="<?php echo h($admin['username']); ?>"></dd>
            </dl>

            <dl>
                <dt>Password</dt>
                <dd><input type="password" name="hashed_password" value="<?php echo h($admin['hashed_password']); ?>"></dd>
            </dl>

            <dl>
                <dt>Confirm Password</dt>
                <dd><input type="password" name="confirmed_password" value="<?php echo h($admin['confirmed_password']); ?>"></dd>
            </dl>


            <p>
                Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbols.
            </p>

            <div id="operations">
                <input type="submit" name="submit" value="Submit Admin">
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH.'/admins/staff_footer.php') ?>
