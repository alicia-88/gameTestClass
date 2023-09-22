<?php

require_once __DIR__ . './Hero.php';
require_once __DIR__ . './Orc.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['orc']) && isset($_SESSION['hero']) && isset($_SESSION['turn'])) {
        $orc1 =  unserialize($_SESSION['orc']);
        $hero1 =  unserialize($_SESSION['hero']);
        $turn = $_SESSION['turn'];
    } else {
        $hero1 = new Hero('épée', 250, 'acier', 600, 2000, 0);
        $orc1 = new Orc(500, 0);
        $turn = 1;
    }
    unset($_SESSION['winner']);
} else {
    $hero1 = new Hero('épée', 250, 'acier', 600, 2000, 0);
    $orc1 = new Orc(500, 0);
    $turn = 1;
}

if ($hero1->getHealth() > 0 && $orc1->getHealth() > 0) {
    $orc1->attack();
    $shield = $hero1->getShieldValue();
    $hero1->attacked($orc1->getDamage());
    $totalDamage = $shield - $orc1->getDamage();

    if ($totalDamage < 0) {
        $absorbDamage = $shield;
        $restDamage = abs($totalDamage);
    } else {
        $absorbDamage = $totalDamage;
        $restDamage = 0;
    }
    // echo 'L\'Orc porte une attaque a ' . $orc1->getDamage() . '.<br>';
    // echo 'L\'armure de mon Héro a absorbé ' . $absorbDamage . '.<br>';
    // echo 'L\'attaque finale a une valeur de ' . $restDamage . '.<br>';
    // echo 'Mon Héro a une santé de ' . $hero1->getHealth() . ',<br>';
    // echo 'est une rage de ' . $hero1->getRage() . ',<br>';
    // echo 'est une armure a ' . $hero1->getShieldValue() . '.<br>';
    if ($hero1->getRage() >= 100) {
        $orc1->attacked($hero1->getWeaponDamage());
        $hero1->setRage(0);
        //echo 'Mon Héro attaque à ' . $hero1->getWeaponDamage() . '<br>';
    }
    if ($hero1->getShieldValue() == 0) {
        // echo 'Mon Héro est nu';
        // echo '<br>';
    }
    //echo 'L\'Orc a une santé de ' . $orc1->getHealth() . '.<br>';
    $_SESSION['orc'] = serialize($orc1);
    $_SESSION['hero'] = serialize($hero1);
    $_SESSION['turn'] = $turn + 1;
}
if ($hero1->getHealth() <= 0 || $orc1->getHealth() <= 0) {
    if ($hero1->getHealth() > 0) {
        $_SESSION['winner'] = 'hero';
    } else {
        $_SESSION['winner'] = 'orc';
    }
    unset($_SESSION['orc']);
    unset($_SESSION['hero']);
    unset($_SESSION['turn']);
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/assets/css/style.css">
    <title>Document</title>
</head>

<body class="container-fluid">
    <div class="row justify-content-center">
        <form id="battle" class="text-center" action="" method="post">
            <input type="number" name="turn" id="turn" value="<?= $turn  ?>">
            <button type="submit" class="btn btn-warning">BATTLE</button>
        </form>
    </div>

    <div class="row">

        <canvas id="board">
            <div style="display:none;">
                <img id="perso6" src="./public/assets/img/perso6.png" width="70" height="70" />
                <img id="perso3" src="./public/assets/img/perso3.png" width="70" height="70" />
                <img id="perso9" src="./public/assets/img/perso9.png" width="70" height="70" />
                <img id="perso7" src="./public/assets/img/perso7.png" width="70" height="70" />
                <img id="perso4" src="./public/assets/img/perso4.png" width="70" height="70" />
                <img id="perso8" src="./public/assets/img/perso8.png" width="70" height="70" />
                <img id="perso10" src="./public/assets/img/perso10.png" width="70" height="70" />
                <img id="orc1" src="./public/assets/img/orc1.png" width="70" height="70" />
                <img id="orc2" src="./public/assets/img/orc2.png" width="70" height="70" />
                <img id="orc3" src="./public/assets/img/orc3.png" width="70" height="70" />
                <img id="orc5" src="./public/assets/img/orc5.png" width="70" height="70" />
                <img id="arme1" src="./public/assets/img/arme1.png" width="70" height="70" />
                <img id="skull" src="./public/assets/img/skull.png" width="70" height="70" />
            </div>
        </canvas>

    </div>
    <div class="row">
        <div class="col-6">
            <label for="pvHero">PV Hero :
                <input type="number" name="pvHero" id="pvHero" value="<?= $hero1->getHealth() ?>">
            </label>
        </div>
        <div class="col-6">
            <label for="pvOrc">PV Orc :
                <input type="number" name="pvOrc" id="pvOrc" value="<?= $orc1->getHealth() ?>">
            </label>
        </div>
    </div>
    <script>
        const heroRage = <?= $hero1->getRage() ?>;
        const heroHealth = <?= $hero1->getHealth() ?>;
        const heroWeaponDamage = <?= $hero1->getWeaponDamage() ?>;
        const heroShieldValue = <?= $hero1->getShieldValue() ?>;
        const orcDamage = <?= $orc1->getDamage() ?>;
        const orcHealth = <?= $orc1->getHealth() ?>;
        const winner = "<?= isset($_SESSION['winner']) ? $_SESSION['winner'] : '' ?>";
    </script>
    <script src="./main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>