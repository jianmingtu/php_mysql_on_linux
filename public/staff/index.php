
<?php require_once('../../private/initialize.php') ?>

request_login();

<?php $page_title = 'Staff Menu'; $x = 'preview=true&preview1=true'; ?>
<?php include('../../private/shared/staff_header.php') ?>

<div id="content">
    <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
            <li><a href=<?php echo url_for('/staff/subjects/index.php?'.$x); ?>>Subjects</a> </li>
            <li><a href=<?php echo url_for('/staff/admins/index.php'); ?>>Admins</a> </li>
        </ul>
    </div>
</div>


<?php include('../../private/shared/staff_footer.php') ?>
