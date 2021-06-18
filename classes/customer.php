
<?php
	class customer
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_customers($data){
            $name = mysqli_real_escape_string($this->db->link, $data['Name']);
            $address = mysqli_real_escape_string($this->db->link, $data['Address']);
            $city = mysqli_real_escape_string($this->db->link, $data['City']);
            $country = mysqli_real_escape_string($this->db->link, $data['Country']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['Zipcode']);
            $phone = mysqli_real_escape_string($this->db->link, $data['Phone']);
            $email = mysqli_real_escape_string($this->db->link, $data['Email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['Password']));
            if($name=="" || $address=="" || $city=="" || $country=="" || $zipcode=="" || $phone=="" || $email=="" || $password==""){
				$alert = "<span class='error'>Các trường không để trống";
                return $alert;
            }else{
                $check_email = "SELECT * FROM khachhang WHERE Email='$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='error'>Email đã tồn tại! Vui lòng nhập Email khác.";
                    return $alert;
                }else{
                    $query = "INSERT INTO khachhang(Name,Address,City,Country,Zipcode,Phone,Email,Password) VALUES
                    ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
				    $result = $this->db->insert($query);
				    if($result){
                        $alert = "<span class='success'>Đăng ký thành công</span>";
                        return $alert;
				    }else{
                        $alert = "<span class='error'>Đăng ký không thành công</span>";
                        return $alert;
				    }
                }
            }
        }
        public function login_customers($data){
            $email = mysqli_real_escape_string($this->db->link, $data['Email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['Password']));
            if($email=="" || $password==""){
				$alert = "<span class='error'>Các trường không để trống";
                return $alert;
            }else{
                $check_login = "SELECT * FROM khachhang WHERE Email='$email' AND Password='$password'";
                $result_check = $this->db->select($check_login);
                if($result_check){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_Id',$value['Id']);
                    Session::set('customer_Name',$value['Name']);
                    header('Location:order.php');
                }else{
                    $alert = "<span class='error'>Email hoặc Password không đúng";
                    return $alert;
                }
            }
        }
        public function show_customers($id){
            $query = "SELECT * FROM khachhang WHERE Id='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_customers($data, $id){
            $name = mysqli_real_escape_string($this->db->link, $data['Name']);
            $address = mysqli_real_escape_string($this->db->link, $data['Address']);
            // $city = mysqli_real_escape_string($this->db->link, $data['City']);
            // $country = mysqli_real_escape_string($this->db->link, $data['Country']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['Zipcode']);
            $phone = mysqli_real_escape_string($this->db->link, $data['Phone']);
            $email = mysqli_real_escape_string($this->db->link, $data['Email']);
            // $password = mysqli_real_escape_string($this->db->link, md5($data['Password']));
            if($name=="" || $address=="" || $zipcode=="" || $phone=="" || $email==""){
				$alert = "<span class='error'>Các trường không để trống";
                return $alert;
            }else{
                
                $query = "UPDATE khachhang SET Name='$name',Address='$address',Zipcode='$zipcode',Phone='$phone',Email='$email' WHERE Id='$id'";
				$result = $this->db->insert($query);
				if($result){
                    $alert = "<span class='success'>Cập nhật thành công</span>";
                    return $alert;
				}else{
                    $alert = "<span class='error'>Cập nhật không thành công</span>";
                    return $alert;
				}
                
            }
        }
		
	}
?>