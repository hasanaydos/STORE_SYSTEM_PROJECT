<?php
require_once("../Path.php");
require_once(PATH."LogicLayer/OrderManager.php");
require_once(PATH."LogicLayer/Service.php");

if (isset($_GET["orderID"])) {
	
    //$p_id = $_GET["productNO"];
    //$file_content = file_get_contents("http://www.bilisimarsivi.com/supplier/srvc_sendStore_pro.php?productNO=$p_id");
    $file_content = Service::getService("http://www.bilisimarsivi.com/supplier/srvc_sendStore_pro.php?","productNO",$p_id);
    
    //$json =  json_decode($file_content);
    $json =  json_decode($_POST["product"]);

	
    $id 	= $json->product->id;
    $name 	= $json->product->name;
    $quantity   = $json->product->quantity;
	
    //firstly add product to products table
    $result = ProductManager::insertNewProduct($id, $name, $quantity);

    // her bir property için property tablosunda olup olmadığını kontrol et
    // eğer property tablosunda mevcut değilse evvela yeni property i properties tablosuna ekle 
    // daha sonra bu property nin id sini product_property tablosuna ekle
    // eğer property tabloda mevcutsa onun id sini product_property tablosuna ekle
    $propertyCount = count($json->product->properties);
	
    for ($i = 0; $i < $propertyCount; $i++) {
		
        $propertyName = $json->product->properties[$i][0];
        $propertyValue = $json->product->properties[$i][1];


        $finded_property = PropertyManager::findExistingProperty($propertyName, $propertyValue);
       
        //bu property daha önce veri tabanımıza eklenmiş, şimdi bu property ve product'ı product_properties tablomuza ekleyeceğiz
        if ($finded_property != NULL) {
          
            $add_product_properties = PropertyManager::insertToProductProperties($p_id, $finded_property->getPr_id());
			
        } else {//demekki böyle bir propery properties tablomuzda yok, şimdi yeni ekleyeceğiz
		
            $new_property_id = PropertyManager::insertNewProperty($propertyName, $propertyValue);
            if ($new_property_id != -1) {
                $add_product_properties = PropertyManager::insertToProductProperties($p_id, $new_property_id);
            }
        }
    }	
}

?>		