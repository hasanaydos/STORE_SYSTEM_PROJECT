<?php
	$getFile = file_get_contents("http://www.bilisimarsivi.com/shopping/json/asas.json");

	$json = json_decode($getFile);
	 
	echo "<pre>";
	print_r ($json); //Bu sefer ekrana biraz daha farklý bir sonuç bastý. 
	echo "</pre>";
	echo "<hr>";
	 
	 for($i=0;$i<count($json->product->properties);$i++){
		 
		echo "property: ".$json->product->properties[$i][0]." value: ".$json->product->properties[$i][1].  "<br>";
		 
		 
	 }
?>