<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use Request;
use Db;
class Login extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function loginAction()
    {
    
            $code=Request::get('code');
            $name=Request::get('name');
            $password=Request::get('password');
			$captcha = new Captcha();
			if(!$captcha->check($code)){
				$arr=['code'=>'1','status'=>'error','message'=>'验证码错误×'];
			}else{
                 $where=['name'=>$name,'password'=>$password];
			     $res=Db::table('zgy')->where($where)->find();
            if (empty($res)) {
            	$arr=['code'=>'2','status'=>'error','message'=>'账号或密码错误'];


            }else{


				$arr=['code'=>'0','status'=>'ok','message'=>'登录成功'];
			}
           
            }
			 $json=json_encode($arr);
			  echo $json;
		
    }
}
