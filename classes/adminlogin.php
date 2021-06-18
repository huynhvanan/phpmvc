<?php
	include '../lib/session.php';
	Session::checkLogin();
	include '../lib/database.php';
	include '../helpers/format.php';
?>
<?php
	/**
	 * 
	 */
	class adminlogin
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function login_admin($User,$Pass){
			// kiem tra tinh hop le cua bien user va pass
			$User = $this->fm->validation($User);
			$Pass = $this->fm->validation($Pass);
			$User = mysqli_real_escape_string($this->db->link, $User);
			$Pass = mysqli_real_escape_string($this->db->link, $Pass);
			if(empty($User) || empty($Pass)){
				$alert = " Username và Password không nên để trống";
				return $alert;
			}else{
				$query = "SELECT * FROM table_admin WHERE User = '$User' AND Pass = '$Pass' LIMIT 1";
				$result = $this->db->select($query);
				if($result != false){
					$value = $result->fetch_assoc();
					Session::set('adminlogin', true);
					Session::set('Id', $value['Id']);
					Session::set('User', $value['User']);
					Session::set('Name', $value['Name']);
					header("Location:index.php");
				}else{
					$alert = " Username và Password không đúng";
					return $alert;
				}
			}
		}
	}
?>