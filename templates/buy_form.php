 <form action="buy.php" method="post">
    <fieldset>
        <div class="control-group">
            <input name="symbol" type="text" placeholder="symbol" value="<?php echo $symbol?>"/>
        </div>
        <div class="control-group">
            <input name="shares" type="number" placeholder="quantity"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn-lookup">Buy</button>
        </div>
    </fieldset>
</form>
