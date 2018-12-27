<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of PermissaoModel
 *
 * @author Eduardo Sfer
 */
class PermissaoModel extends MY_Model {	
	
	protected $table = 'permissao';
	protected $primaryKey = 'cdPermissao';

	public function __construct() {
		parent::__construct();
	}
}
