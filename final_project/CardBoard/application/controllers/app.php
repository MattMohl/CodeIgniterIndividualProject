<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->getDeckList();
	}

	public function newDeck() {
		$user = $this->session->all_userdata();
		$this->load->library('form_validation');
		$form_rules = array(
			array(
				'field'		=> 'deck_name',
				'label'		=> 'Deck_Name',
				'rules'		=> 'required'
			),
			array(
				'field'		=> 'description',
				'label'		=> 'Description',
				'rules'		=> 'required'
			)
		);
		$this->form_validation->set_rules($form_rules);

		if($this->form_validation->run() == FALSE) {
			redirect('app');
		}else {
			$postdata = array(
				'deck_name'		=> $this->input->post('deck_name'),
				'description' 	=> $this->input->post('description'),
				'id'			=> $user['_id']
			);

			$this->load->model('Deck');
			$deck = new Deck();
			$res = $deck->addDeck($postdata);
			if(!empty($res)) {
				// Show success somehow
				redirect('app');
			}else {
				redirect('app');
			}
		}
	}

	public function setNumInDeck() {
		$user = $this->session->all_userdata();
		$this->load->library('form_validation');
		$form_rules = array(
			array(
				'field' => 'num',
				'label' => 'Num',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($form_rules);

		if($this->form_validation->run() == FALSE) {

		}else {
			$postdata = array(
				'multiverseid' 	=> $this->input->post('multiverseid'),
				'deck_name' 	=> $this->input->post('deck_name'),
				'num'			=> $this->input->post('num')
			);
		}

		$this->load->model('Card');
		$c = new Card();
		$card = $c->getOne($postdata['multiverseid']);
		$card['num'] = $postdata['num'];
		$card['deck_name'] = $postdata['deck_name'];

		$this->load->model('Deck');
		$d = new Deck();
		$d->setNumCard($card);
		redirect('app');
	}

	public function deckInfo($secure = FALSE) {
		$this->load->library('form_validation');
		$form_rules = array(
			array(
				'field'	=> 'deck_name',
				'label' => 'Deck_Name',
				'rules' => 'required|min_length[1]'
			)
		);
		$this->form_validation->set_rules($form_rules);

		if($this->form_validation->run() == FALSE) {
			redirect('app');
		}else {
			$postdata = array(
				'deck_name' 	=> $this->input->post('deck_name')
			);
		}

		$this->load->model('Deck');
		$d = new Deck();
		$data['cards'] = $d->getDeckInfo($postdata['deck_name']);
		$data['secure'] = $secure;
		$data['comments'] = $d->getComments($postdata['deck_name']);

		$this->load->view('deckView', $data);
	}

	private function getBoth($color) {
		$user = $this->session->all_userdata();
		$this->load->model('Card');
		$this->load->model('Deck');
		$card = new Card();
		$deck = new Deck();
		$data['cards'] = $card->get($color);
		$data['decks'] = $deck->getDecks($user['_id']);
		$this->load->view('results', $data);
	}

	private function getDeckList() {
		$user = $this->session->all_userdata();
		$this->load->model('Deck');
		$deck = new Deck();
		$data['decks'] = $deck->getDecks($user['_id']);
		$this->load->view('browse', $data);
	}

	public function community() {
		$user = $this->session->all_userdata();
		$this->load->model('Deck');
		$d = new Deck();
		$data['allDecks'] = $d->getAllDecks();
		$data['userDecks'] = $d->getDecks($user['_id']);

		$this->load->view('community', $data);
	}

	public function comment() {
		$this->load->library('form_validation');
		$form_rules = array(
			array(
				'field' => 'text',
				'label' => 'Text',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($form_rules);
		if($this->form_validation->run() == FALSE) {
			redirect('app/community');
		}else {
			$postdata = array(
				'deck_name' => $this->input->post('deck_name'),
				'text' => $this->input->post('text')
			);
		}

		$user = $this->session->all_userdata();
		$this->load->model('Deck');
		$d = new Deck();
		$data['author'] = $user['usern'];
		$data['deck_name'] = $postdata['deck_name'];
		$data['text'] = $postdata['text'];

		var_dump($data);

		$d->addComment($data);

		redirect('app/community');
	}

	public function white() { $this->getBoth('White'); }

	public function blue() { $this->getBoth('Blue'); }

	public function black() { $this->getBoth('Black'); }

	public function red() { $this->getBoth('Red'); }

	public function green() { $this->getBoth('Green'); }

}