<!DOCTYPE html>

<html>

    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>C$50 Finance</title>
        <?php endif ?>

        <!-- https://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>

        <script src="/js/scripts.js"></script>

    
                
        <?php if ( $_SESSION != NULL): 
        $username = CS50::query("SELECT username FROM users WHERE id = ?",$_SESSION['id'] );
        
        
        // echo( "<pre>" . var_dump($username) . "</pre>" ); 
        
        
        ?>
           
        <span class="sr">Logged in as: <?php print($username[0]['username']) ?> </span> 
                
        <?php endif ?> 
    
    </head>

    <body>

        <div class="container">

            <div id="top">
                <div>
                    <a href="/"><img alt="ADGE Financial" src="/img/logo.png"/></a>
                </div>
                <?php if (!empty($_SESSION["id"])): ?>
                    <ul class="nav nav-pills">
                        <li><a href="quote.php">Quote</a></li>
                        <li><a href="buy.php">Buy</a></li>
                        <li><a href="sell.php">Sell</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="index.php">Portfolio</a></li>
                        <li><a href="pass.php">Change Password</a></li>
                        <li><a href="logout.php"><strong>Log Out</strong></a></li>
                    </ul>
                <?php endif ?>
            </div>

            <div id="middle">
