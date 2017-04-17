<?php

    // configuration
    require("../includes/config.php"); 
    
    // check name below
    
    
    $rows = CS50::query("SELECT symbol, shares FROM portfolios WHERE user_id = ?", $_SESSION['id']); 
    
    
    if ($rows == NULL)
    {
        // format cash to two digits    
        $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION['id']); 
        $cash = number_format( $cash[0]["cash"] , 2, ".", "," ); 
        
        // echo( "<pre>" . var_dump($cash) . "</pre>" );
        // see if this works    
         render("portfolio.php", ["title" => "Portfolio", "cash" => $cash, "size" => 0] );
    
    }
    
    
    // need to pass portfolio:
    // all of stocks listed, number of shares, worth of shares 

   // TEST
   // echo( "<pre>" . var_dump($rows) . "</pre>" );  

    $portfolio_rows = array(); 

    $i = 0; 
    foreach ($rows as $row)
    {
        $portfolio_rows[$i]["symbol"] = $row["symbol"];
        $portfolio_rows[$i]["shares"] = $row["shares"]; 
        
       
        // get info abt current stock.
        $row_stock = lookup($portfolio_rows[$i]["symbol"]);
        
        // TEST 
        //echo( "<pre>" . var_dump($row_stock) . "</pre>" );  
        
        $portfolio_rows[$i]["name"] = $row_stock["name"];
        
        // current value
        $portfolio_rows[$i]["value"] = number_format( ( $row["shares"] * $row_stock["price"] ) , 2, ".", "," ); 
        $portfolio_rows[$i]["price"] = number_format( $row_stock["price"] , 2, ".", "," ); 
        
        
        $i++; 
    }
    
    // TEST 

    
    
    // info about cash left 
    $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION['id']); 
    $cash = number_format( $cash[0]["cash"] , 2, ".", "," ); 
    
    // echo( "<pre>" . var_dump($cash) . "</pre>" );

    
    // $cash is 1 time; $portfolio is 2D matrix, 
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "rows" => $portfolio_rows, "cash" => $cash, "size" => $i] );
    

?>
