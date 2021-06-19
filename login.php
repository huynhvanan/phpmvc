<?php
	// $filepath = realpath(dirname(__FILE__));
	// echo $filepath;
	// include 'config/config.php';
	
	// define("DB_HOST", "localhost");
	// define("DB_USER", "root");
	// define("DB_PASS", "");
	// define("DB_NAME", "php_mvc");

    include 'lib/session.php';
    // bắt buộc đăng nhập bằng tài khoản
    // bắt buộc đăng nhập bằng tài khoản
    Session::init();
?>
<?php
	include_once 'lib/database.php';
	include_once 'classes/product.php';
	include 'helpers/format.php';

	

    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });
    $db = new Database();
    $fm = new Format();
    $cat = new category();
    $ct = new cart();
    $cs = new customer();
    $product = new product();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<?php
    // $pd = new product();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // $Name = $_POST['Name']; 
        $insertCustomers = $cs->insert_customers($_POST);
    }
?>
<?php
    // $pd = new product();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        // $Name = $_POST['Name']; 
        $loginCustomers = $cs->login_customers($_POST);
    }
?>
<!DOCTYPE HTML>
<head>
<title>AnStore</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/9077082265df9881c1ce.jpg" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Tìm kiếm sản phẩm" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="Tìm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<strong class="opencart"> </strong>
								<span class="cart_title"></span>
									<span class="no_product"></span>
							</a>
						</div>
			      </div>
		   <div class="login">
		   <?php
				$login_check = Session::get('customer_login');
				if($login_check){
					
					header('Location:index.php');
				}
			?>
			<a href="login.php">Đăng nhập</a>
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
		<li><a href="index.php">Trang chủ</a></li>
		
		<?php
			$check_cart = $ct->check_cart();
			if($check_cart==true){
				echo '<li><a href="cart.php">Giỏ hàng</a></li>';
			}else{
				echo '';
			}
		?>
		
		<?php
			$login_check = Session::get('customer_login');
			if($login_check==false){
				echo '';
			}else{
				echo '<li><a href="profile.php">Thông tin</a></li>';
			}
	  	?>
	  
	  	
	  <div class="clear"></div>
	</ul>
</div>

 <div class="main">
    <div class="content">
    	<div class="login_panel">
        	<h3>Khách hàng</h3>
			<p>Đăng nhập tài khoản bên dưới</p>
			<?php
				if(isset($loginCustomers)){
					echo $loginCustomers;
				}
			?>
        	<form action="" method="POST" id="member">
                <input  type="text" name="Email" class="field" placeholder="Nhập email....">
                <input  type="password" name="Password" class="field" placeholder="Nhập password....">
            
				<p class="note">Nếu bạn quên mật khẩu, chỉ cần nhập email của bạn và <a href="#">bấm vào đây</a></p>
				<div class="buttons"><div><input type="submit" name="login" class="grey" value="Đăng nhập"></div></div>
			</form>
		</div>
		<?php
			// $
		?>
    	<div class="register_account">
			<h3>Đăng ký tài khoản mới</h3>
			<?php
				if(isset($insertCustomers)){
					echo $insertCustomers;
				}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="Name" placeholder="Nhập tên...." >
							</div>
							
							<div>
							   <input type="text" name="City" placeholder="Nhập tên thành phố....">
							</div>
							
							<div>
								<input type="text" name="Zipcode" placeholder="Nhập zipcode....">
							</div>
							<div>
								<input type="text" name="Email" placeholder="Nhập email....">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="Address" placeholder="Nhập địa chỉ....">
						</div>
		    		<div>
						<select id="country" name="Country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="Phone" placeholder="Nhập SĐT....">
		          </div>
				  
				  <div>
					<input type="text" name="Password" placeholder="Nhập mật khẩu....">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div></div>
		    <p class="terms">Bằng cách nhấp vào 'Tạo tài khoản', bạn đồng ý với <a href="#">Điều khoản &amp; Điều kiện.</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
		 <div class="col_1_of_4 span_1_of_4">
						<h4>Thông tin</h4>
						<ul>
						<li><a href="#">Về chúng tôi</a></li>
						<li><a href="#">Dịch vụ CSKH</a></li>
						<li><a href="#"><span>Tìm kiếm nâng cao</span></a></li>
						<li><a href="#">Đơn hàng và trả lại</a></li>
						<li><a href="#"><span>Liên hệ chúng tôi</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tại sao mua từ chúng tôi</h4>
						<ul>
						<li><a href="about.html">Về chúng tôi</a></li>
						<li><a href="faq.html">Dịch vụ CSKH</a></li>
						<li><a href="#">Chính sách bảo mật</a></li>
						<!-- <li><a href="contact.html"><span>Site Map</span></a></li>
						<li><a href="preview-2.html"><span>Search Terms</span></a></li> -->
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tài khoản của tôi</h4>
						<ul>
							<li><a href="contact.php">Đăng nhập</a></li>
							<li><a href="index.php">Xem giỏ hàng</a></li>
							<!-- <li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.html">Help</a></li> -->
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Liên hệ</h4>
						<ul>
							<li><span>0398579414</span></li>
							<!-- <li><span>+00-123-000000</span></li> -->
						</ul>
						<div class="social-icons">
							<h4>Theo dõi chúng tôi</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p></a> </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>

