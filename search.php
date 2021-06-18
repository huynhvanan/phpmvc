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
    // $us = new user();
    $product = new product();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
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
				    <form action="search.php" method="POST">
                    <input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
						<input type="submit" name="search_product" value="Tìm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title"></span>
								<span class="no_product"></span>
							</a>
						</div>
			      </div>
		   <!-- <div class="login"><a href="login.php">Login</a></div> -->
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	<li><a href="index.php">Trang chủ</a></li>
	  <!-- <li><a href="products.php">Sản phẩm</a> </li>
	  <li><a href="topbrands.php">Thương hiệu</a></li> -->
	  <li><a href="cart.php">Giỏ hàng</a></li>
	  <li><a href="profile.php">Thông tin</a></li>
	  <!-- <li><a href="contact.php">Liên hệ</a> </li> -->
	  <div class="clear"></div>
	</ul>
</div>
<?php
    // $cat = new category();
    // if(isset($_GET['Id']) && $_GET['Id']==NULL){
    //     echo "<script>window.location = '404.php'</script>";
    // }else{
    //     $id = $_GET['Id'];
    // }
    
?>
 <div class="main">
    <div class="content">
	<?php
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tukhoa = $_POST['tukhoa']; 
            $search_product = $product->search_product($tukhoa);
        }

						
					
	?> 
    	<div class="content_top">
		 
    		<div class="heading">
    		<h3>Từ khóa tìm kiếm: <?php echo $tukhoa; ?></h3>
			</div>
			
    		<div class="clear"></div>
		</div>
		<?php
		// 	}
		// }
		?>
	      <div class="section group">
				<?php
					// $productbycat = $cat->get_product_by_cat($id);
					if($search_product){
						while($result = $search_product->fetch_assoc()){

						
					
				?>  
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="#"><img src="admin/upload/<?php echo $result['hinhanh'] ?>" alt="" /></a>
					 <h2 style="color:black;"><?php echo $result['Name'] ?></h2>
					 <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
					 <p><span class="price"><?php echo $result['gia'] ?></span></p>
				     <div class="button"><span><a href="detail.php?Id=<?php echo $result['Id'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
					}
				}
				?>
			</div>

	
	
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

