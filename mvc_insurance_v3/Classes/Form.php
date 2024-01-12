<?php
declare(strict_types=1);

class Form{
    public $formData = [];

    public function __construct() {
        $this->isInputEmpty($this->getPOSTasArray());
    }

    function getPOSTasArray() {
        $post = $_POST;
        $result = [];
        foreach($post as $key => $value){
            if($key === "hidden" || $value === "bt_signup"){
                continue;
            }
            $result[$key] = $value;
        }
        return $result;
    }

    function isInputEmpty(array $formData) {
        $this->formData = $formData;
        foreach($formData as $data){
            if(empty($data)){
                $errors[] = "Fill in all fields!";
            }
        }
    }
}