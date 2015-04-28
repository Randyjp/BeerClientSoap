<?php
/**
 * Created by PhpStorm.
 * User: randyjp
 * Date: 4/16/15
 * Time: 3:46 PM
 */
    include "BeerService.class.php";

    $beerService = new BeerService();
    $result = "";

    if(count($_POST)>0){
        if($_POST["methods"]){
            $result = $beerService->getMethods();
        }
        else if($_POST["price"]){
            $result=$beerService->getPrice($_POST["beerName"]);
        }
        else if($_POST["beers"]){
            $result = $beerService->getBeers(true);
        }
        else if($_POST["cheapest"]){
            $result= $beerService->getCheapest();
        }
        else if($_POST["costliest"]){
            $result = $beerService->getCostliest();
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beer Client</title>
    <style>
        form{
            margin-bottom: 1%;
        }
        body{
            margin: 2% 2%;
        }
    </style>
</head>
<body>
    <h1>Soap Beer client</h1>
    <p>Select your desired service</p>
    <form method="post" action="beerClient.php">
        <input type="submit" value="Get Methods" name="methods">
    </form>
    <form method="post" action="beerClient.php">
        <select name="beerName">
            <?php
                $beers = explode(",",$beerService->getBeers());
                foreach($beers as $beer) {
                    echo "<option value='$beer'>$beer</option>";
                }
            ?>
        </select>
        <input type="submit" value="Get Price" name="price">
    </form>
    <form method="post" action="beerClient.php">
        <input type="submit" value="Get Beers" name="beers">
    </form>
    <form method="post" action="beerClient.php">
        <input type="submit" value="Get Cheapest" name="cheapest">
    </form>
    <form method="post" action="beerClient.php">
        <input type="submit" value="Get Costliest" name="costliest">
    </form>
    <div>
        <h2><? echo $result; ?></h2>
    </div>
</body>
</html>