<?php

//  if submitted, are both droplist items selected?
// echo's are placeholders, will be replaced with values later.
    $custSelect ="";
    $fixedDiscounts=array();
    $variableDiscounts=array();
    if (isset($_POST['submit'])) {
        if($_POST['customer-droplist'] !=='default' || $_POST['product-droplist'] !=='default') {
            $custSelect = $_POST['customer-droplist'];
            echo 'Your selected customer: '.$_POST['customer-droplist'].'.';
            echo 'Your selected product: '.$_POST['product-droplist'].'.';
            echo 'Discounts:';
            echo 'Price:';
        } else { echo 'mistake';
        }
    }
// iterates through array of objects, if the selected name == the name of an object, take the group_id and call findFixedDiscounts();. 
    foreach($jsonDataCustomers as $value) {
        if($custSelect==$value->name) {
            $groupSelect=$value->group_id;
            findDiscounts($groupSelect);
            
        }
    }
    

// take group_id, check if group_id corresponds with an id in the groups.json file. If so, check if there is a fixed discount. If so, push this discount into the array and return the new group_id. The loop should iterate again with the new group_id.
    function findDiscounts($ID) {
        global $jsonDataGroups;
        global $fixedDiscounts;
        global $variableDiscounts;
        global $custSelect;

// for each loop runs only once now so as long as the next group id is after the first one, it works but the moment it's in front.. it doesnt. somehow the loop needs to be repeated.
            foreach ($jsonDataGroups as $value) {
                if (($ID == $value->id) && (isset($value->fixed_discount)))  {
                    array_push($fixedDiscounts,$value->fixed_discount);
                    if (isset($value->group_id)) {
                        $ID=$value->group_id; 
                    }
                }
                if (($ID == $value->id) && (isset($value->variable_discount)))  {
                    array_push($variableDiscounts,$value->variable_discount);
                    if (isset($value->group_id)) {
                        $ID=$value->group_id; 
                    }
                }

            }
        // } while ($ID !== 0);
        
            // var_dump($groupID);
        var_dump($fixedDiscounts);
        var_dump($variableDiscounts);
    }
// possible problem: trying to use a variable/array/object in a function while it is declared outside... -> call global?
?>