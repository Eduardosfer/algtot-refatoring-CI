<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Util
 *
 * @author Eduardo Sfer
 */
class Util {		

    private $CI;

	public function __construct() {
		$this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('session');
	}

	public function setModalRedirecionar($header = null, $body = null, $footer = null, $meuModal = null, $url = null) {
        $urlBack = site_url($url);
        $this->CI->session->set_userdata('modal', $meuModal);
        $this->CI->session->set_userdata('header', $header);
        $this->CI->session->set_userdata('body', $body);
        $this->CI->session->set_userdata('footer', $footer);
        redirect($urlBack);
    }    
    
}