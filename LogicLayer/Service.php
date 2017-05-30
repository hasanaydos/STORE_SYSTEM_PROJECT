<?php
	class Service{
		
		public function getService($url, $attribute, $value){ //getService("http://md5.jsontest.com?","text","hello world");
		
			$headers = array(
				"Content-Type: application/json"
			);
			
			// query string for sending our text parameter
			$fields = "";
			
			$fields = array(
				"$attribute" => $value
			);
			
			// prepare GET query
			// can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
			$url = $url . http_build_query($fields);
			
			// initialize a cURL session
			$ch = curl_init();
		
			// set the url, number of GET vars, GET data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			// TRUE to return the transfer as a string of the return value of curl_exec() 
			// instead of outputting it out directly
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			// FALSE to stop cURL from verifying the peer's certificate.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			// execute request
			$result = curl_exec($ch);
			
			// close cURL resource, and free up system resources
			curl_close($ch);
			
			return $result;
		}
		
		/*
			$ch = curl_init(); // oturum baslat
			// POST  adresi
			curl_setopt($ch, CURLOPT_URL,"http://www.site.com/test.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"isim=ahmet&soyad=yilmaz");
			curl_exec ($ch);
			curl_close ($ch);
		*/
		
		public function postService(){
			
		}
		
	}
?>