<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class MySql {

	private $link;
	private $host;
	private $user;
	private $pwd;
	private $name;

	function open($config) {
		
        $this->host = $config['host'];
		$this->user = $config['user'];
		$this->pwd = $config['pwd'];
		$this->db = $config['db'];

		if(!$this->link = mysql_connect($this->host, $this->user, $this->pwd)) {
            echo 'Can not connect to MySQL server';
        }
        
        mysql_query("SET NAMES UTF8", $this->link);

		if($this->db) {
			mysql_select_db($this->db, $this->link);
		}
	}

	function fetch($query, $type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $type);
	}
    
	function first($sql) {
		$query = $this->query($sql);
		return $this->fetch($query);
	}

	function all($sql, $id = '') {
		$data = array();
		$query = $this->query($sql);
		while($row = $this->fetch($query)) {
			$id ? $data[$row[$id]] = $row : $data[] = $row;
		}
		return $data;
	}

	function query($sql) {
		if(!($query = mysql_query($sql, $this->link))) {
			echo 'MySQL Query Error';
		}
		return $query;
	}

	function affectrows() {
		return mysql_affected_rows($this->link);
	}

	function scalar($sql, $row = 0) {
		return mysql_result($this->query($sql), $row);
	}

	function count($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	function lastid() {
		return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	function version() {
		return mysql_get_server_info($this->link);
	}

	function close() {
		return mysql_close($this->link);
	}
}