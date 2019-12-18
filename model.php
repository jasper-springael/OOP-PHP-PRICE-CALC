<?php
// get data from json file through file_get..., then json decode it, put the result in a variable.
$jsonDataCustomers=json_decode(file_get_contents("json-files/customers.json"));

//Same as above but for products and groups.
$jsonDataProducts=json_decode(file_get_contents("json-files/products.json"));

$jsonDataGroups=json_decode(file_get_contents("json-files/groups.json"));

?>




