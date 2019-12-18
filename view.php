<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP price calc</title>
    <meta name="description" content="A price calculator using json files as an object to retrieve data from">
</head>
<body>
    <?php
        include 'model.php';
        include 'controller.php';
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
</body>
</html>