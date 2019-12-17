<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        include 'model.php';
        include 'controller.php';
        //  var_dump($_POST);
        //  var_dump($jsonDataCustomers);
        //  var_dump($jsonDataProducts);
        //  var_dump($jsonDataGroups);
 
    ?>
    <form method="POST">
    <select name="customer-droplist">
        <option value="default">Select a customer:</option>
        <?php
        foreach($jsonDataCustomers as $item) {
            echo '<option name="'.$item->name.'">'.$item->name.'</option>';
        }
        ?>
    </select>
    <select name="product-droplist">
        <option value="default">Select a product:</option>
        <?php
        foreach($jsonDataProducts as $item) {
            echo '<option name="'.$item->name.'">'.$item->name.'</option>';
        }
        ?>
    </select>
    <input type="submit" value="submit" method="POST" name="submit">
    </form>
<?php

//     function getVariables ($object,$i) {
//         echo $object[$i]->id;
//         echo $object[$i]->name;
//         echo $object[$i]->group_id;
//     }
// getVariables($jsonDataCustomers,1);
// echo $jsonDataCustomers[1]->name;
?>
    
</body>
</html>