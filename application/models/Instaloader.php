<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/** Full Build and maintained by Haqny **/
class Instaloader extends CI_Model{
	private $signature = '469862b7e45f078550a0db3687f51ef03005573121a3a7e8d7f43eddb3584a36';
	private $_data = null;
	function __construct(){
	//null
	}
	public function create($cookie, $useragent, $device_id){
		$request = $this->proccess($useragent, 'feed/timeline/', $cookie);
		if(json_decode($request[1])->status<>'ok') $return = false; else{ $return = $this; $this->_data = array('cookie' => $cookie, 'useragent' => $useragent, 'device_id' => $device_id); }
	return $return; }
	public function guid($tipe = 0) {

		$guid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand(0, 65535), 
		mt_rand(0, 65535),
		mt_rand(0, 65535),
		mt_rand(16384, 20479), 
		mt_rand(32768, 49151),
		mt_rand(0, 65535), 
		mt_rand(0, 65535), 
		mt_rand(0, 65535));

		return $tipe ? $guid : str_replace('-', '', $guid);

	}
	public function useragent($sign_version = '6.22.0'){
		$resolusi = array('1080x1776','1080x1920','720x1280', '320x480', '480x800', '1024x768', '1280x720', '768x1024', '480x320');
		$versi = array('GT-N7000', 'SM-N9000', 'GT-I9220', 'GT-I9100');		$dpi = array('120', '160', '320', '240');
		$ver = $versi[array_rand($versi)];
		return 'Instagram '.$sign_version.' Android ('.mt_rand(10,11).'/'.mt_rand(1,3).'.'.mt_rand(3,5).'.'.mt_rand(0,5).'; '.$dpi[array_rand($dpi)].'; '.$resolusi[array_rand($resolusi)].'; samsung; '.$ver.'; '.$ver.'; smdkc210; en_US)';
	}
	public function device_id(){
		$ikeh = str_split(md5(rand(677676, 99465657)), 16);
		return 'android-' . $ikeh[rand(0, 1)];
	}
	public function hook($data) {
		return 'ig_sig_key_version=5&signed_body=' . hash_hmac('sha256', $data, $this->signature) . '.' . urlencode($data); 
	}
	public function special_hook($data, $bound, $file_url) {
		$eol = "\r\n";
		$body = '';
		$body.= '--'.$bound. $eol;
		$body.= 'Content-Disposition: form-data; name="signed_body"' . $eol . $eol;
		$body.= hash_hmac('sha256', $data, $this->signature) . '.' . $data . $eol;
		$body.= '--'.$bound. $eol;
		$body.= 'Content-Disposition: form-data; name="ig_sig_key_version"' . $eol . $eol;
		$body.= '4'.$eol;
		$body.= '--'.$bound. $eol;
		$body.= 'Content-Disposition: form-data; name="profile_pic"; filename="profile_pic"'. $eol;
		$body.= 'Content-Type: application/octet-stream'. $eol;
		$body.= 'Content-Transfer-Encoding: binary'. $eol. $eol;
		$body.= file_get_contents($file_url) . $eol;
		$body.= '--'.$bound .'--' . $eol. $eol;
		return $body; 
	}
	public function proccess($useragent, $url, $cookie = 0, $postdata = 0, $httpheaders = array(), $proxy = 0, $type = 0, $retriev = 0){
		$this->load->library('curl');
		$this->curl->create('https://i.instagram.com/api/v1/' . $url);
		$this->curl->options(array(CURLOPT_USERAGENT => $useragent,
								CURLOPT_FOLLOWLOCATION => 1,
								CURLOPT_HEADER => 1));
		if ($cookie) $this->curl->set_cookies($cookie);
		if ($proxy):
			$this->curl->option(CURLOPT_PROXY, $proxy);
			if($type=='1')
				$this->curl->option(CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		endif;
		if ($httpheaders) $this->curl->option(CURLOPT_HTTPHEADER, $httpheaders);
		if ($postdata) $this->curl->post($postdata);
		$response = $this->curl->execute();
		$exp = explode("\r\n\r\n", $response);
		if(!$exp[2]){
			$header = substr($response, 0, $this->curl->header_size);
			$body = substr($response, $this->curl->header_size);
		}else{
			$header = $exp[1];
			$body = $exp[2];
		}
		return array($header, $body, $this->curl->info);
	}
	public function get_news($jumlah = 5, $news_type = 'inbox/') {
		if(!$this->_data) return false; else{
			$string = $news_type!=='inbox/' ? 'stories' : 'old_stories';
			$request = $this->proccess($this->_data['useragent'], 'news/'.$news_type, $this->_data['cookie']);
			$request = json_decode($request[1]);
			if($jumlah>count($request->{$string})) $jumlah = count($request->{$string});
			$list = array();
			if($list<1) $list[count($list)] = array('profile_image_url' => 'http://photos-e.ak.instagram.com/hphotos-ak-xpf1/t51.2885-19/11191457_936048926445148_2033944702_a.jpg', date('H:i:s d/m/Y'), 'description' => 'Your Timeline is empty'); else{
			for($i=0;$i<$jumlah;$i++):
				$list[count($list)] = array('profile_image_url' => $request->{$string}[$i]->args->profile_image, 'time' => $this->time_elapsed_string(date("d-m-Y H:i:s", $request->{$string}[$i]->args->timestamp)), 'description' => $request->{$string}[$i]->args->text);
			endfor; }
			return $list;
		}
	}
	public function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k)
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			else
				unset($string[$k]);
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
}
	public function get_timeline() {
		if(!$this->_data) return false; else{
			$__timeline = $this->proccess($this->_data['useragent'], 'feed/timeline/', $this->_data['cookie']);
			return json_decode($__timeline[1], true);
		}
	}
	public function get_feed($id, $getparameter = '') {
		if(!$this->_data) return false; else{
			$__feed = $this->proccess($this->_data['useragent'], 'feed/user/'.$id.'/'.$getparameter, $this->_data['cookie']);
			return json_decode($__feed[1]);
		}
	}
	public function getuserinfo($users) {
		if(!$this->_data) return false; else{
			$__users = $this->proccess($this->_data['useragent'], 'users/'.$users.'/info/', $this->_data['cookie']);
			return $__users[1];
		}
	}
	public function post_like($id, $useragent, $cookie) {
			$__like = $this->proccess($useragent, 'media/'.$id.'/like/', $cookie, $this->hook('{"media_id":"'.$id.'"}'));
			return json_decode($__like[1]);
	}
	public function post_follow($id, $option = 'follow', $useragent, $cookie) {
			$type = $option == 'follow' ?  'create' : 'destroy';
			$__follow = $this->proccess($useragent, 'friendships/'.$type.'/'.$id.'/', $cookie, $this->hook('{"user_id":"'.$id.'"}'));
			return $__follow[1];
	}
}