<?php

	class Session{

		//----Tao session ban dau luu phien giao dich----//
		public static function init(){
			if(version_compare(phpversion(), '5.4.0', '<')){
				if(session_id() == ''){
					session_start();
				}
			}else{
				if(session_status() == PHP_SESSION_NONE){
					session_start();
				}
			}
		}

		//----luu gia tri----//
		public static function set($key, $val){
			$_SESSION[$key] = $val;
		}

		public static function get($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			}else{
				return false;
			}
		}

		//----check phien lam viec xem co ton tai hay khong----//
		public static function checkSession(){
			self::init();
			if(self::get("adminlogin")== false){
				self::destroy();
				header("Location:login.php");
			}
		}

		public static function checkLogin(){
			self::init();
			if(self::get("adninlogin")== true){
				header("Location:index.php");
			}
		}

		//----huy phien lam viec----//
		public static function destroy(){
			session_destroy();
			header("Location:login.php");
		}
	}  
?>