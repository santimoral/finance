<div>
    <table class="portfolio">
    <?php
        $history = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
        
        if ($history) {
            print("<tr>");
            print("<th>Symbol</th>");
            print("<th>Shares</th>");
            print("<th>Price</th>");
            print("<th>Operation</th>");
            print("<th>Date and time</th>");
            print("</tr>");            
            foreach ($history as $item) 
            {
                print("<tr>");
                print("<td>" . $item["symbol"] . "</td>");
                print("<td>" . $item["shares"] . "</td>");
                print("<td>" . $item["price"] . "</td>");
                print("<td>" . $item["sellorbuy"] . "</td>");
                print("<td>" . $item["timedate"] . "</td>");
                print("</tr>");
            }
        }
        else {
            print("You have no operations yet");
        }
    ?>
    </table>
</div>
