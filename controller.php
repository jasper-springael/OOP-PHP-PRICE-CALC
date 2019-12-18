<?php

$custSelect ="";
$prodSelect="";
$prodPrice=0;
$fixedDiscounts=array();
$variableDiscounts=array();
$finalFixed;
$finalVar;
$finalPrice;

if (isset($_POST['submit'])) {
//  if submitted, are both droplist items selected?
    if($_POST['customer-droplist'] !=='default' || $_POST['product-droplist'] !=='default') {
        $custSelect = $_POST['customer-droplist'];
        $prodSelect = $_POST ['product-droplist'];

// Iterates through array of objects, if the selected name == the name of an object, take the group_id and call findFixedDiscounts();. 
        foreach($jsonDataCustomers as $value) {
            if($custSelect==$value->name) {
                $group_id=$value->group_id;
                findDiscounts($group_id);                 
            }
        }
        findPrice();
        applyDiscounts();
        echo 'Customer: '.$custSelect.'.</br>';
        echo 'Product: '.$prodSelect.'.</br>';
        echo 'Base price: '.$prodPrice.'</br>';
        echo 'Applied fixed discounts:</br>';
        foreach ($fixedDiscounts as $value) {
        echo $value.'</br>';
        }
        echo 'Total fixed discounts: '.$finalFixed.'</br>';
        echo 'Applied variable discounts: '.$finalVar.'%</br>';
        echo 'Price after discounts: '.$finalPrice.'</br>';
    } else { echo 'Please select a customer and a product.';
    }
}
//functions
function findPrice () {
    global $jsonDataProducts;
    global $prodSelect;
    global $prodPrice;
        
    foreach($jsonDataProducts as $value) {
        if ($prodSelect==$value->name) {
            $prodPrice=$value->price;
        }
    }
}

function applyDiscounts() {
    global $finalFixed;
    global $finalVar;
    global $fixedDiscounts;
    global $variableDiscounts;
    global $prodPrice;
    global $finalPrice;

    $finalFixed = array_sum($fixedDiscounts);
    $finalVar = max($variableDiscounts);
    $prodPriceAfterFixed=$prodPrice-$finalFixed;
    $prodPriceAfterVar=$prodPriceAfterFixed*$finalVar/100;
    $prodPriceAfterDiscounts= round($prodPriceAfterFixed-$prodPriceAfterVar,2);
    if ($prodPriceAfterDiscounts>0) {
        $finalPrice=$prodPriceAfterDiscounts;
    } else $finalPrice=0;
}
// Take group_id, check if group_id corresponds with an id in the groups.json file. If so, check if there is a fixed discount. If so, push this discount into the array and return the new group_id. The loop should iterate again with the new group_id.
function findDiscounts($ID) {
    global $jsonDataGroups;
    global $fixedDiscounts;
    global $variableDiscounts;
    global $custSelect;

// when the group also has a group_id, take this value and call findDiscount again with the new group_id as parameter ($groupNewId in this case)
        foreach ($jsonDataGroups as $value) {
            if (($ID == $value->id) && (isset($value->fixed_discount)))  {
                array_push($fixedDiscounts,$value->fixed_discount);
                if (isset($value->group_id)) {
                    $groupNewId=$value->group_id; 
                    findDiscounts($groupNewId);
                }
            }
            if (($ID == $value->id) && (isset($value->variable_discount)))  {
                array_push($variableDiscounts,$value->variable_discount);
                if (isset($value->group_id)) {
                    $groupNewId=$value->group_id; 
                    findDiscounts($groupNewId);
                }
            }
        }
    }
?>