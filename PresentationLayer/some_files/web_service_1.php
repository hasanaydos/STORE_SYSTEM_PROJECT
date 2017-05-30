<?php
    session_start();
    
    require_once("../Path.php");
    
   
if (isset($_SESSION['p_id'])) {
    // connect DB
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "store_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

    $p_id = $_SESSION['p_id'];
    /// get product
    $stmtProduct = $conn->prepare("SELECT * FROM products WHERE p_id = $p_id ORDER BY p_name");
    $stmtProduct->execute();
    $stmtProduct->bind_result($p_id, $p_name, $quantity);

    //// get properties
    
    $stmtProperties = $conn->prepare("select * from product_property as pp, properties as pr where pp.p_id = $p_id and pr.pr_id = pp.pr_id order by pr.pr_id");
    $stmtProperties->execute();
    $stmtProperties->bind_result($pr_id, $pr_name, $pr_value);
    
    //napıyon
    $properties = array();
    
    for ($i = 0; $i < 5; $i++) {
        array_push($properties, array("property_" . $i, "value_" . $i));
    }

    $product = array("product" => array(
            "id" => $p_id,
            "name" => $p_name,
            "quantity" => $quantity,
            "properties" => $properties
        )
    );

    $stmtProduct->close(); // close statement
    $stmtProperties ->close();


    // JSON output
    header('Content-type: application/json');
    echo json_encode($product);
    

    $conn->close(); // close DB connection

    unset($_SESSION['p_id']);
} else {
    echo "NO p_id VARIABLE !!!!!";
}
?>		