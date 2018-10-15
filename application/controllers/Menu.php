<?php
set_time_limit(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->config('mainconfig');
	}
	public function followers(){
		if(!$this->session->userdata('credentials')):
			redirect(base_url('/'));
		else:
			$_session = $this->session->userdata('credentials');
			if($this->db->query("select poin from instagram where id='".$_session['user_id']."'")->row()->poin < 1):
				$html = json_encode(array('result' => 0, 'content' => '<div class="text-center"><b style="color:orange;">Yah Gagal.....</b></div><div class="text-align:left">Poin anda tidak cukup untuk menambah followers lagi :( , Anda dapat menambah followers lagi besok :)</div>'));
			else:
				$this->load->model('instaloader');
				$connection = $this->instaloader->create($_session['cookie'], $_session['useragent'], $_session['device_id']);
				$info1 = $connection->getuserinfo($_session['user_id']);
				if(json_decode($info1)->user->is_private)
					$html = json_encode(array('result' => 0, 'content' => '<div class="text-center"><b style="color:orange;">Yah Gagal.....</b></div><div class="text-align:left">Mohon akun jangan di private agar followers dapat masuk ke akun anda..</div>'));
				else{
					$i=0;
					foreach($this->db->query("select * from instagram order by rand() limit ".$this->config->item('limit'))->result_array() as $b):
						if($b['id']<>$_session['user_id']):
							$cookie[$i] = $b["cookies"]; 
							$user_agent[$i] = $b["useragent"];
							$i++; 
						endif;
					endforeach;
					for ($i=0;$i<count($user_agent);$i++)
						$this->instaloader->post_follow($_session['user_id'], 'follow', $user_agent[$i], $cookie[$i]);
					$info2 = $connection->getuserinfo($_session['user_id']);
					$result=json_decode($info2)->user->follower_count-json_decode($info1)->user->follower_count;
					if($result>0){
						$this->db->query("update instagram set poin=poin-1 where id='".$_session['user_id']."'");
						$html = json_encode(array('result' => 1, 'content' => '<div class="text-center"><b style="color:green;">Sukses Yaah ^^</b></div><hr><div class="text-align:left">Followers Awal: <b>'.json_decode($info1)->user->follower_count.'</b><br><br>Followers Akhir: <b>'.json_decode($info2)->user->follower_count.'</b><hr></div>', 'followers' => json_decode($info2)->user->follower_count, 'point' => $this->db->query("select poin from instagram where id='".$_session['user_id']."'")->row()->poin));
					}else
						$html = json_encode(array('result' => 0, 'content' => '<div class="text-center"><b style="color:orange;">Yah Gagal.....</b></div><div class="text-align:left">Member tidak cukup untuk menambah followers lagi.. :( Mohon bagikan situs ini agar member semakin banyak dan followers yang anda dapat juga banyak :D</div>'));
				}
			endif;
			$this->output
			->set_content_type('application/json')
			->set_output($html);
		endif;
	}
	public function likes(){
		if(!$this->session->userdata('credentials')):
			redirect(base_url('/'));
		else:
			$_session = $this->session->userdata('credentials');
			if($this->db->query("select poin from instagram where id='".$_session['user_id']."'")->row()->poin < 1):
				$html = '<div class="text-center"><b style="color:orange;">Yah Gagal.....</b></div><div class="text-align:left">Poin anda tidak cukup untuk menambah followers lagi :( , Anda dapat menambah followers lagi besok :)</div>';
			else:
				$this->load->model('instaloader');
				$connection = $this->instaloader->create($_session['cookie'], $_session['useragent'], $_session['device_id']);
				$info = $connection->getuserinfo($_session['user_id']);
				if(json_decode($info)->user->is_private)
					$html = '<div class="text-center"><b style="color:orange;">Yah Gagal.....</b></div><div class="text-align:left">Mohon akun jangan di private agar likes dapat masuk ke akun anda..</div>';
				else{
					if(!$this->input->post('media_id')):
						if($this->input->post('next')&&!$this->input->post('back')):
							$this->session->set_userdata('back', $this->session->userdata('back')+1);
							$addparameter = '?max_id='.trim($this->input->post('next'));
						elseif($this->input->post('back')&&!$this->input->post('next')):
							$this->session->set_userdata('back', $this->session->userdata('back')-1);
							$addparameter = '?since_id='.trim($this->input->post('back'));
						else:
							$this->session->set_userdata('back', 0);
						endif;
					$data['back'] = $this->session->userdata('back');
					$photo = $connection->get_feed($_session['user_id'], $addparameter);
					if(count($photo->items)>0){
						$html = '<div class="text-center"><b style="color:orange;">Silahkan Pilih Foto Yang Ingin Ditambah Likenya</b></div>';
						foreach($photo->items as $item)
							$html.='<div class="form-group"><hr><img height="100" width="100" src="'.$item->image_versions2->candidates[3]->url.'"><a class="btn btn-success btn-sm pull-right" onclick="likes(\''.$item->id.'\');"><i class="fa fa-heart"></i> Likes+</a><br><br><p>'.$item->caption->text.'</p></div>';
							$html.='<hr><div class="form-group">';
						if($data['back'])
							$html.='<a class="btn btn-default" onclick="loadmore_(\'menu/likes\',\''.$item->id.'\',\'back\');"><i class="fa fa-chevron-left"></i> Back</a>';
						if($photo->more_available)
							$html.='<a class="btn btn-default pull-right" onclick="loadmore_(\'menu/likes\',\''.$item->id.'\',\'next\');"><i class="fa fa-chevron-right"></i> Next</a>';
						$html.='</div>';
					}else
						$html = '<div class="text-center"><b style="color:orange;">Anda pernah belum memposting foto anda</b></div><hr>';
					else:
						header('Content-Type: application/json');
						$info_photo = $this->instaloader->proccess($_session['useragent'], 'media/'.trim($this->input->post('media_id')).'/info/', $_session['cookie']);
						$info_photo = json_decode($info_photo[1]);
						if($info_photo->items[0]->user->pk!==$_session['user_id'])
							$html = json_encode(array('result' => 0, 'content' => '<div class="text-center"><b style="color:orange;">Yah Gagal.....</b></div><div class="text-align:left">media_id tidak cocok.. What r y doin\' ?</div>'));
						else{
							$i=0;
							foreach($this->db->query("select * from instagram order by rand() limit ".$this->config->item('limit')."")->result_array() as $b):
								if($b['id']<>$_session['user_id']):
									$cookie[$i] = $b["cookies"]; 
									$user_agent[$i] = $b["useragent"];
									$i++; 
								endif;
							endforeach;
							for ($i=0;$i<count($cookie);$i++)
								$this->instaloader->post_like(trim($this->input->post('media_id')), $user_agent[$i], $cookie[$i]);
								sleep(2);
								$info_photo2 = $this->instaloader->proccess($_session['useragent'], 'media/'.trim($this->input->post('media_id')).'/info/', $_session['cookie']);
								$result=json_decode($info_photo2[1])->items[0]->like_count-$info_photo->items[0]->like_count;
								if($result>0){
									$this->db->query("update instagram set poin=poin-1 where id='".$_session['user_id']."'");
									$html = json_encode(array('result' => 1, 'content' => '<div class="text-center"><b style="color:green;">Sukses Yaah ^^</b></div><hr><div class="text-align:left"><i class="fa fa-heart"></i> Likes Awal: <b>'.$info_photo->items[0]->like_count.'</b><br><br><i class="fa fa-heart"></i> Likes Akhir: <b>'.json_decode($info_photo2[1])->items[0]->like_count.'</b><hr></div>', 'point' => $this->db->query("select poin from instagram where id='".$_session['user_id']."'")->row()->poin));
								}else
									$html = json_encode(array('result' => 0, 'content' => '<div class="text-center"><b style="color:orange;">Yah Gagal.....</b></div><div class="text-align:left">Member tidak cukup untuk menambah likes lagi.. :( Mohon bagikan situs ini agar member semakin banyak dan followers yang anda dapat juga banyak :D</div>'));
						}
					endif;
				}
			endif;
			$this->output
			->set_output($html);
		endif;
	}
}