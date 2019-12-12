<?php
spl_autoload_register(function ($class){
    include ('src/'.str_replace("\\","/",$class).".php");
});

use vmi\Konyv as K;

$conf=include ("config.php");



$pdo=new \PDO($conf['db']['dsn'],$conf['db']['user'],$conf['db']['password']);

$sql= "SELECT * FROM konyv";
$statement = $pdo->prepare($sql);
$statement ->execute();

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
