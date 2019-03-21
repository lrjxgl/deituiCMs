<?php
class registerControl extends skymvc{
	
	public function __construct(){
		parent::__construct();
		 
	}
	
	public function onInit(){
		if(M("login")->userid){
			$this->goAll("账号已经登录，请先退出",1,0,"/index.php");
		}
	}
	public function onDefault(){
		
		$this->smarty->goAssign(array(
		
		)); 
		$this->smarty->display("register/index.html");
	}
	
	 
	
 
	public function onSendSms(){
		$telephone=get_post('telephone','h');
		if(!is_tel($telephone)){
			$this->goall("请输入正确手机号码",1);
		}
		if(M("user")->select(array("where"=>"telephone='".$telephone."' "))){
			$this->goall("手机已经存在了",1);
		}
		$t=cache()->get("reg_".$telephone);
		if($t){
			$this->goall("请过".(60-(time()-$t))."秒再发送",1);
		}
		$yzm=rand(111111,999999);
		 
		$content="【".SMS_QIANMING."】验证码：".$yzm."，请您5分钟内完成注册";
		$content=array(
			"content"=>$content,
			"code"=>$yzm,
			"tpl"=>"reg"
		);
		$res=M("sms")->sendSms($telephone,$content);
		
		$key="reg_sms".$telephone.$yzm;
		
		if($res){
			cache()->set($key,1,300);
			cache()->set("reg_".$telephone,time(),60);
			$this->goAll("短信已发送，请在5分钟内验证注册");
		}else{
			$this->goAll("短信发送失败",1);
		}
	}
	
 
	public function onRegSave($ischeckcode=false){
		
		$checkcode=post('checkcode','j');
			if($ischeckcode && $checkcode!=$_SESSION['checkcode']){
				$this->goall($this->lang['checkcode_error'],2);
			}
		 
		$telephone=post('telephone','h');
 
			$password=post('password','h');
			$password2=post('password2','h');
			
			if($password!=$password2 or empty($password)){
				$this->goall("两次输入的密码不一致",1);		
			}
			 
			
			$data['username']=$data['nickname']=post('username','h')?post('username','h'):post('nickname','h');
			
			if(empty($data['nickname'])){
				if(post('telephone')){
					$data['username']=$data['nickname']=post('telephone','h');
				}else{
					$this->goall("请输入昵称",1);
				}
			}
			if(empty($data['username']) && empty($telephone)){
				$this->goAll("用户名不能为空");
			}
			if(post('telephone')){
				if(M("user")->select(array("where"=>"telephone='".$telephone."' "))){
					$this->goall("手机已经存在了",1);
				}
			}
				
			if(M("user")->select(array("where"=>"nickname='".$data['nickname']."' "))){
				$this->goall("昵称已经存在",1);
			}
			$data['gender']=min(1,get('gender'));
			
			 
			$data['telephone']=$data['lasttime']=post('telephone','i');
			 
			$data["createtime"]=date("Y-m-d H:i:s"); 
			if(get_post('invite_userid')){
				$_COOKIE['invite_uid']=$data['invite_userid']=intval(post('invite_userid'));
			}elseif(isset($_COOKIE['invite_uid'])){
				$data['invite_userid']=intval($_COOKIE['invite_uid']);
			}
			$data['userid']=$userid=M("user")->insert($data);
			//密码
			$salt=rand(1000,9999);			 
			M("user_password")->insert(array(
				"userid"=>$userid,
				"salt"=>$salt,
				"password"=>umd5($password.$salt)
			)); 
			M("invite")->invite_reg($userid,$data['username']);
			$puser=array(
				"userid"=>$userid,
				"password"=>umd5($password.$salt)
			);
			$_SESSION['ssuser']=$user=M("user")->selectRow("userid=".$userid);
			$auth=M("login")->setCode($puser);
			$authcode=$auth['authcode'];
			setcookie("authcode",$authcode,time()+3600000,"/",DOMAIN);
			$this->goall("注册成功",0,0,R("/index.php"));
		 
	}
	
	 
	
	 
}

?>