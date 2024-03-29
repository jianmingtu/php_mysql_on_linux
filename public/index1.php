
<?php require_once('../private/initialize.php') ?>

<?php

if(isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $page = find_page_by_id($page_id);
    if(!$page) {
        redirect_to(url_for('/index.php'));
    }
}

?>

<?php include(SHARED_PATH.'/public_header1.php') ?>

<div id="main">

    <?php include(SHARED_PATH.'/public_navigation1.php') ?>

    <div id="page">

        <?php
        if(isset($page)) {
            echo $page['content'];
        } else {
            include(SHARED_PATH.'/static_homepage1.php');
        }

        ?>

    </div>
</div>

<?php include(SHARED_PATH.'/public_footer1.php') ?>