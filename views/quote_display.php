<h1> 
    <?php print( $_SESSION["stockinfo"]["symbol"] );  ?> 
</h1>

<p>
    <?php print( $_SESSION["stockinfo"]["name"] . ": ". $_SESSION["stockinfo"]["symbol"] ); ?>
</p>

<p>
    <?php print( "$". $_SESSION["price_formated"] ); ?>
</p>




