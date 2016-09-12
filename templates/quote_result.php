<div>
    <form class="action" action="buy.php" method="post">
       <table class="quote-form">
                <tr><td>Symbol:</td><td><input name="symbol" value="<?php echo $symbol?>" type="text"/></td></tr>
                <tr><td>Price:</td><td><?php echo $price?></td></tr>
                <tr><td>Shares:</td><td><input name="shares" value="" type="text"/></td></tr>
                <tr><td colspan="2"><button type="submit" class="buy-btn">Buy</button></td></tr>
            </table>
    </form>
</div>

