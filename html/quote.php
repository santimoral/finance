<?php       
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate submission
        if (empty($_POST["symbol"])) {
            render("quote_form.php", ["title" => "Quote"]);
        } else if (length($_POST["symbol"]) > 6){
            render("quote_form.php", ["title" => "Quote"]);
        } else {
            // asign variables
            $symbol = $_POST["symbol"];
            $stock_row = lookup($symbol);
            
            if($stock_row === false) {  
                apologize("Cannot find that symbol");
                        
            } else {
                $price = $stock_row["price"];
                $company = $stock_row["name"];
                render("quote_result.php", ["title" => "Quote", "symbol" => $symbol, "company" => $company, "price" => $price]);
            }
        }     
    }
    else {
        render("quote_form.php", ["title" => "Quote"]);
    }
?>
