<?php
    if(!isset($page_title)) {
        $page_title = 'Staff Area';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link style="text/css" rel="stylesheet" href=<?php echo url_for('/stylesheets/staff.css') ?>>
    <meta charset="UTF-8">
    <title>GBI - <?php echo $page_title; ?></title>
</head>
<body>
<header>
    <h1> GBI staff Area </h1>
</header>
<navigation>
    <ul>
        <li>User: <?php echo $_SESSION['username']??''; ?></li>
        <li><a href=<?php echo url_for('/staff/index.php'); ?>> Menu </a></li>
        <li><a href=<?php echo url_for('/staff/logout.php'); ?>> Log out </a></li>
    </ul>

    <?php if(isset($_SESSION['message'])) { ?>
        <div id = "session_message">
            <?php echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php } ?>
</navigation>
