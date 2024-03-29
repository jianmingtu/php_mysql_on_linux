<?php
$page_id = $page_id??"";
$subject_id = $subject_id??"";
$visible = $visible??true;
?>

<navigation>
    <?php $nav_subjects = find_all_subjects(['visible'=>$visible]); ?>
    <ul class = "subjects">
        <?php while($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
            <li class = <?php if($nav_subject['id'] == $subject_id) {echo "selected";} ?>>
                <a href = <?php echo url_for('index.php?subject_id='.$nav_subject['id']); ?>>
                    <?php echo h($nav_subject['menu_name']); ?>
                </a>

                <?php if($nav_subject['id']==$subject_id) { ?>
                    <?php $nav_pages = find_page_by_subjec_id($nav_subject['id'], ['visible'=>$visible]); ?>
                    <ul class = "pages">
                        <?php while($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
                            <?php if(!$nav_page['visible']) { continue;} ?>
                            <li class = <?php if($nav_page['id'] == $page_id) {echo "selected";} ?>>
                                <a href = "<?php echo url_for('index.php?id='.$nav_page['id']); ?>">
                                    <?php echo h($nav_page['menu_name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php mysqli_free_result($nav_pages); ?>
                <?php } ?>

            </li>
        <?php } ?>
        <li>
            <a href = "<?php echo url_for('staff/index.php'); ?>"> Sign In</a>
        </li>
    </ul>
    <?php mysqli_free_result($nav_subjects); ?>
</navigation>

