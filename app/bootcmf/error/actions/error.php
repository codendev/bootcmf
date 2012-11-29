<?php

class Error_Error extends Core_Abstract_Action {

    function  index() {
    }

    function e404() {
        header("HTTP/1.0 404 Not Found");
        //$this->meta("HTTP 404: Page not found ");
        load_template('frontend/error/error.php',$this->data);
    }

}
?>
