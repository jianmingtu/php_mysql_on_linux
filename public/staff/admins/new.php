<?php
    require_once('../../../private/initialize.php');

    if(is_post_request()) {

        $admin = [];
        $admin['first_name'] = $_POST['first_name'] ?? '';
        $admin['last_name'] = $_POST['last_name'] ?? '';
        $admin['email'] = $_POST['email'] ?? '';
        $admin['username'] = $_POST['username'] ?? '';
        $admin['hashed_password'] = $_POST['hashed_password'] ?? '';

        $result = insert_admin($admin);

        if($result === true) {
            $new_id = mysqli_insert_id($db);
            $_SESSION['message'] = 'The user was created successfully.';
            redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
        } else {
            $errors = $result;
        }
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
                <dd><input type="text" name="first_name" value=""></dd>
            </dl>

            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value=""></dd>
            </dl>

            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value=""></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value=""></dd>
            </dl>

            <dl>
                <dt>Password</dt>
                <dd><input type="text" name="hashed_password" value=""></dd>
            </dl>

            <div id="operations">
                <input type="submit" name="submit" value="Submit Admin">
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH.'/admins/staff_footer.php') ?>
