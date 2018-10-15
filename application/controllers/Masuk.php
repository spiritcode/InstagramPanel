<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
ignore_user_abort(1);
class Masuk extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->config('mainconfig');
	}
	public function index(){
		$this->load->helper('form');
		$data['list_config'] = $this->config->config;
		if($this->session->userdata('credentials'))
			redirect(base_url());
		else
			$this->load->view('masuk', $data);
	}
}