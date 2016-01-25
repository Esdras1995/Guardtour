<?php 

interface iDatabase{

	public function update($table, $data, $where);
	public function remove($table, $data, $where);
	public function add($table, $data);
	public function list($table, $data);
}

?>