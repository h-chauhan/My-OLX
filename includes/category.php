<?php 
	require_once('initialize.php');
	
	class category extends databaseObject {
		protected static $table_name = "category";
		protected static $db_fields = array('id', 'name');
		
		public $id;
		public $name;
		
		public function get_name() {
			if(isset($this->name)) {
				return $this->name;
			} else {
				return "";
			}
		}
	}
	
?>