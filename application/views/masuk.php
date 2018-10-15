<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Cyberpassnet">
    <title>Cyberpassnet</title>
    <link href="<?=base_url($list_config['base_css'])?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url($list_config['base_css'])?>/main-style.css" rel="stylesheet">
     <link href="<?=base_url($list_config['base_css'])?>/style.css" rel="stylesheet">
     <link href="<?=base_url($list_config['base_css'])?>/rtl.css" rel="stylesheet">
     <link href="<?=base_url($list_config['base_css'])?>/jutifiedGallery.min.css" rel="stylesheet">
    <link href="<?=base_url($list_config['base_fonts'])?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style>
		body {
			padding-top: 70px;
		}
		.backcuk {
			background: url('assets/images/ig.jpg') no-repeat center top;
			background-size: cover;
			z-index: -1;
		}
		.sorry {
		margin-top:50px;
		}
	</style>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<script type="text/javascript">
if (typeof document.onselectstart!="undefined") {
document.onselectstart=new Function ("return false");
}
else{
document.onmousedown=new Function ("return false");
document.onmouseup=new Function ("return true");
}
</script>

<script type='text/javascript'>
//<![CDATA[
shortcut={all_shortcuts:{},add:function(a,b,c){var d={type:"keydown",propagate:!1,disable_in_input:!1,target:document,keycode:!1};if(c)for(var e in d)"undefined"==typeof c[e]&&(c[e]=d[e]);else c=d;d=c.target,"string"==typeof c.target&&(d=document.getElementById(c.target)),a=a.toLowerCase(),e=function(d){d=d||window.event;if(c.disable_in_input){var e;d.target?e=d.target:d.srcElement&&(e=d.srcElement),3==e.nodeType&&(e=e.parentNode);if("INPUT"==e.tagName||"TEXTAREA"==e.tagName)return}d.keyCode?code=d.keyCode:d.which&&(code=d.which),e=String.fromCharCode(code).toLowerCase(),188==code&&(e=","),190==code&&(e=".");var f=a.split("+"),g=0,h={"`":"~",1:"!",2:"@",3:"#",4:"$",5:"%",6:"^",7:"&",8:"*",9:"(",0:")","-":"_","=":"+",";":":","'":'"',",":"<",".":">","/":"?","\\":"|"},i={esc:27,escape:27,tab:9,space:32,"return":13,enter:13,backspace:8,scrolllock:145,scroll_lock:145,scroll:145,capslock:20,caps_lock:20,caps:20,numlock:144,num_lock:144,num:144,pause:19,"break":19,insert:45,home:36,"delete":46,end:35,pageup:33,page_up:33,pu:33,pagedown:34,page_down:34,pd:34,left:37,up:38,right:39,down:40,f1:112,f2:113,f3:114,f4:115,f5:116,f6:117,f7:118,f8:119,f9:120,f10:121,f11:122,f12:123},j=!1,l=!1,m=!1,n=!1,o=!1,p=!1,q=!1,r=!1;d.ctrlKey&&(n=!0),d.shiftKey&&(l=!0),d.altKey&&(p=!0),d.metaKey&&(r=!0);for(var s=0;k=f[s],s<f.length;s++)"ctrl"==k||"control"==k?(g++,m=!0):"shift"==k?(g++,j=!0):"alt"==k?(g++,o=!0):"meta"==k?(g++,q=!0):1<k.length?i[k]==code&&g++:c.keycode?c.keycode==code&&g++:e==k?g++:h[e]&&d.shiftKey&&(e=h[e],e==k&&g++);if(g==f.length&&n==m&&l==j&&p==o&&r==q&&(b(d),!c.propagate))return d.cancelBubble=!0,d.returnValue=!1,d.stopPropagation&&(d.stopPropagation(),d.preventDefault()),!1},this.all_shortcuts[a]={callback:e,target:d,event:c.type},d.addEventListener?d.addEventListener(c.type,e,!1):d.attachEvent?d.attachEvent("on"+c.type,e):d["on"+c.type]=e},remove:function(a){var a=a.toLowerCase(),b=this.all_shortcuts[a];delete this.all_shortcuts[a];if(b){var a=b.event,c=b.target,b=b.callback;c.detachEvent?c.detachEvent("on"+a,b):c.removeEventListener?c.removeEventListener(a,b,!1):c["on"+a]=!1}}},shortcut.add("Ctrl+U",function(){top.location.href="http://www.shafou.com/"});
//]]>
</script>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
	<a href="#" class="navbar-brand"><i class="fa fa-instagram"></i> Cyberpassnet</a>        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><?=anchor('/', '<i class="glyphicon glyphicon-home"></i> Beranda')?></li>
          </ul>
          </div>
          </div>
         </div>
    </nav> 
          <div class="container">       
     <div style="margin-top:10px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<center>
     <img src="assets/images/cyberpassnet.png" width="200">           
            </center>
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Masuk dengan akun Instagram anda</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="https://instagram.com/accounts/password/reset/" target="_blank">Lupa password?</a></div>
                    </div>                    
                   <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <?=form_open('users/login', array('class' => 'form-horizontal','id' => 'loginform'))?>
							<div id="salsakp" class="input-group col-sm-12"></div>
                            <div style="margin-bottom: 20px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<?=form_input(array('id' => 'username', 'name' => 'username', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Username ( tidak pakai @ )', 'required' => 'required'))?>                                 
                                    </div>
                            <div style="margin-bottom: 20px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										<?=form_password(array('id' => 'password', 'name' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required'))?>
                                    </div>
                                <div style="margin-top:30px" class="form-group">
                                    <div class="col-sm-12 controls">
                                      <button id="btn-login" type="submit" href="#" class="form-control btn btn-info">Masuk</button>
</center>
					 <div style="padding-top:30px" class="panel-body" >
                    <div class="alert alert-danger" role=alert> <strong>Perhatian!</strong> Jika login error "Username/Password Salah".Silahkan buka Instagram anda terlebih dahulu,dan verifikasi dengan cara klik "Ini Adalah Saya/It Was Me". </div>
<div class="alert alert-danger" role=alert> <strong>Perhatian!</strong> Jika saat Login "Internal Server Error". Klik Masuk berulang kali, hingga Login Berhasil! </div>                        

<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
							<div id="salsakp" class="input-group col-sm-12"></div>
                            <marquee><b><font color="green">Harap verifikasikan email dan nomer hp, karena pihak instagram sering mereset password</font></b></marquee>
                            <?=form_close()?>
    <script src="<?=base_url($list_config['base_js'])?>/jquery.min.js"></script>
	<script>
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(H).I(5(){$(\'#s\').A();$("y#F").D(5(){o($(\'#s\').p().l>3||$(\'#v\').p.l>3){k q=$(j).E();k n=$(j).f(\'C\');$.B({w:n,x:q,z:m,G:\'M\',W:\'V\',r:5(6){$("h").7("0","0");$("9").7("0","0");$("#i-g").2(\'u\');o(6.U){Y.11.10(6.Z);$("#8").2(\'<4 d="1 1-r" e="1">J X,S T L..</4>\')}K $("#8").2(\'<4 d="1 1-t" e="1">\'+6.N+\'</4>\')},O:5(a,b,c){$("h").7("0","0");$("9").7("0","0");$("#i-g").2(\'u\');$("#8").2(\'<4 d="1 1-t" e="1">\'+c+\'</4>\')},R:5(){$("h").f("0","0");$("#i-g").2(\'Q..\');$("#8").2(\'\');$("9").f("0","0")}})}P m})});',62,64,'disabled|alert|html||div|function|hasil|removeAttr|salsakp|button||||class|role|attr|login|input|btn|this|var|length|false|purl|if|val|pdata|success|username|warning|Masuk|password|url|data|form|timeout|focus|ajax|action|submit|serialize|loginform|type|document|ready|Berhasil|else|dialihkan|POST|content|error|return|Loading|beforeSend|Anda|akan|result|JSON|dataType|Login|window|redirect|replace|location'.split('|'),0,{}))

</script>
    <script src="<?=base_url($list_config['base_js'])?>/bootstrap.min.js"></script>
  </body>
</html>