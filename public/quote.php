<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("../views/quote_form.php", ["title" => "Quotes"] );
    }
  
  
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {  
        
        if( ( $_SESSION["stockinfo"] = lookup($_POST["stock"]) ) == false )
        {
            apologize( "Symbol does not match any known stock. Please try again.");
        }
        
        else 
        {   // var_dump($_SESSION); 
            //echo( "<pre>" . var_dump($_SESSION) . "</pre>" );                
        
            $_SESSION["price_formated"] =  number_format( $_SESSION["stockinfo"]["price"] , 2, ".", "," ); 
            render("../views/quote_display.php"); 
            //render("../views/test2.php");
            
        }
        
    
    }
?>