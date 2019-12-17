<?php
// this PHP file was used to generate the JSON files
// You do not need this to finish the excersise.

$productsNames = ['mouse pad',
    'nail file',
    'tooth picks',
    'lamp shade',
    'glass',
    'mirror',
    'face wash',
    'clothes',
    'pen',
    'drill press',
    'chapter book',
    'sandal',
    'rubber duck',
    'thermostat',
    'controller',
    'charger',
    'watch',
    'button',
    'cookie jar',
    'nail clippers',
    'headphones',
    'chocolate',
    'thermometer',
    'grid paper',
    'candy wrapper',
    'purse',
    'sketch pad',
    'soda can',
    'doll',
    'socks',
    'clock',
    'photo album',
    'glow stick',
    'water bottle',
    'slipper',
    'lamp',
    'lip gloss',
    'paint brush',
    'eraser',
    'speakers',
    'washing machine',
    'keys',
    'magnet',
    'tissue box',
    'rug',
    'hair brush',
    'blouse',
    'truck',
    'beef',
    'outlet',
    'house',
    'blanket',
    'thread',
    'knife',
    'rubber band',
    'lotion',
    'greeting card',
    'bookmark',
    'helmet',
    'flag',
    'towel',
    'wagon',
    'cat',
    'clay pot',
    'seat belt',
    'boom box',
    'pool stick',
    'sun glasses',
    'stop sign',
    'hair tie',
    'shampoo',
    'chalk',
    'computer',
    'couch',
    'toilet',
    'picture frame',
    'video games',
    'fake flowers',
    'street lights',
    'balloon',
    'car',
    'candle',
    'cinder block',
    'table',
    'mp3 player',
    'soy sauce packet',
    'pants',
    'tree',
    'lace',
    'spoon',
    'apple',
    'buckel',
    'zipper',
    'glasses',
    'playing card',
    'book',
    'air freshener',
    'drawer',
    'soap'];

$groupNamesA = ['communication', 'marketing', 'hr', 'sales', 'quality assurance', 'it department', 'development', 'customer support'];
$groupNamesB = ['Becode', 'Telenet', 'Belgacom', 'IBM', 'Coca-cola', 'NMBS', 'De lijn'];

$customerNames = [
    'Alline Baillargeon',
    'Buddy Sharrock',
    'Anitra Genna',
    'Ivelisse Cowles',
    'Adeline Bohl',
    'Lurline Boll',
    'Oscar Martindale',
    'Brittny Raisor',
    'Charleen Delpriore',
    'Loree Roquemore',
    'Winfred Gwaltney',
    'Darren Hurt',
    'Jackie Wink',
    'Shakia Sassman',
    'Hae Releford',
    'Isaias Kaminsky',
    'Peg Kendig',
    'Sonja Monti',
    'Felisa Epstein',
    'Vince Waxman',
    'Francoise Gaiter',
    'Bruna Levering',
    'Bobbie Aparicio',
    'Shantae Engberg',
    'Dorethea Mackowiak',
    'Dorthea Siggers',
    'Reiko Mickle',
    'Cory Holz',
    'Floyd Marx',
    'Leonila Becerril'
];

$products = $customers = $customerGroups = [];

foreach ($productsNames AS $key => $name) {
    $params = [
        'id' => $key,
        'name' => $name,
        'description' => 'lorum ipsum dolor',
        'price' => rand(1, 10000) / 100,
    ];

    $rand = rand(1, 4);
    if ($rand === 1) {
        $params['fixed_discount'] = rand(1, 25);
        $params['variable_discount'] = rand(1, 80);
    } elseif($rand === 2) {
        $params['variable_discount'] = rand(1, 80);
    } elseif($rand === 3)

    $products[] = $params;
}

function getGroup($i, $name, $parent = null)
{
    $params = [
        'id' => $i,
        'name' => $name,
    ];

    if (rand(1, 2) === 1) {
        $params['fixed_discount'] = rand(1, 25);
    } else {
        $params['variable_discount'] = rand(1, 80);
    }

    if ($parent !== null) {
        $params['group_id'] = $parent;
    }

    return $params;
}

$i = 0;
foreach ($groupNamesB as $name) {
    $parentId = $i;
    $groupsB[] = getGroup($i++, $name);

    foreach ((array)array_rand($groupNamesA, rand(1, 5)) as $name) {
        $parentChildId = $i;
        $groupsA[] = getGroup($i++, $groupNamesA[$name], $parentId);

        foreach ((array)array_rand($groupNamesA, rand(1, 3)) as $name) {
            $groupsA[] = getGroup($i++, $groupNamesA[$name], $parentChildId);
        }
    }
}

foreach ($customerNames as $key => $name) {
    $groupKey = array_rand($groupsA);

    $customers[] = [
        'id' => $key,
        'name' => $name,
        'group_id' => $groupsA[$key]['id']
    ];
}

file_put_contents('products.json', json_encode($products, JSON_PRETTY_PRINT));
file_put_contents('groups.json', json_encode(array_merge($groupsA, $groupsB), JSON_PRETTY_PRINT));
file_put_contents('customers.json', json_encode($customers, JSON_PRETTY_PRINT));