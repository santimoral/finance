<div>
    <table class="portfolio">
    <?php
        $userid = $_SESSION["id"];
        $userinfo = query("SELECT * FROM users WHERE id = ?", $userid);
        $cash = $userinfo[0]["cash"];
        $positions = query("SELECT * FROM portfolio WHERE id = ? and shares > 0", $userid);
        
        if ($positions) {
            print("<tr><th>Symbol</th><th>Shares</th><th>Purchase price</th><th>Purchase value</th><th>Current price</th><th>Current value</th><th colspan=\"3\">Actions</th></tr>");            
            $total_purchase_value = 0;
            $total_current_value = 0;
            foreach ($positions as $position) 
            {
                $symbol = $position["symbol"];
                $shares = $position["shares"];
                $price = $position["price"];
                $purchase_value = $shares * $price;
                $stock = lookup($position["symbol"]);
                $current_price = $stock["price"];
                $current_value = $shares * $current_price;
                print("<tr>");
                print("<td class=\"symbol\">" . $symbol . "</td>");
                print("<td class=\"shares\">" . $shares . "</td>");
                print("<td class=\"price\">" . number_format($price, 2) . "</td>");
                print("<td>" . number_format($purchase_value, 2) . "</td>");
                $total_purchase_value += $purchase_value;
                print("<td>" . number_format($current_price, 2) . "</td>");
                print("<td>" . number_format($current_value, 2) . "</td>");
                $total_current_value += $current_value;
                print("<td>");
                print("<form class=\"action\" action=\"sell.php\" method=\"post\">");
                print("<fieldset>");
                print("<input name=\"symbol\" value=\"". $symbol ."\" type=\"text\" style=\"display:none\"/>");
                print("<input name=\"shares\" value=\"". $shares ."\" type=\"text\" style=\"display:none\"/>");
                print("<button type=\"submit\" class=\"sell-btn\">Sell all</button>");
                print("</fieldset>");
                print("</form>");
                print("</td>");
                print("<td>");
                print("<form class=\"action\" action=\"sell.php\" method=\"post\">");
                print("<fieldset>");
                print("<input name=\"symbol\" value=\"". $symbol ."\" type=\"text\" style=\"display:none\"/>");
                print("<input name=\"max_shares\" value=\"". $shares ."\" type=\"text\" style=\"display:none\"/>");
                print("<button type=\"submit\" class=\"sell-btn\">Sell partially</button>");
                print("</fieldset>");
                print("</form>");
                print("</td>");
                print("<td>");
                print("<form class=\"action\" action=\"buy.php\" method=\"post\">");
                print("<fieldset>");
                print("<input name=\"symbol\" value=\"". $symbol. "\" type=\"text\" style=\"display:none\"/>");
                print("<button type=\"submit\" class=\"buy-btn\">Buy more</button>");
                print("</fieldset>");
                print("</form>");
                print("</td>");
                print("</tr>");
            }
        }
        else {
            print("You have no stock yet");
        }
    ?>
</table>
</div>
<div class="summary">
    <?php
        $net = $total_current_value - $total_purchase_value;
        print("<p>Total purchase value: ".number_format($total_purchase_value, 2)."</p>");
        print("<p>Total current value: ".number_format($total_current_value, 2)."</p>");
        print("<p>Net gain/loss: ".number_format($net, 2)."</p>");
        print("<p>Cash balance:".number_format($cash, 2)."</p>");
    ?>
</div>
