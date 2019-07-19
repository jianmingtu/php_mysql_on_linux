<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {
    $request = [];
    $request['menu_name'] = $_POST['menu_name'] ?? '';
    $request['position'] = $_POST['position'] ?? '';
    $request['visible'] = $_POST['visible'] ?? '';

    $result = insert_subject($request);

    if($request) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = "The subject was successfully deleted.";
        redirect_to(url_for('/staff/subjects/show.php?id='.h(u($new_id))));
    }
} else {
    redirect_to(url_for('/staff/subjects/new.php'));
}
?>


