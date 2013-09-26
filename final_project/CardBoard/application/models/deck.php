<?php

class Deck extends CI_Model {
	public $user_id;
	public $user_name;
	public $deck_name;
	public $deck_cards = array();
	public $deck_comments = array();

	public function addDeck($data) {
		$mdb = new Mongo_db();
		$result = $mdb->where(array('deck_name' => $data['deck_name']))->get('decks');
		if(!empty($result)) {
			return "This deck has already been created";
		}else {
			$res = $mdb->insert('decks', $data);
			return $res;
		}
	}

	public function getDecks($user_id) {
		$mdb = new Mongo_db();
		$result = $mdb->where(array('id' => $user_id))->get('decks', array());
		if(!empty($result)) {
			return $result;
		}else {
			return array();
		}
	}

	public function getAllDecks() {
		$mdb = new Mongo_db();
		$result = $mdb->get('decks');
		return $result;
	}

	public function setNumCard($card) {
		$m = new Mongo();
		$db = $m->selectDB("mtgCards");
		$col = $db->selectCollection('decklist');

		if($card['num'] == 0) {
			$col->remove(array('deck_name'=>$card['deck_name'], 'name'=>$card['name']), array('safe'=>TRUE, 'justOne'=>TRUE));
		}else {
			$col->save($card);
		}
	}

	public function getDeckInfo($deck_name) {
		$mdb = new Mongo_db();
		$result = $mdb->where(array('deck_name'=>$deck_name))->get('decklist');
		return $result;
	}

	public function getComments($deck_name) {
		$mdb = new Mongo_db();
		$results = $mdb->where(array('deck_name'=>$deck_name))->get('commentlist');
		return $results;
	}

	public function addComment($data) {
		if(!empty($data['author'])&&
			!empty($data['deck_name'])&&
			!empty($data['text'])) {
			echo "<h2>Add comment</h2>";
			$m = new Mongo();
			$db = $m->selectDB('mtgCards');
			$col = $db->selectCollection('commentlist');
			$col->save($data);
		}
	}
}