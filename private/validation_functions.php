<?php
    /* 
    // is_blank('abcd'); => false
    // is_blank('     '); => true
    * Validates data presence
    * Trims trailing and leading spaces and checks if empty string
    * cannot use isempty because "0" will evaluate to true
    */
    function is_blank($data){
        return !isset($data) || trim($data) === "";
    }

    // Reverse of is_blank($data);
    // Data is not empty
    function has_presence($data){
        return !is_blank($data);
    }

    function has_length_greater_than($data, $len){
        return strlen($data) > $len;
    }

    function has_length_less_than($data, $len){
        return strlen($data) < $len;
    }

    function has_length_exactly($data, $len){
        return strlen($data) === $len;
    }

    //   has_legnth('abcd',[ 'min' => 3, 'max' => 5])
    // * spaces count towards length
    // * use trim() if spaces should not count
    function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'])) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'])) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
    }

    function has_inclusion_of($value,$set) {
        return in_array($value,$set);
    }

    function has_exclusion_of($value,$set) {
        return !in_array($value,$set);
    }

    function has_string($value,$required_string) {
        return strpos($value,$required_string) !== false;
    }

    function has_valid_email_format($value) {
        $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($email_regex,$value) === 1;
    }

    function has_unique_page_menu_name($menu_name,$current_id="0"){
        global $db;
        
        $query = "SELECT * FROM PAGES ";
        $query .= "WHERE menu_name='" . db_escape($db,$menu_name) . "'";
        $query .= "AND id !='" . db_escape($db,$current_id) . "'";
        
        $rs = mysqli_query($db,$query);
        $page_count = mysqli_num_rows($rs);
        mysqli_free_result($rs);
        return $page_count === 0;
    }
?>