<?php       
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // validate submission
        if (!empty($_GET["symbol"])) {
            // asign variables
            $symbol = $_GET["symbol"];
            $stock_row = lookup($symbol);
            
            if($stock_row !== false) {
                $price = $stock_row["price"];
                $company = $stock_row["name"];
                print("{'symbol' : '$symbol', 'company' : '$company', 'price' : '$price'}");
            } else {
                print("Company not found");
            }
         }
     }     
?>
