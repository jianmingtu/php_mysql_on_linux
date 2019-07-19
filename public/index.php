
<?php require_once('../private/initialize.php') ?>

<?php

if(isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $preview = $_GET['preview']??false;
    $visible = !($preview == true);

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