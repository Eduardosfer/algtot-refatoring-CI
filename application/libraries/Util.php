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

	public function setModalRedirect($header = null, $body = null, $footer = null, $meuModal = null, $url = null) {        
        $this->CI->session->set_userdata('modal', $meuModal);
        $this->CI->session->set_userdata('header', $header);
        $this->CI->session->set_userdata('body', $body);
        $this->CI->session->set_userdata('footer', $footer);                        
        redirect($url);
    }   
    
    public function getUrlBack() {                
        if (!isset($_SERVER['HTTP_REFERER'])) {
            $_SERVER['HTTP_REFERER'] = null;
        }
        if ($_SERVER['HTTP_REFERER'] == '' || $_SERVER['HTTP_REFERER'] == null) {                          
            return site_url('AlgTot');
        } else {                        
            return $_SERVER['HTTP_REFERER'];
        }
    }
    
}