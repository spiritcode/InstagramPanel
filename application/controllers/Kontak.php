<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
ignore_user_abort(1);
class Kontak extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->config('mainconfig');
	}
	public function index(){
		$data['list_config'] = $this->config->config;
		if(!$this->input->post('jenis')||!$this->input->post('teks')||!$this->input->post('email')||!$this->input->post('subject')):
			$this->load->helper('form');
			$this->load->view('kontak', $data);
		else:
			header('Content-Type: application/json');
			$email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				die(json_encode(array('result' => 0, 'content' => 'Email tidak valid..')));
			$teks = filter_var($this->input->post('teks'), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			if(strlen($teks)<10)
				die(json_encode(array('result' => 0, 'content' => 'Teks harus lebih dari 10 karakter')));
			$subject = filter_var($this->input->post('subject'), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			if(strlen($subject)<5)
				die(json_encode(array('result' => 0, 'content' => 'Subyek harus lebih dari 5 karakter')));
			if(trim($this->input->post('jenis'))=='sarankritik')
				$jenis = 'sarankritik';
			elseif(trim($this->input->post('jenis'))=='error')
				$jenis = 'error';
			else
				$jenis = 'tanya';
			$this->db->insert('feedback', array('email' => $email, 'teks' => $teks, 'jenis' => $jenis, 'subject' => $subject, 'date' => date('d/m/Y H:i:s')));
			print json_encode(array('result' => 1, 'content' => 'Terima Kasih telah menghubungi kami..Kami akan meresponnya secepat mungkin :)'));
		endif;
	}
}