
<?php
	class cart
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function add_to_cart($quantity, $id){
			if (session_id() === '') session_start();
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$Id_session = session_id();
			$query = "SELECT * FROM sanpham WHERE Id = '$id'";
			$result = $this->db->select($query)->fetch_assoc();
			$hinhanh = $result['hinhanh'];
			$gia = $result['gia'];
			$tensanpham = $result['Name'];
			// $check_cart = "SELECT * FROM giohang WHERE Id = '$id' AND Id_session = '$Id_session'";
			// if($check_cart){
			// 	$msg = "Sản phẩm đã được thêm";
			// 	return $msg;
			// }else{
			
				$query = "INSERT INTO giohang(Id_sanpham,Id_session,tensanpham,gia,soluong,hinhanh) 
				VALUES('$id','$Id_session','$tensanpham','$gia','$quantity','$hinhanh')";
				$insert_cart = $this->db->insert($query);
				if($insert_cart){
					header('Location:cart.php');
				}else{
					header('Location:404.php');
				}
			// }
		}
		public function get_product_cart(){
			if (session_id() === '') session_start();
			$Id_session = session_id();
			$query = "SELECT * FROM giohang WHERE Id_session = '$Id_session'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_quantity_cart($quantity, $Id_giohang){
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$Id_giohang = mysqli_real_escape_string($this->db->link, $Id_giohang);
			$query = "UPDATE giohang SET 
				soluong = '$quantity'
				WHERE Id_giohang = '$Id_giohang'";
			$result = $this->db->update($query);
			if($result){
				header('Location:cart.php');
			}else{
				$msg = "<span class='error'>Số lượng sản phẩm cập nhật không thành công</span>";
				return $msg;
			}	
			
		}
		public function delete_product_cart($id){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "DELETE FROM giohang WHERE Id_giohang = '$id'";
			$result = $this->db->delete($query);
			if($result){
				header('Location:cart.php');
				// $msg = "<span class='success'>Xóa sản phẩm thành công</span>";
				// return $msg;
			}else{
				$msg = "<span class='error'>Xóa sản phẩm không thành công</span>";
				return $msg;
			}
		}
		public function check_cart(){
			if (session_id() === '') session_start();
			$Id_session = session_id();
			$query = "SELECT * FROM giohang WHERE Id_session = '$Id_session'";
			$result = $this->db->select($query);
			return $result;
		}
		public function check_order($customer_Id){
			if (session_id() === '') session_start();
			$Id_session = session_id();
			$query = "SELECT * FROM dathang WHERE Id_khachhang = '$customer_Id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function delete_all_data_cart(){
			if (session_id() === '') session_start();
			$Id_session = session_id();
			$query = "DELETE FROM giohang WHERE Id_session = '$Id_session'";
			$result = $this->db->delete($query);
			return $result;
		}
		public function insertOrder($customer_Id){
			if (session_id() === '') session_start();
			$Id_session = session_id();
			$query = "SELECT * FROM giohang WHERE Id_session = '$Id_session'";
			$get_product = $this->db->select($query);
			if($get_product){
				while($result = $get_product->fetch_assoc()){
					$Id_sanpham = $result['Id_sanpham'];
					$Tensanpham = $result['tensanpham'];
					$Soluong = $result['soluong'];
					$Gia = $result['gia'] *$Soluong;
					$Hinhanh = $result['hinhanh'];
					$customer_Id = $customer_Id;
					$query_order= "INSERT INTO dathang(Id_sanpham,Tensanpham,Soluong,Gia,Hinhanh,Id_khachhang) 
					VALUES('$Id_sanpham','$Tensanpham','$Soluong','$Gia','$Hinhanh','$customer_Id')";
					$insert_order = $this->db->insert($query_order);
					
				}
			}
		}
		public function getAmountPrice($customer_Id){
			$query = "SELECT Gia FROM dathang WHERE Id_khachhang = '$customer_Id'";
			$get_price = $this->db->select($query);
			return $get_price;
		}
		public function get_cart_ordered($customer_Id){
			$query = "SELECT * FROM dathang WHERE Id_khachhang = '$customer_Id'";
			$get_cart_ordered = $this->db->select($query);
			return $get_cart_ordered;
		}
		public function get_inbox_cart(){
			$query = "SELECT * FROM dathang ORDER BY Ngay";
			$get_inbox_cart = $this->db->select($query);
			return $get_inbox_cart;
		}
		public function shifted($id, $time, $price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE dathang SET 
				Trangthai = '1'
				WHERE Id = '$id' AND Ngay='$time' AND Gia='$price'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Cập nhật đơn hàng thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Cập nhật đơn hàng không thành công</span>";
				return $msg;
			}	
		}
		public function delete_shifted($id, $time, $price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "DELETE FROM dathang 
				WHERE Id = '$id' AND Ngay='$time' AND Gia='$price'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Xóa đơn hàng thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Xóa đơn hàng không thành công</span>";
				return $msg;
			}
		}
		public function shifted_confirm($id, $time, $price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE dathang SET 
				Trangthai = '2'
				WHERE Id_khachhang = '$id' AND Ngay='$time' AND Gia='$price'";
			$result = $this->db->update($query);
			return $result;
			
		}
		
	}
?>