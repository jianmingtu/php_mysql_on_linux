<?php
require_once('../../../private/initialize.php');
request_login();
?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$subject = find_subject_by_id($id);

$headers = ['ID', 'Position', 'Visible','Name','&nbsp','&nbsp','&nbsp'];

$result_set = find_page_by_subjec_id($id);

?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject show">

        <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
        </div>

        <hr>


        <h2>Pages</h2>
        <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/pages/new.php?subject_id='.h(u($subject['id']))); ?>">Create Page</a>
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
