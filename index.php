<?php
spl_autoload_register(function ($class){
    include ('src/'.str_replace("\\","/",$class).".php");
});

use vmi\Konyv as K;

$conf=include ("config.php");

$pdo=new \PDO($conf['db']['dsn'],$conf['db']['user'],$conf['db']['password']);


$isbn=(isset($_POST['isbn']) && $_POST['isbn']!="")?$_POST['isbn']:"";
$cim=(isset($_POST['cim']) && $_POST['cim']!="")?$_POST['cim']:"";
$szerzo=(isset($_POST['szerzo']) && $_POST['szerzo']!="")?$_POST['szerzo']:"";
$resz=(isset($_POST['resz']) && $_POST['resz']>=0)?$_POST['resz']:0;
$sorozat=(isset($_POST['sorozat']) && $_POST['sorozat']!="")?$_POST['sorozat']:"";
$oldalak_szama=isset($_POST['oldalak_szama']) && ($_POST['oldalak_szama']>0)?$_POST['oldalak_szama']:1;
$kiado=(isset($_POST['kiado']) && $_POST['kiado']!="")?$_POST['kiado']:"";
$fordito=(isset($_POST['fordito']) && $_POST['fordito']!="")?$_POST['fordito']:"";
$kategoria=(isset($_POST['kategoria']))?$_POST['kategoria']:"";


$sql3=($cim!="")?"INSERT INTO konyv (isbn, cim, szerzo, resz, sorozat, oldalak_szama, kiado, fordito, kategoria) VALUES (:isbn, :cim, :szerzo, :resz, :sorozat, :oldalak_szama, :kiado, :fordito, :kategoria)":"";

$statement3 = $pdo->prepare($sql3);
$statement3 ->execute([
    ':isbn' => $isbn,
    ':cim' => $cim,
    ':szerzo' => $szerzo,
    ':resz' => $resz,
    ':sorozat' => $sorozat,
    ':oldalak_szama' => $oldalak_szama,
    ':kiado' => $kiado,
    ':fordito' => $fordito,
    ':kategoria' => $kategoria,
]);




$cat=(isset($_GET['categories']))?$_GET['categories']:"";
$title=(isset($_GET['title']))?$_GET['title']:"";



$sql=($cat!="")?"SELECT * FROM konyv where kategoria = :cat and cim like :title" :"SELECT * FROM konyv";
$statement = $pdo->prepare($sql);
$statement ->execute([
    ':cat' => $cat,
    ':title' => "%$title%",
]);

$sql2= "SELECT distinct kategoria FROM konyv";
$statement2 = $pdo->prepare($sql2);
$statement2 ->execute();
$categories = $statement2->fetchAll(PDO::FETCH_COLUMN);

?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Könyveim</title>
    <link rel="stylesheet" href="src/css/konyv.css">
</head>
<body>


<div class="container">
<form action="" method="get" id="search">
    <label for="">Kategória</label>
    <select name="categories" id="categories">
        <?php for ($i=0; $i < count($categories); $i++) : ?>
            <option value=<?= $categories[$i]?> <?= ($cat == $categories[$i])?'selected':''?>><?= $categories[$i]?></option>
        <?php endfor;?>
    </select>
    <label for="title">Cím</label><input type="text" name="title" id="title" value=<?= $title?>>
    <input type="submit" value="Szűrés">
</form>


    <a href="insert.php" id="kh">Könyv hozzáadása</a>


</div>

<table id="mybooks">
    <tr>
        <th>
            Cím
        </th>
        <th>
            Szerző
        </th>
        <th>
            Kategória
        </th>
        <th>
            Kiadó
        </th>
        <th>
            Oldalak száma
        </th>
    </tr>

    <?php /** @var $konyv K */?>
    <?php while($konyv = $statement->fetchObject(K::class)) : ?>
        <tr>
            <td>
                <?= $konyv->getCim(); ?>
            </td>
            <td>
                <?= $konyv->getSzerzo(); ?>
            </td>
            <td>
                <?= $konyv->getKategoria(); ?>
            </td>
            <td>
                <?= $konyv->getKiado(); ?>
            </td>
            <td>
                <?= $konyv->getOldalakSzama(); ?> oldal
            </td>

        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
