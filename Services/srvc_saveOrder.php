<?php
require_once("../Path.php");
require_once(PATH."LogicLayer/ProductManager.php");
require_once(PATH."LogicLayer/OrderManager.php");
require_once(PATH."LogicLayer/Service.php");

if (isset($_GET["orderID"])) {
	
    $o_id = $_GET["orderID"];
    //$file_content = file_get_contents("http://www.bilisimarsivi.com/supplier/srvc_sendStore_pro.php?productNO=$p_id");
    ///$file_content = Service::getService("http://www.bilisimarsivi.com/shopping/service.php?","orderID",$o_id);
    
    
    ///
    $file_content = '  {
                        "order":{
                                "orderID":"21",
                                "totalPrice":"1800",
                                "products":[
                                                {
                                                        "orderID":"20",
                                                        "productID":"54545",
                                                        "amount":"150",
                                                        "price":"300"
                                                },
                                                {
                                                        "orderID":"20",
                                                        "productID":"776545",
                                                        "amount":"5",
                                                        "price":"600"
                                                }
                                            ]
                        },
                        "Customer":{
                                    "ID":"7",
                                    "Name":"Hasan",
                                    "Surname":"Aydos",
                                    "identification":"98765432121",
                                    "Phone":"2333333333",
                                    "Address":{
                                                "addressID":"1",
                                                "addressName":"kestel",
                                                "country":"T\u00fcrkiye",
                                                "city":"Bursa",
                                                "town":"Kestel",
                                                "detail":"Vani Mehmet Mah. ,A\u015fa\u011f\u0131 Sokak, No 999;"
                                            }
                                }
            }';
    ///
    $json =  json_decode($file_content);
    //$json =  json_decode($file_content);
	
   
    $order_id   = $json->order->orderID;
    
    $name       = $json->Customer->Name;
    $surname    = $json->Customer->Surname;
    $c_id       = $json->Customer->identification;
    $phone      = $json->Customer->Phone;
    $address_name       = $json->Customer->Address->addressName;
    $address_country    = $json->Customer->Address->country;
    $address_city       = $json->Customer->Address->city;
    $address_town       = $json->Customer->Address->town;
    $address_detail     = $json->Customer->Address->detail;
    
    $productCount = count($json->order->products);
    $products = $json->order->products;
    
    $result = OrderManager::insertNewOrder($order_id, $name, $surname, "Not Send", "Empty");
     
    for ($i = 0; $i < $productCount; $i++){
        
        $p_id       = $products[$i]->productID;
        $quantity   = $products[$i]->amount;
        $price      = $products[$i]->price;
        
        $product = ProductManager::getProduct($p_id);
        $new_quantity = $product->getQuantity() - $quantity;
        
        $result = ProductManager::updateProduct($p_id, $product->getP_name(), $new_quantity);
    }
    
    $senderName  = "E-Shoping";
    $receiverName= $name." ".$surname;

    $weight     = "10";
    $volume     = "5";
    $breakable  = 0;
    $cargoDetail= $address_name;

    $sCity      = "Izmir";
    $sCountry   = "Buca";
    $sDetail    = "Zafer Mah. 2352 Sk. No:9 Kaynaklar";

    $dCity      = $address_city;
    $dCountry   = $address_country;
    $dDetail    = $address_detail;
 
   
    //echo $dataJSON;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"deneme.php");
    //curl_setopt($ch, CURLOPT_URL,"http://cargo456.000webhostapp.com/api/newcargo.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "senderName=".$senderName."&receiverName=".$receiverName."&weight=".$weight."&volume=".$volume."&breakable=".$breakable."&cargoDetail=".$cargoDetail."&sCity=".$sCity."&sCountry=".$sCountry."&sDetail=".$sDetail."&dCity=".$dCity."&dCountry=".$dCountry."&Detail=".$dDetail);
                                                    
    
    $response = curl_exec ($ch);
    if ($response == "") {
         echo "there is a problem";
     } else {
          echo $response;
       // header("location:../PresentationLayer/show_orders.php");
     }
    curl_close ($ch);
    
    ///////////////////////////////////////////
    /*
    $data = array("name" => "Hagrid", "age" => "36");                                                                    
    $data_string = json_encode($data);                                                                                   

    $ch = curl_init('http://api.local/rest/users');                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    curl_close ($ch);
     
     */
}

?>		