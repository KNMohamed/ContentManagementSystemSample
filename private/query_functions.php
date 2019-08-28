<?php

function find_all_subjects(){
    global $db;
    
    $query = "SELECT * FROM SUBJECTS ";
    $query .= "ORDER BY position ASC;";
    $rs = mysqli_query($db,$query);
    confirm_result_set($rs);
    return $rs;
}

function find_all_pages(){
    global $db;
    $query = "SELECT * FROM PAGES ";
    $query .= "ORDER BY position ASC";
    $rs = mysqli_query($db,$query);
    confirm_result_set($rs);
    return $rs;
}

function find_subject_by_id($id){
    global $db;
    $query = "SELECT * FROM SUBJECTS ";
    $query .= "WHERE ID = '" . $id . "'";
    $rs = mysqli_query($db,$query);
    confirm_result_set($rs);
    $subject = mysqli_fetch_assoc($rs);
    mysqli_free_result($rs);
    return $subject;
}

function find_page_by_id($id){
    global $db;
    $query = "SELECT * FROM PAGES ";
    $query .= "WHERE ID = '" . $id . "'";
    $rs = mysqli_query($db,$query);
    confirm_result_set($rs);
    $page = mysqli_fetch_assoc($rs);
    mysqli_free_result($rs);
    return $page;
}

function insert_subject($menu_name, $position, $visible){
    global $db;
    $query = "INSERT INTO SUBJECTS ";
    $query .= "(menu_name,position,visible) ";
    $query .= "VALUES ('" . $menu_name . "','" . $position . "','" . $visible . "')";
    if(mysqli_query($db,$query)){
        return true;
    }else{
        return false;
    }
}
?>