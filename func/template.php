<?php

function load_template($path,$data=array(),$value=FALSE) {

    if(is_array($data)){
        extract($data);
    }
    ob_start();

    require dirname(__FILE__)."/../".TEMPLATE.$path;

    $applied_template = ob_get_contents();
    ob_end_clean();

    if($value) {
        return $applied_template;
    }
    else {

        echo $applied_template;
    }
}

function paging( $total_pages, $current_page, $page_link, $page_number,$path) {

    $str = '';
    $half = (int)($page_number/2)+1;

    if( $total_pages > $page_number ) {
        $loopCount = $page_number;
    }
    else {
        $loopCount = $total_pages;
    }
    if( $current_page == $half && $current_page != $total_pages ) {
        $start = ($current_page - $half)+1;
        $loopCount = ($current_page + $half)-1;
    }
    else if( $current_page > $half && $current_page != $total_pages ) {
        $start = ($current_page - $half)+1;
        $loopCount = ($current_page + $half)-1;
    }
    else if( $current_page > $half && $current_page == $total_pages ) {
        $start = $total_pages - ($page_number);
        $loopCount = $current_page;
        if($start < 0) {
            $start = 1;
        }
    }
    else {
        $start = 1;
    }


    if( $loopCount > $total_pages && ($total_pages > $page_number || $total_pages < $loopCount) ) {
        $start = $total_pages - ($page_number);
        $loopCount = $total_pages;
        if($start < 0) {
            $start = 1;
        }
    }

    ob_start();
    require dirname(__FILE__)."/../".TEMPLATE.$path;

    $applied_template = ob_get_contents();
    ob_end_clean();
    return $applied_template;
}	

?>
