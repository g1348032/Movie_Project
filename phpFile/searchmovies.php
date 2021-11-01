<head>
        <link rel="stylesheet" href="index.css">
</head>
<nav>
        <h2>
        <a href="topten.php">Top 10</a>        
        <a href="index.php">Movie Search</a>           
        </h2>
</nav>
<body>
        <header>
                <h1>Movie List</h1>
        </header>
        <table border="1">
                <tr>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Rating</th>
                        <th>Release Year</th>                    
                </tr>      
                <?php
                $title = $_POST["text_search"];
                $genre = $_POST["genres"];
                $releaseyear = (int)$_POST["year_search"];
                $rating = $_POST["ratings"];
                $yearoperator = $_POST["year_compare"];
        
                require "connect.php";
                if($yearoperator == "greater_than"){
                        $results = $conn->query("SELECT Title, Genre, ReleaseYear, Rating FROM `Movies_DVDs` WHERE (`Title` LIKE \"%$title%\" AND `Genre` LIKE \"%$genre%\" AND `Rating` LIKE \"%$rating%\" AND (`ReleaseYear` > $releaseyear))")->fetchAll(PDO::FETCH_ASSOC);
                }
                if($yearoperator == "lower_than"){
                        $results = $conn->query("SELECT Title, Genre, ReleaseYear, Rating FROM `Movies_DVDs` WHERE (`Title` LIKE \"%$title%\" AND `Genre` LIKE \"%$genre%\" AND `Rating` LIKE \"%$rating%\" AND (`ReleaseYear` < $releaseyear))")->fetchAll(PDO::FETCH_ASSOC);
                }
                if($yearoperator == "certain_year"){
                        $results = $conn->query("SELECT Title, Genre, ReleaseYear, Rating FROM `Movies_DVDs` WHERE (`Title` LIKE \"%$title%\" AND `Genre` LIKE \"%$genre%\" AND `Rating` LIKE \"%$rating%\" AND (`ReleaseYear` = $releaseyear))")->fetchAll(PDO::FETCH_ASSOC);
                }
                
                for ($i = 0; true; $i++) {

                        echo "<td>" . $results[$i]['Title'] . "</td>";
                        echo "<td>" . $results[$i]['Genre'] . "</td>";
                        echo "<td>" . $results[$i]['Rating'] . "</td>";
                        echo "<td>" . $results[$i]['ReleaseYear'] . "</td>";                       
                        $id = $results[$i]['id'];                      
                        echo "<tr>";
                        if ($results[$i + 1] == null) {
                                break;
                        }
                }
                ?>
        </table>      
</body>