<?php
	
	class Format{
		public function formatDate($date){
			return date('F j, Y, g:i a', strtotime($date));
		}

		//----text ngan----//
		public function textShorten($text, $limit = 400){
			$text = $text. " ";
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text.".....";
			return $text;
		}

		//----kiem tra form trong hoac khong trong----//
		public function validation($data){
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		//----kiem tra ten cua server----//
		public function title(){
			$path = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($path, '.php');
			//$title = str_replace('_',' ',$title);
			if($title == 'index'){
				$title = 'home';
			}elseif($title == 'contact'){
				$title = 'contact';
			}
			return $title = ucfirst($title);
		}
		public function format_currency($n=0){
			$n=(string)$n;
			$n=strrev($n);
			$res='';
			for($i=0;$i<strlen($n);$i++){
				if($i%3==0 && $i!=0){
					$res.='.';
				}
				$res.=$n[$i];
			}
			$res=strrev($res);
			return $res;
		}
	}  
?>