<?php
class privileges {
	private $edit_privilege;
	private $view_privilege;
	private $change_privilege;	
	public function __construct($username) {
    	if($username === null) {
        	$this->set_privileges(0,0,0);
        } else {
    		$db = mysqli_connect('localhost','d8tmc','d8tmc','mydb');
    		$sql = "SELECT P.view_info as vi , P.edit_info as ei , P.change_privileges as cp FROM users U , privilages P WHERE U.username='$username' AND U.priv_id = P.id";
    		$result = $db->query($sql);
    		if(mysqli_num_rows($result) == 1) {
    			$row = $result->fetch_assoc();
        		$this->set_privileges($row["ei"],$row["vi"],$row["cp"]);
        	}
        }
    }
	private function set_privileges($x,$y,$z) {
    	$this->edit_privilege = (boolean)$x;
		$this->view_privilege = (boolean)$y;
		$this->change_privilege = (boolean)$z;
    }
	public function get_edit_privilege() {
    	return $this->edit_privilege;
   	}
	public function get_view_privilege() {
    	return $this->view_privilege;
   	} 
	public function get_change_privilege() {
    	return $this->change_privilege;
   	}
} ?>