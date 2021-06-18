<!-- <?php
	// $filepath = realpath(dirname(__FILE__));
	// include_once ($filepath. 'lib/database.php');
	// include_once ($filepath. 'helpers/format.php');
?> -->
<?php
	class product
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function search_product($tukhoa){
			$tukhoa = $this->fm->validation($tukhoa);
			$query = "SELECT * FROM sanpham WHERE Name LIKE '%$tukhoa%'";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_product($data, $files){
            $Name = mysqli_real_escape_string($this->db->link, $data['Name']);
            $thuonghieu = mysqli_real_escape_string($this->db->link, $data['thuonghieu']);
            $danhmuc = mysqli_real_escape_string($this->db->link, $data['danhmuc']);
            $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
            $gia = mysqli_real_escape_string($this->db->link, $data['gia']);
			$kieu = mysqli_real_escape_string($this->db->link, $data['kieu']);
			// kiem tra hinh anh va lay hinh anh trong folder
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['hinhanh']['name'];
			$file_size = $_FILES['hinhanh']['size'];
			$file_temp = $_FILES['hinhanh']['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10,).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;
			if($Name=="" || $thuonghieu=="" || $danhmuc=="" || $mota=="" || $kieu=="" || $gia=="" || $file_name==""){
				$alert = "<span class='error'>Sản phẩm không nên để trống";
				return $alert;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO sanpham(Name,Id_dm,thuonghieu,mota,kieu,gia,hinhanh) VALUES('$Name','$danhmuc','$thuonghieu','$mota','$kieu','$gia','$unique_image')";
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
		public function insert_slider($data, $files){
			$Ten = mysqli_real_escape_string($this->db->link, $data['Ten']);
            $Kieu = mysqli_real_escape_string($this->db->link, $data['Kieu']);
            // $Hinhanh = mysqli_real_escape_string($this->db->link, $data['Hinhanh']);
            // $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
            // $gia = mysqli_real_escape_string($this->db->link, $data['gia']);
			// $kieu = mysqli_real_escape_string($this->db->link, $data['kieu']);
			// kiem tra hinh anh va lay hinh anh trong folder
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['Hinhanh']['name'];
			$file_size = $_FILES['Hinhanh']['size'];
			$file_temp = $_FILES['Hinhanh']['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10,).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;
			if($Ten=="" || $Kieu==""){
				$alert = "<span class='error'>Không nên để trống";
				return $alert;
			}else{
				if(!empty($file_name)){
					if($file_size > 10000){
						$alert = "<span class='success'>Image size should be less then 1MB!</span>";
						return $alert;
					}elseif(in_array($file_ext, $permited) === false){
						$alert = "<span class='success'>You can upload only:-" .implode(',', $permited)."</span>";
						return $alert;
					}
					$query = "INSERT INTO slider(Ten,Kieu,Hinhanh) VALUES('$Ten','$Kieu','$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm slider thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm slider không thành công</span>";
						return $alert;
					}
				}
			}		
			
		}
		public function show_product(){
			$query = "SELECT sanpham.Id, sanpham.gia,sanpham.Name AS Name, sanpham.kieu, sanpham.mota, sanpham.hinhanh, danhmuc.Name AS nameDM, thuonghieu.Name AS nameTH 
			FROM sanpham, danhmuc, thuonghieu WHERE danhmuc.Id=sanpham.Id_dm AND thuonghieu.Id=sanpham.thuonghieu;";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_product($data, $files, $id){
			$Name = mysqli_real_escape_string($this->db->link, $data['Name']);
            $thuonghieu = mysqli_real_escape_string($this->db->link, $data['thuonghieu']);
            $danhmuc = mysqli_real_escape_string($this->db->link, $data['danhmuc']);
            $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
            $gia = mysqli_real_escape_string($this->db->link, $data['gia']);
			$kieu = mysqli_real_escape_string($this->db->link, $data['kieu']);
			// kiem tra hinh anh va lay hinh anh trong folder
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['hinhanh']['name'];
			$file_size = $_FILES['hinhanh']['size'];
			$file_temp = $_FILES['hinhanh']['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10,).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;
			if($Name=="" || $thuonghieu=="" || $danhmuc=="" || $mota=="" || $kieu=="" || $gia==""){
				$alert = "<span class='error'>Sản phẩm không nên để trống";
				return $alert;
			}else{
				if(!empty($file_name)){
					if($file_size > 10000){
						$alert = "<span class='success'>Image size should be less then 1MB!</span>";
						return $alert;
					}elseif(in_array($file_ext, $permited) === false){
						$alert = "<span class='success'>You can upload only:-" .implode(',', $permited)."</span>";
						return $alert;
					}
					$query = "UPDATE sanpham SET 
					Name = '$Name',
					thuonghieu = '$thuonghieu',
					Id_dm = '$danhmuc',
					kieu = '$kieu',
					gia = '$gia',
					hinhanh = '$unique_image',
					mota = '$mota'
					WHERE Id = '$id'";
				}else {
					$query = "UPDATE sanpham SET 
					Name = '$Name',
					thuonghieu = '$thuonghieu',
					Id_dm = '$danhmuc',
					kieu = '$kieu',
					gia = '$gia',
					-- hinhanh = '$unique_image',
					mota = '$mota'
					WHERE Id = '$id'";
				}
			}		
			$result = $this->db->update($query);
			if($result){
				$alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
				return $alert;
			}	
		}
		public function delete_product($id){
			$query = "DELETE FROM sanpham WHERE Id = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa sản phẩm thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
				return $alert;
			}
		}
		public function getproductbyId($id){
			$query = "SELECT * FROM sanpham WHERE Id = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		// Frontend
		public function getproduct_feathred(){
			$query = "SELECT * FROM sanpham WHERE kieu = '1' ";
			$result = $this->db->select($query);
			return $result;			
		}
		public function getproduct_new(){
			$sp_tungtrang = 4;
			if(!isset($_GET['trang'])){
				$trang = 1;
			}else{
				$trang = $_GET['trang'];
			}
			$tung_trang = ($trang - 1)*$sp_tungtrang;
			$query = "SELECT * FROM sanpham order by Id  desc LIMIT $tung_trang,$sp_tungtrang";
			$result = $this->db->select($query);
			return $result;			
		}
		public function get_all_product(){
			// $sp_tungtrang = 4;
			// if(!isset($_GET['trang'])){
			// 	$trang = 1;
			// }else{
			// 	$trang = $_GET['trang'];
			// }
			// $tungtrang = ($trang = 1)*$sp_tungtrang;
			$query = "SELECT * FROM sanpham";
			$result = $this->db->select($query);
			return $result;			
		}
		public function get_details($id){
			$query = "SELECT sanpham.Id, sanpham.gia,sanpham.Name AS Name, 
			sanpham.kieu, sanpham.mota, sanpham.hinhanh, danhmuc.Name AS nameDM, thuonghieu.Name AS nameTH 
			FROM sanpham, danhmuc, thuonghieu WHERE danhmuc.Id=sanpham.Id_dm AND thuonghieu.Id=sanpham.thuonghieu AND sanpham.Id = $id LIMIT 1;";
			$result = $this->db->select($query);
			return $result;			
		}
		public function getLastesSamSung(){
			// $query = "SELECT * FROM sanpham,thuonghieu WHERE thuonghieu.Id=sanpham.thuonghieu AND thuonghieu='13' order by sanpham.Id desc LIMIT 1";
			$query = "SELECT * FROM sanpham WHERE thuonghieu='13' order by Id desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastesApple(){
			$query = "SELECT * FROM sanpham WHERE thuonghieu='12' order by Id desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastesBelkin(){
			$query = "SELECT * FROM sanpham WHERE thuonghieu='15' order by Id desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastesXiaoMi(){
			$query = "SELECT * FROM sanpham WHERE thuonghieu='11' order by Id desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>