<?php
    $conf=include ("config.php");
    $pdo=new \PDO($conf['db']['dsn'],$conf['db']['user'],$conf['db']['password']);


    $sql2= "SELECT distinct kategoria FROM konyv";
    $statement2 = $pdo->prepare($sql2);
    $statement2 ->execute();
    $categories = $statement2->fetchAll(PDO::FETCH_COLUMN);

    

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Új könyv</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <form action="index.php" method="post">
    <div class="row" style="width:300px; margin:auto">
        <div class="col-6"><label for="">isbn</label></div>
        <div class="col-6"><input type="text" name="isbn" id="" maxlength="13"></div>

        <div class="col-6"><label for="">cim</label></div>
        <div class="col-6"><input type="text" name="cim" id="" maxlength="50"></div>

        <div class="col-6"><label for="">szerzo</label></div>
        <div class="col-6"><input type="text" name="szerzo" id="" maxlength="50"></div>

        <div class="col-6"><label for="">resz</label></div>
        <div class="col-6"><input type="number" name="resz" id=""></div>

        <div class="col-6"><label for="">sorozat</label></div>
        <div class="col-6"><input type="text" name="sorozat" id="" maxlength="30"></div>

        <div class="col-6"><label for="">oldalak_szama</label></div>
        <div class="col-6"><input type="number" name="oldalak_szama" id="" min="1"></div>

        <div class="col-6"><label for="">kiado</label></div>
        <div class="col-6"><input type="text" name="kiado" id="" maxlength="30"></div>

        <div class="col-6"><label for="">fordito</label></div>
        <div class="col-6"><input type="text" name="fordito" id="" maxlength="30"></div>

        <div class="col-6"><label for="">kategoria</label></div>
        <div class="col-6"><select name="kategoria" id="">
        <?php for ($i=0; $i < count($categories); $i++) : ?>
            <option value=<?= $categories[$i]?>><?= $categories[$i]?></option>
        <?php endfor;?>
        </select></div>

        <div class="col-12" style="text-align:center"><input type="submit" value="Mentés"></div>
    </div>
    </form>
    </div>
</body>
</html>