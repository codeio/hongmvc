<?php 

class Model
{
    private $sql = '';

    public function where($str) {
        $this->sql .= $str;
        return $this;
    }

    public function output() {
        echo $this->sql;
    }
}

$model = new Model();
$model->where(" aa")
    ->where(" bb")
    ->where(" cc");

$model->output();
?>