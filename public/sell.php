<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("../views/sell_form.php", ["title" => "Sell"] );
    }
  
  
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        
        // start lookin here
        $curr_stock = CS50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION['id'], $_POST["stock"] ); 
         //echo( "<pre>" . var_dump($curr_stock) . "</pre>" );
        
        if ( $curr_stock[0]["shares"] = NULL)
        {
            aplogize( "You don't own any of this stock!");
        }
           
         
        if( ( $_SESSION["stock_sell"] = lookup($_POST["stock"]) ) == false )
        {
            apologize( "Symbol does not match any known stock. Please try again.");
        }
        
        elseif ( (is_int((int) $_POST["shares"]) && ($_POST["shares"] > 0) ) == FALSE )
        {
            apologize("You must enter a positive number of shares, without fractions");
        }
        elseif( (int) $_POST["shares"] > (int) $curr_stock[0]["shares"] )
        {
            apologize("You don't currently have that many shares");
        }
        else
        {   
            
            // Reduce stocks
            CS50::query("UPDATE portfolios SET shares = (shares - ?) WHERE user_id = ? AND symbol = ? ", $_POST["shares"], $_SESSION['id'], $_POST["stock"] ); 
            
            // calc value of sold stocks
            $value = $_POST["shares"] * $_SESSION["stock_sell"]["price"]; 
            
            //echo( "<pre>" . var_dump($_SESSION["stock_sell"]["price"]). "</pre>" );
            //echo( "<pre>" . var_dump($_POST["shares"]). "</pre>" );
          
            // bump cash up
            // CS50::query("UPDATE users SET cash = (cash + ?) WHERE id = ?", $value, $_SESSION['id'] );
            CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $_SESSION['id'] );
            
            CS50::query( "INSERT IGNORE INTO histories (user_id, symbol, shares, action, timestamp) values(?,?,?,'SELL', now()  )", $_SESSION['id'], $_POST['stock'], $_POST['shares']);

            
            // possibly delete the current row if shares are up
            if ((int) $_POST["shares"] == (int) $curr_stock[0]["shares"])
            {
                // delete row if all sto
                CS50::query( "DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION['id'], $_POST["stock"]);
            }
        

            
              
            redirect("./index.php"); 
            //render("../views/test2.php");
        }    
    }
        

?>