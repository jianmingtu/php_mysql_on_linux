<?php
require_once('../../../private/initialize.php');
request_login();
?>

<?php $id = $_GET['id'] ?? '1';
    $page = find_page_by_id($id);
?>

<?php $page_title = 'Show Page' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>


<div id="content">
    <a class="back-link" href=<?php echo url_for('/staff/subjects/show.php?id='.h(u($page['subject_id']))); ?>>&laquo;Back to List</a>

    <div class = "page show">

        <h1>Page: <?php echo h($page['menu_name']);  ?></h1>
        <div class="actions">
            <a class="action" href=<?php echo url_for('/index.php?preview=true&id='.h(u($page['id']))); ?> target="_blank"> Preview Page </a>
        </div>

        <div class="attibutes">

            <dl>
                <dt>Subject</dt>
                <dd><?php echo h($page['subject_name']);  ?></dd>
            </dl>

            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($page['menu_name']);  ?></dd>
            </dl>

            <dl>
                <dt>Position</dt>
                <dd><?php echo h($page['position']);  ?></dd>
            </dl>

            <dl>
                <dt>Visible</dt>
                <dd><?php echo $page['visible']=='1'?'true':'false'; ?></dd>
            </dl>

            <dl>
                <dt>Content</dt>
                <dd><?php echo h($page['content']);  ?></dd>
            </dl>
        </div>
    </div>

<?php include(SHARED_PATH.'/staff_footer.php') ?>

