<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'database.php';


$db = new Database();

$unosi = $db->get_unosi(); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST['tekst'])) {
        echo 'Unesite riječ!';
    } else {
        $db->insert($_POST);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početna</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="tekst" placeholder="Unesi riječ"><br>
        <input type="submit" name="dodaj_tekst" value="Spremi"><br>
    </form><hr><br><br><br>

    <h2>Ispis svih unosa iz baze podataka</h2>

    <table border="1">
        <tr>
            <th>#</th>
            <th>Unos</th>
            <th colspan="2">Izbriši/Ažuriraj</th>
        </tr>
            <?php if(!empty($unosi)): ?>
                <?php $i = 1; ?>
                <?php foreach($unosi as $unos): ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <?php $i++ ?>
                        <td><?php echo $unos['tekst']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $unos['id']; ?>" >Ažuriraj</a>
                            |
                            <a href="delete.php?id=<?php echo $unos['id'] ?>">Izbriši</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            
    </table>
    <hr><br>

</body>
</html>