
<?php
    require_once('../../private/initialize.php');

    $errors = [];
    $username = '';
    $password = '';

    if(is_post_request()) {
        $username = $_POST['username']??'';
        $password = $_POST['password']??'';

        $_SESSION['username'] = $username;

        redirect_to(url_for('/staff/index.php'));
    }
?>


<?php $page_title = 'Log in' ?>
<?php include('../../private/shared/staff_header.php') ?>

<div id="content">
    <h1>log in </h1>

    <form action="login.php" method="post">

        <label for="username">User Name:</label><br />
        <input type = "text" name="username" value="<?php h($username); ?>" /><br />

        <label for="password">Password:</label><br />
        <input type = "password" name="password" value="" /><br />

        <input type="submit" name ="submit" value="Submit Password" />
    </form>

</div>


<?php include('../../private/shared/staff_footer.php') ?>