<?php

    function find_all_subjects($options=[]) {
        global $db;
        $visible = $options['visible']??false;
        $sql = "select * from subjects ";
        if($visible) {
            $sql .= " WHERE visible = true ";
        }
        $sql .="order by position asc";
        $subject_set = mysqli_query($db, $sql);
        confirm_result_set($subject_set, $sql);

        return $subject_set;
    }

    function find_all_pages() {
        global $db;
        $sql = "SELECT pages.id, subjects.menu_name as subject_name, pages.menu_name, pages.position, pages.visible, pages.content "
            . "FROM subjects, pages "
            . "WHERE subjects.id = pages.subject_id order by pages.subject_id, pages.position ASC";
        $subject_set = mysqli_query($db, $sql);
        confirm_result_set($subject_set, $sql);

        return $subject_set;
    }

    function find_subject_by_id($id) {
        global $db;
        $sql = "SELECT * FROM subjects WHERE id='".db_escape($db,$id)."' LIMIT 1";
        $result_set = mysqli_query($db, $sql);
        confirm_result_set($result_set,$sql);
        $subject = mysqli_fetch_assoc($result_set);
        mysqli_free_result($result_set);
        return $subject;
    }

    function insert_subject($request) {
        global $db;
        $sql = "INSERT INTO subjects (position, visible, menu_name) VALUES ("
            . "'" . db_escape($db, $request['position']) . "',"
            . "'" . db_escape($db, $request['visible']) . "',"
            . "'" . db_escape($db, $request['menu_name']) . "'"
            . ") ";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }

    function update_subject($subject)
    {
        global $db;

        $error = validate_subject($subject);
        if(!empty($error)) {
            return $error;
        }

        $sql = "UPDATE subjects SET "
            . "position = '" . db_escape($db, $subject['position']) . "',"
            . "visible = '" . db_escape($db, $subject['visible']) . "',"
            . "menu_name = '" . db_escape($db, $subject['menu_name']). "' "
            . "WHERE id='" . db_escape($db, $subject['id']). "' "
            . "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }

    function delete_subject($id) {
        global $db;

        $sql = "DELETE FROM subjects WHERE id='" . db_escape($db, $id) . "' LIMIT 1";

        echo $sql;
        $result = mysqli_query($db, $sql);

        if($result) {
            $_SESSION['message'] = "The subject was successfully deleted.";
            redirect_to(url_for('/staff/subjects/index.php?'));
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }

    function find_page_by_id($id, $options=[]) {
        global $db;

        $visible = $options['visible']??false;

        $sql = "SELECT pages.id, pages.subject_id, subjects.menu_name as subject_name, pages.menu_name, pages.position, pages.visible, pages.content "
            . "FROM subjects, pages "
            . "WHERE subjects.id = pages.subject_id AND pages.id='". db_escape($db, $id) ."'";

        if($visible)
        {
            $sql .= " AND subjects.visible = true AND pages.visible = true";
        }

        $result_set = mysqli_query($db, $sql);
        confirm_result_set($result_set, $sql);

        $page = mysqli_fetch_assoc($result_set);
        mysqli_free_result($result_set);

        return $page;
    }

    function insert_page($page)
    {
        global $db;

        $sql = "INSERT INTO pages (subject_id, position, visible, menu_name, content) VALUES ("
            . "'" . db_escape($db, $page['subject_id']) . "',"
            . "'" . db_escape($db, $page['position']) . "',"
            . "'" . db_escape($db, $page['visible']) . "',"
            . "'" . db_escape($db, $page['menu_name']) . "',"
            . "'" . db_escape($db, $page['content']) . "')";

        $result_set = mysqli_query($db, $sql);
        confirm_result_set($result_set, $sql);

        $page = mysqli_fetch_assoc($result_set);

        return $page;
    }

    function update_page($page) {
        global $db;


        $sql = "UPDATE pages SET "
         ."subject_id='" . db_escape($db, $page['subject_id']) . "', "
         ."menu_name='" . db_escape($db, $page['menu_name']) . "', "
         ."position='" . db_escape($db, $page['position']) . "', "
         ."visible='" . db_escape($db, $page['visible']) . "', "
         ."content='" . db_escape($db, $page['content']) . "' "
         ."WHERE id='" . db_escape($db, $page['id']) . "' ";

        $result_set = mysqli_query($db, $sql);
        confirm_result_set($result_set, $sql);

        $page = mysqli_fetch_assoc($result_set);

        return $page;
    }

function delete_page($id) {
    global $db;

    $sql = "DELETE FROM pages WHERE id='" . db_escape($db, $id) . "' LIMIT 1";

    echo $sql;
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit();
    }
}

function validate_subject($subject) {
    $errors = [];

    if(is_blank($subject['menu_name'])) {
        $errors[] = "name can not be blank";
    } elseif (!has_length($subject['menu_name'], ['min'=>2,'max'=>255])) {
        $errors[] = "name must be between 2 and 255 characters";
    }

    $position = (int)($subject['position']);
    if($position <= 0) {
        $errors[] = "position must be greater than zero.";
    }
    if($position > 999) {
        $errors[] = "position must be less than 999.";
    }

    $visible = (string)($subject['visible']);
    if(!has_include_of($visible, ['0','1'])) {
        $errors[] = "visible must be either \"0\" or \"1\".";
    }

    return $errors;
}

function find_page_by_subjec_id($id, $options = []) {
    global $db;
    $sql = "SELECT * FROM pages where subject_id='".db_escape($db,$id)."'";

    $visible = $options['visible']??false;
    if($visible) {
        $sql .= " AND visible = true ";
    }
    $sql .= " ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result, $sql);
    return $result;

}

