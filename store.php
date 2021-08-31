<?php

function createProduct($name, $price, $stock) {
    $product = new stdClass();
    $product->name = $name;
    $product->price = $price;
    $product->stock = $stock;

    return $product;
}


$products = [
    createProduct('snicker', 0.60, 20),
    createProduct('cola', 0.90, 43),
    createProduct('lighter', 0.40, 100),
    createProduct('sandwich', 1.70, 30),
    createProduct('bus ticket', 0.45, 200),
];

$buyer = new stdClass();
$buyer->cash = 4.2;

$cart = [];

$choiceToBuy = readline('Want to buy something from Narvesen? y/n : ');

while ($choiceToBuy === 'y') {
    foreach ($products as $key=>$value) {
        echo "{$key} || {$value->name}, costs {$value->price} || Stock: {$value->stock}" . PHP_EOL;
    }
    $whatToBuy = readline('Which product?: ');
    if (!(isset($products[$whatToBuy]))) {
        echo 'Wrong product entered!' . PHP_EOL;
        break;
    }
    $productAmount = readline ('How much?: ');
    if ($productAmount > $products[$whatToBuy]->stock) {
        echo "Sorry, only {$products[$whatToBuy]->stock} of {$whatToBuy} for sale" . PHP_EOL;
    } else {
        $selected = clone $products[$whatToBuy];
        $selected->stock = $productAmount;
        $products[$whatToBuy]->stock -= $productAmount;
        $cart[] = $selected;
    }

    $choiceToBuy = readline('Want to buy something else? y/n : ');
}

$sum = 0;
if ($choiceToBuy === 'n') {
    foreach ($cart as $value) {
        $sum += $value->price * $value->stock;
    }
    echo "Your total is {$sum}. ";
}

$payChoice = readline ('Pay? y/n : ') . PHP_EOL;
if ($payChoice === 'y' && $sum <= $buyer->cash) {
    $buyer->cash -= $sum;
    echo 'Thanks for the purchase.';
} else if ($payChoice === 'y' && $sum > $buyer->cash) {
    echo 'Not enough cash' . PHP_EOL;
}


/*
 * $payChoice = readline ("Your total is {$sum}. Pay? y/n : ") . PHP_EOL;
if ($payChoice === 'y') {
    if ($sum <= $buyer->cash) {
        $buyer->cash -= $sum;
        echo 'Thanks for the purchase.';
    } else {
        echo 'Not enough cash' . PHP_EOL;
    }
}
 */
