
<?php require_once('../../private/initialize.php') ?>

<?php $page_title = 'Staff Menu' ?>
<?php include('../../private/shared/staff_header.php') ?>

<div id="content">
    <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
            <li><a href=<?php echo url_for('/staff/subjects/index.php'); ?>>Subjects</a> </li>
            <li><a href=<?php echo url_for('/staff/pages/index.php'); ?>>Pages</a> </li>
        </ul>
    </div>
</div>

<!--<div> <?php print_r($_SERVER) ?> </div>

<?php include('../../private/shared/staff_footer.php') ?>
