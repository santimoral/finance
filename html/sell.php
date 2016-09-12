<?php       
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate submission
        if (empty($_POST["symbol"]) && empty($_POST["shares"])) {
            apologize("You must provide a symbol and a quantity.");
        } else if (empty($_POST["shares"])) {
            render("sell_form.php", ["title" => "Sell", "symbol" => $_POST["symbol"], "shares" => $_POST["max_shares"]]);
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
            
                // check that there are enough shares to sell
                $value = $shares * $price;
                $owned_row = query("SELECT shares FROM portfolio WHERE id=? and symbol=?", $userid, $symbol);
                $owned = $owned_row[0]["shares"];
            
                if ($owned < $shares) {
                    apologize("You don't have enough shares to sell.");       
                } else {
                    // input line in history
                    if (query("INSERT INTO `history`(`id`, `symbol`, `shares`, `price`, `sellorbuy`) VALUES (?, ?, ?, ?, 'SELL')", $userid, $symbol, $shares, $price) === false) {
                        apologize("Could not update history");
                    }
                
                    // update portfolio
                    if (query("UPDATE `portfolio` SET shares = shares - ? WHERE id = ? and symbol = ?", $shares, $userid, $symbol) === false) {
                        apologize("Could not update portfolio");
                    }
                
                    // update cash
                    if (query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $userid) === false) {
                        apologize("Could not update cash");
                    }
            
                    // redirect to portfolio
                    redirect("/");
                }
            }
        }
    } else {
        render("sell_form.php", ["sell" => "Buy", "symbol" => "", "shares" => "0"]);
    }
?>
