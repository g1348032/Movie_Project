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

<nav>
    <h2>
    <a href="topten.php">Top 10 Movies</a>
    <a href="index.php">Movie Search</a>
    </h2>
</nav>
<body>
    <header>
        <h1>Movie Search</h1>
    </header>

<form action="searchmovies.php" method="POST">

<h4>Search movies by name:</h4>
<input type="text" name="text_search" id="text_search"/>
<br>

<h4>Search movies by genre:</h4>
<select name="genres" id="genres">
    <option value=""></option>
    <?php
    require("connect.php");

    $statement = $conn->prepare("SELECT DISTINCT `Genre` FROM `Movies_DVDs`");
    $statement->execute();
    $output = $statement->fetchAll(PDO::FETCH_ASSOC);


    for ($i = 0; true; $i++) {
        echo "<option value=\"" . $output[$i]['Genre'] . "\">" . $output[$i]['Genre'] . "</option>";
        if ($output[$i + 1] == null) {
                break;
        }
}
    ?>
</select>
<br>

<h4>Search movies by rating:</h4>

<select name="ratings" id="ratings">
    <option value=""></option>
<?php
    require("connect.php");
    $statement = $conn->prepare("SELECT DISTINCT `Rating` FROM `Movies_DVDs`");
    $statement->execute();
    $output = $statement->fetchAll(PDO::FETCH_ASSOC);


    for ($i = 0; true; $i++) {
        echo "<option value=\"" . $output[$i]['Rating'] . "\">" . $output[$i]['Rating'] . "</option>";
        if ($output[$i + 1] == null) {
                break;
        }
}
    ?>
</select>  
<br>


<h4>Search movies by year:</h4>

<input type="radio" id="lower_than" name="year_compare" value="lower_than">
<label for="lower_than">Before</label><br>

<input type="radio" id="greater_than" name="year_compare" value="greater_than" checked="checked">
<label for="greater_than">After</label><br>

<input type="radio" id="certain_year" name="year_compare" value="certain_year">
<label for="certain_year">Certain Year</label><br>

<input type="number" max="2021" min="1888" name="year_search" id="year_search"/>
<br>

<input type="submit" value="Search">
</form>

</body>