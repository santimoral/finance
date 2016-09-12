<?php       
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate submission
        if (empty($_POST["symbol"]) && empty($_POST["shares"])) {
            apologize("You must provide a symbol and a quantity.");
        } else if (empty($_POST["shares"])) {
            render("buy_form.php", ["title" => "Buy"], ["symbol" => $_POST["symbol"]]);
        } else {
            // asign variables
            $userid = $_SESSION["id"];
            $symbol = $_POST["symbol"];
            $shares = $_POST["shares"];
            $price_row = lookup($symbol);
            $price = $price_row["price"];
            
            if($price === false) {  
                // if symbol is not found, apologize
                apologize("Symbol not found, please check.");
                        
            } else {
            
                // check that there is enough cash
                $value = $shares * $price;
                $cash_row = query("SELECT cash FROM users WHERE id=?", $userid);
                $cash = $cash_row[0]["cash"];
            
                if ($cash < $value) {
                    apologize("You don't have enough cash to buy.");       
                } else {
                    // input line in history
                    if (query("INSERT INTO `history`(`id`, `symbol`, `shares`, `price`, `sellorbuy`) VALUES (?, ?, ?, ?, 'BUY')", $userid, $symbol, $shares, $price) === false) {
                        apologize("Could not update history");
                    }
                
                    // update portfolio
                    if (query("INSERT INTO `portfolio`(`id`, `symbol`, `shares`, `price`) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $userid, $symbol, $shares, $price) === false) {
                        apologize("Could not update portfolio");
                    }
                
                    // update cash
                    if (query("UPDATE users SET cash = cash - ? WHERE id = ?", $shares * $price, $userid) === false) {
                        apologize("Could not update cash");
                    }
            
                    // redirect to portfolio
                    redirect("/");
                }
            }
        }
    } else {
        render("buy_form.php", ["title" => "Buy", "symbol" => ""]);
    }
?>
