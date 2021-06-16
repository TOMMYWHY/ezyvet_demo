<?php
/**
 * Created by PhpStorm.
 * User: Tommy
 * Date: 2021/6/15
 * Time: 8:49 PM
 */


class CartTool {
	private static $ins = null;
	private $items = array();

	final protected function __construct() {
	}

	final protected function __clone() {
	}

	protected static function getIns() {
		if(!(self::$ins instanceof self)) {
			self::$ins = new self();
		}

		return self::$ins;
	}


	public static function getCart() {
		if(!isset($_SESSION['cart']) || !($_SESSION['cart'] instanceof self)) {
			$_SESSION['cart'] = self::getIns();
		}

		return $_SESSION['cart'];
	}

	public function addItem($id,$name,$price,$num=1) {

		if($this->hasItem($id)) {
			$this->incNum($id,$num);
			return;
		}

		$item = array();
		$item['name'] = $name;
		$item['price'] = $price;
		$item['num'] = $num;

		$this->items[$id] = $item;
	}


	public function modNum($id,$num=1) {
		if(!$this->hasItem($id)) {
			return false;
		}
		$this->items[$id]['num'] = $num;
	}

	public function incNum($id,$num=1) {
		if($this->hasItem($id)) {
			$this->items[$id]['num'] += $num;
		}
	}

	public function hasItem($id) {
		return array_key_exists($id,$this->items);
	}

	public function getCnt() {
		return count($this->items);
	}

	public function getNum() {
		if($this->getCnt() == 0) {
			return 0;
		}
		$sum = 0;
		foreach($this->items as $item) {
			$sum += $item['num'];
		}
		return $sum;
	}

	public function getPrice() {
		if($this->getCnt() == 0) {
			return 0;
		}
		$price = 0.0;
		foreach($this->items as $item) {
			$price += $item['num'] * $item['price'];
		}
		return $price;
	}

	public function all() {
		return $this->items;
	}

	public function clear() {
		$this->items = array();
	}
}
