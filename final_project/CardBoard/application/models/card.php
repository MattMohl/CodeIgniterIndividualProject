<?php

class Card extends CI_Model {
	public $card_id;
	public $card_name;
	public $card_rarity;
	public $card_cmc;
	public $card_colors = array();
	public $card_cost;
	public $card_img;
	public $card_text;
	public $card_type;
	public $card_subtypes = array();
	public $card_p;
	public $card_t;
	public $card_flavor;

	public function get($color) {
		$mdb = new Mongo_db();
		$all = $mdb->get('cardDB');
		$results = array();
		foreach($all as $a) {
			if(in_array($color, $a['colors'])) {
				array_push($results, $a);
			}
		}
		return $results;
	}

	public function getOne($multiverseid) {
		$mdb = new Mongo_db();
		$cards = $mdb->get('cardDB');
		foreach($cards as $c) {
			if($c['multiverseid'] == $multiverseid) {
				return $c;
			}
		}
	}
}