<?php
/**
 * Created by PhpStorm.
 * User: Tommy
 * Date: 2021/6/15
 * Time: 8:49 PM
 */
include_once 'CartTool.php';
session_start();

$products = [
	[ "name" => "Sledgehammer", "price" => 125.75 ],
	[ "name" => "Axe",  "price" => 190.50 ],
	[ "name" => "Bandsaw", "price" => 562.131 ],
	[ "name" => "Chisel", "price"  => 12.9 ],
	[ "name" => "Hacksaw","price"  => 18.45 ],
];
$products_name = array_column($products, 'name');

// print_r(CartTool::getCart());

$cart = CartTool::getCart();

if(!isset($_GET['add'])) {
	$_GET['add'] = '';
}

if(in_array( $_GET['add'] , $products_name)){
	$index = array_search( $_GET['add'] , $products_name);
	$cart->addItem($index,$products[$index]['name'],$products[$index]['price'],1);
	echo 'add ' .$products[$index]['name'] ." success";

}else if($_GET['add'] == 'clear') {
	$cart->clear();
	echo 'cart is empty!';

}else if($_GET['add'] == 'show') {
	print_r($cart->all());
	echo '<br />';
	echo 'Item count:',$cart->getCnt(),'; amount:' ,$cart->getNum(),'<br />';
	echo 'Total: $',$cart->getPrice();
} else {
	print_r($cart);
}


