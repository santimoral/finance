<form action="sell.php" method="post">
    <fieldset>
        <div class="control-group">
            <select name="symbol" placeholder="symbol" value="<?php echo $symbol?>">
                <?php 
                $positions = query("SELECT * FROM portfolio WHERE id = ? and shares > 0", $_SESSION["id"]);
                if ($positions) {
                    foreach($positions as $position) {
                        print("<option value=\"".$position["symbol"]."\">".$position["symbol"]."</option>");
                    }
                }            
                ?>
            </select>
        </div>
        <div class="control-group">
            <input name="shares" type="number" placeholder="<?php echo $shares?>" value=""/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn-lookup">Sell</button>
        </div>
    </fieldset>
</form>
