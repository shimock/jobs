<?php

class Form {

    public function createFormField($type, $name, $placeholder, $value) {

        switch ($type) {
            case 'date': $field = $this->formField('date', $name, $placeholder, $value);
                break;
            case 'time': $field = $this->formField('time', $name, $placeholder, $value);
                break;
            case 'file': $field = $this->formField('file', $name, $placeholder, $value);
                break;
            case 'textarea': $field = $this->textarea($name, $placeholder, $value);
                break;
            case 'password': $field = $this->formField('password', $name, $placeholder, $value);
                break;
            case 'submit': $field = $this->formField('submit', $name, $placeholder, $value);
                break;
            default : $field = $this->formField('text', $name, $placeholder, $value);
        }

        return $this->formLabel($type, $name, $placeholder) . $field;
    }

    public function formLabel($type, $name, $placeholder) {

        if ($type !== 'hidden') {
            $label = "<div><label class='form-label' for='" . $name . "'>" . $placeholder . "</label></div>";
        } else {
            $label = null;
        }

        return $label;
    }

    public function formHeader($name, $action) {

        return "<div><form class='form' name='" . $name . "' method='post' action='" . $action . "' enctype='multipart/form-data'>";
    }

    public function formFooter() {

        return "</form></div>";
    }

    public function formField($type, $name, $placeholder, $value) {
        if($type == 'submit'){
            $field = "<div>"
                . "<input class='form-control btn btn-primary' id='" . $name . "' type='" . $type . "' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $value . "' required />"
            . "</div>";
        }else if($type == 'file'){
            $field = "<div>"
                . "<input class='form-control' id='" . $name . "' type='" . $type . "' name='" . $name . "' placeholder='" . $placeholder . "' accept='image/*' required />"
            . "</div>";
        
        }else{
            $field = "<div>"
                . "<input class='form-control' id='" . $name . "' type='" . $type . "' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $value . "' required />"
            . "</div>";
        }
        
        return $field;
    }
    
    public function textarea($name, $placeholder, $value) {
        $field = "<div>"
                . "<textarea class='form-control' id='" . $name . "' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $value . "' required></textarea>"
            . "</div>";
        
        return $field;
    }
}
