<?php


// class Model
// {
//     private $sql = '';

//     public function where($str) {
//         $this->sql .= $str;
//         return $this;
//     }

//     public function where($str) {
//         $this->sql .= $str;
//         return $this;
//     }

//     public function where($str) {
//         $this->sql .= $str;
//         return $this;
//     }

//     public function output() {
//         echo $this->sql;
//     }
// }

// $model = new Model();

// $model->where(" aa")
//     ->where(" bb")
//     ->where(" cc");

// $model->output();

//test
require 'opcache.php';

exit;

class Model {
	function list() {
		return 222;
	}
}

$user = new Model();
echo $user->list();

$user->find(1);

$user->first();
$user->last();
$user->single();

//获取数量
$user->where("id", "=", 1)->count();

$user->where("id", "=", 1)->toList();

$user->include("address")
	->where("id", "=", 1)->toList();

$user->where("id", "=", 1)
	->where("id", "=", 1)
	->orderBy("id")
	->orderByDescending("id")
	->thenBy("id")
	->thenByDescending("id")
	->list();

$user->join()

?>