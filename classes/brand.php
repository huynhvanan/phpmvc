<?php
	include '../lib/database.php';
	include '../helpers/format.php';
?>
<?php
	/**
	 * 
	 */
	class brand
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_brand($Name){
			$Name = $this->fm->validation($Name);
			$Name = mysqli_real_escape_string($this->db->link, $Name);
			
			if(empty($Name)){
				$alert = "<span class='error'>Thương hiệu không nên để trống";
				return $alert;
			}else{
				$query = "INSERT INTO thuonghieu(Name) VALUES('$Name')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm thương hiệu thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm thương hiệu không thành công</span>";
					return $alert;
				}
			}
		}
		public function show_brand(){
			$query = "SELECT * FROM thuonghieu order by Id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_brand($Name,$id){
			$Name = $this->fm->validation($Name);
			$Name = mysqli_real_escape_string($this->db->link, $Name);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if(empty($Name)){
				$alert = "<span class='error'>Thương hiệu không nên để trống";
				return $alert;
			}else{
				$query = "UPDATE thuonghieu SET Name = '$Name' WHERE Id = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhật thương hiệu thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhật thương hiệu không thành công</span>";
					return $alert;
				}
			}
		}
		public function delete_brand($id){
			$query = "DELETE FROM thuonghieu WHERE Id = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thương hiệu thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa thương hiệu không thành công</span>";
				return $alert;
			}
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM thuonghieu WHERE Id = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>