<?php
require_once('../../../private/initialize.php');
request_login();

$headers = ['ID', 'Subject Name', 'Position', 'Visible','Name','&nbsp','&nbsp','&nbsp'];

?>

<?php
    $id = $_GET['id']??'';

    if(is_blank($id)) {
        $_SESSION['message'] = "";
        redirect_to('/staff/admins/index.php');
    }
   $admin = [];
   $admin['first_name'] = '';
   $admin['last_name']= '';
   $admin['email']= '';
   $admin['username']= '';
   $admin['hashed_password']= '';


   $admin = find_admin_by_id($id);

?>



<?php $page_title = 'Show Admin' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>


<div id="content">
    <a href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo;Back to List</a>
    <div class="admin show">
       <h1>Admin: <?php echo $admin['username']; ?></h1>
        <div class="attibutes">

            <dl>
                <dt>First Name</dt>
                <dd><?php echo h($admin['first_name']);  ?></dd>
            </dl>

            <dl>
                <dt>Last Name</dt>
                <dd><?php echo h($admin['last_name']);  ?></dd>
            </dl>

            <dl>
                <dt>Email</dt>
                <dd><?php echo h($admin['email']);  ?></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><?php echo h($admin['username']);  ?></dd>
            </dl>

            <dl>
                <dt>Password</dt>
                <dd><?php echo h($admin['hashed_password']);  ?></dd>
            </dl>
        </div>
    </div>
</div>


<?php include(SHARED_PATH.'/staff_footer.php') ?>