<?php 

interface iDatabase{

	public function update($table, $data, $where);
	public function remove($table, $data);
	public function add($table, $data);
	public function _list($table, $data);
}

?>