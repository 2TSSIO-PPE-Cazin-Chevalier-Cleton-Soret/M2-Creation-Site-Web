<?php

class Form {

    public function createInput($name, $type = null, $placeholder = null) {
        if(is_null($type)) {
            return '<div class="form-group"><input type="text" name="'.$name.'" class="form-control" value="'. App::getValue($name) .'"></div>';
        }
        else {
            if($type == "password") {
                return '<div class="form-group"><input type="'.$type.'" name="'.$name.'" class="form-control" placeholder="'. $placeholder .'"></div>';
            }
            if($type == "text") {
                return '<div class="form-group"><input type="'.$type.'" name="'.$name.'" class="form-control" placeholder="'. $placeholder .'"></div>';
            }
            if($type == "number") {
                if(is_null($placeholder)) {
                    return '<div class="form-group"><input type="'.$type.'" name="'.$name.'" class="form-control" value="'. App::getValue($name) .'"></div>';
                }
                return '<div class="form-group"><input type="'.$type.'" name="'.$name.'" class="form-control" placeholder="'. $placeholder .'"></div>';
            }
        }
    }

}