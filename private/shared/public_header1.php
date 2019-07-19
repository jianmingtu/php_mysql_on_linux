<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Global Bank <?php if(isset($page_title)) {echo "- {$page_title}";} ?></title>
    <link rel="stylesheet" media = "all" href=<?php echo url_for('/stylesheets/public1.css'); ?>>
</head>
<body>

    <header>
        <h1>
            <a href=<?php echo url_for('/index.php'); ?>>
                <img src="<?php echo url_for('/images/gbi_logo.png'); ?>" width="298" height="71"
                     alt="hhfg" />
            </a>
        </h1>
    </header>
