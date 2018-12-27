<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of AlgTot
 *
 * @author Eduardo Sfer
 */
class AlgTot extends MY_Controller {		

	public function __construct() {
		parent::__construct();				
	}

	public function index() {
		$cdGrupo = $this->session->userdata('cdGrupo');
		echo 'Chegou aqui mano';
		die;
	}	
	
}
