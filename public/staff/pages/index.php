<?php

require_once('../../../private/initialize.php');

redirect_to(url_for('/staff/index.php'));

request_login();
$headers = ['ID', 'Subject Name', 'Position', 'Visible','Name','&nbsp','&nbsp','&nbsp'];

$result_set = find_all_pages();

?>

<?php $page_title = 'Show Page' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>

<div id="content">
    <div class = "pages listing">
        <h1>Pages</h1>
        <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/pages/new.php') ?>">Create Page</a>
        </div>
        <table class = 'list'>
            <!-- draw head row --!>
            <tr>
                <?php foreach($headers as $header) { ?>
                    <th>
                        <?php echo $header; ?>
                    </th>
                <?php } ?>
            </tr>

            <!--  draw content--!>
             <?php while($page = mysqli_fetch_assoc($result_set)) { ?>
                <tr>
                    <td><?php echo h($page['id']) ?></td>
                    <td><?php echo $page['subject_name']; ?></td>
                     <td><?php echo h($page['position']); ?></td>
                    <td><?php echo $page['visible']==1?'true':'false'; ?></td>
                    <td><?php echo h($page['menu_name']); ?></td>
                    <td><a class="action" href=<?php echo url_for('/staff/pages/show.php?id='.h(u($page['id']))); ?>>View</a></td>
                    <td><a class="action" href=<?php echo url_for('/staff/pages/edit.php?id='.h(u($page['id']))); ?>>Edit</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/delete.php?id='.h(u($page['id']))); ?>">Delete</a></td>
                </tr>
             <?php } ?>
        </table>
    </div>
</div>

<?php mysqli_free_result($result_set) ?>

<?php include(SHARED_PATH.'/staff_footer.php') ?>
