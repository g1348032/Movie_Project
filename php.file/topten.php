<?php
$ua = $_SERVER['HTTP_USER_AGENT'];
if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false)) {
    ?>
      <!-- mobiles -->
      <meta name="viewport" content="width=480,user-scalable=no">
      <link href="index_mobile.css" rel="stylesheet" media="all" />
    
    <?php } elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false)) { ?>
    
      <!-- tablets -->
      <meta name="viewport" content="width=768,user-scalable=no">
      <link href="index_tablet.css" rel="stylesheet" media="all" />
    
    <?php } else { ?>
    
      <!-- PC -->
      <meta name="viewport" content="width=device-width"/>
      <link href="index_pc.css" rel="stylesheet" media="all" />
    
    <?php } ?>
    
    <title>
<head>
<link rel="stylesheet" href="index.css">
</head>
</title>
<nav>
    <h2>
    <a href="topten.php">Top 10 Movies</a>
    <a href="index.php">Movie Search</a>
    </h2>
</nav>
<body>
<header>Top 10 movies of all year</header>
<img src="toptenmovies.php" alt>
</body>