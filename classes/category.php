<?php
	// $filepath = realpath(dirname(__FILE__));
	// include ('../lib/database.php');
	// include_once ('../helpers/format.php');
?>
<?php
	/**
	 * 
	 */
	class category
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_category($Name){
			$Name = $this->fm->validation($Name);
			$Name = mysqli_real_escape_string($this->db->link, $Name);
			
			if(empty($Name)){
				$alert = "<span class='error'>Danh mục không nên để trống";
				return $alert;
			}else{
				$query = "INSERT INTO danhmuc(Name) VALUES('$Name')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
					return $alert;
				}
			}
		}
		public function show_category(){
			$query = "SELECT * FROM danhmuc order by Id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_category($Name,$id){
			$Name = $this->fm->validation($Name);
			$Name = mysqli_real_escape_string($this->db->link, $Name);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if(empty($Name)){
				$alert = "<span class='error'>Danh mục không nên để trống";
				return $alert;
			}else{
				$query = "UPDATE danhmuc SET Name = '$Name' WHERE Id = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
					return $alert;
				}
			}
		}
		public function delete_category($id){
			$query = "DELETE FROM danhmuc WHERE Id = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa sản phẩm thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
				return $alert;
			}
		}
		public function getcatbyId($id){
			$query = "SELECT * FROM danhmuc WHERE Id = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_product_by_cat($id){
			$query = "SELECT sanpham.*, danhmuc.Name as ten, danhmuc.Id as id_cat FROM sanpham,danhmuc WHERE sanpham.Id_dm=danhmuc.Id AND sanpham.Id_dm = '$id' ";

			// $query = "SELECT * FROM sanpham,danhmuc WHERE danhmuc.Id=sanpham.Id_dm AND Id_dm='$id' order by danhmuc.Id desc LIMIT 1";
			// $query = "SELECT * FROM danhmuc WHERE Id='$id'order by Id desc LIMIT 8";
			$result = $this->db->select($query);
			
			return $result;
		}
	}
?>