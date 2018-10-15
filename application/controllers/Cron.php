<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
ignore_user_abort(1);
class Cron extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->config('mainconfig');
	}
	public function index(){
$i=0;
foreach($this->db->query("select * from instagram")->result_array() as $b):
							$id[$i] = $b["id"]; 
							$i++;
					endforeach;
					for ($i=0;$i<count($id);$i++)
$this->db->query("update instagram set poin=4 where id='".$id[$i]."'");
	}
}