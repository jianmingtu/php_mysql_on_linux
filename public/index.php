
<?php require_once('../private/initialize.php') ?>

<?php

$preview = false;
if(isset($_GET['preview'])) {
    // http://localhost/globe_bank/public/index.php?preview=true&id=13
    $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}

$visible = !$preview;

if(isset($_GET['id'])) {
    $page_id = $_GET['id'];


    echo "$visible".$visible."<br.>";

    $page = find_page_by_id($page_id,['visible'=>$visible]);
    if(!$page) {
        redirect_to(url_for('/index.php'));
    }
    $subject_id = $page['subject_id'];
    $subject = find_subject_by_id($subject_id, ['visible'=>$visible]);
    if(!$subject) {
        redirect_to(url_for('/index.php'));
    }
} elseif(isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    $subject = find_subject_by_id($subject_id, ['visible'=>true]);
    if(!$subject) {
        redirect_to(url_for('/index.php'));
    }
    $pages = find_page_by_subjec_id($subject_id,['visible'=>true]);
    $page = mysqli_fetch_assoc($pages);
    $page_id = $page['id'];
}

?>

<?php include(SHARED_PATH.'/public_header.php') ?>

<div id="main">

    <?php include(SHARED_PATH.'/public_navigation.php') ?>

    <div id="page">

        <?php
            if(isset($page)) {
                echo $page['content'];
            } else {
                include(SHARED_PATH.'/static_homepage.php');
            }

        ?>

    </div>
</div>

<?php include(SHARED_PATH.'/public_footer.php') ?>