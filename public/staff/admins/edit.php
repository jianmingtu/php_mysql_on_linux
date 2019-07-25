<?php
    require_once('../../../private/initialize.php');
request_login();

    $id = $_GET['id']??'';

    if(is_blank($id)) {
        $_SESSION['message'] = "";
        redirect_to('/staff/admins/index.php');
    }

    $admin = [];
    $admin['id'] = $id;
    $admin['first_name'] = '';
    $admin['last_name']= '';
    $admin['email']= '';
    $admin['username']= '';
    $admin['hashed_password']= '';

    if(is_post_request()) {

        $admin['first_name'] = $_POST['first_name'] ?? '';
        $admin['last_name'] = $_POST['last_name'] ?? '';
        $admin['email'] = $_POST['email'] ?? '';
        $admin['username'] = $_POST['username'] ?? '';
        $admin['hashed_password'] = $_POST['hashed_password'] ?? '';

        $result = update_admin_by_id($admin);

        if($result === true) {
            $_SESSION['message'] = 'The user was updated successfully.';
            redirect_to(url_for('/staff/admins/show.php?id=' . $id));
        } else {
            $errors = $result;
        }
    } else {

        $admin = find_admin_by_id($id);
    }

?>

<?php $page_title = 'Show Admin' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php') ?>">« Back to List</a>

    <div class="admin new">
        <h1>Create Admin</h1>

        <?php echo display_error($errors); ?>

        <form action="<?php echo "edit.php?id=" . h(u($admin['id'])); ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" value="<?php echo ($admin['first_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value="<?php echo ($admin['last_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="<?php echo ($admin['email']); ?>"></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="<?php echo ($admin['username']); ?>"></dd>
            </dl>

            <dl>
                <dt>Password</dt>
                <dd><input type="password" name="hashed_password" value="<?php echo ($admin['hashed_password']); ?>"></dd>
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
