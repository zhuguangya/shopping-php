<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use Request;
use Db;
use think\facade\Session;
class Login extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function loginAction()
    {
    
            $code=Request::post('code');
            $name=Request::post('name');
            $password=Request::post('password');
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
				Session::set('name',$name);
			}
           
            }
			 $json=json_encode($arr);
			  echo $json;
    }
    public function loginOut(){
    	Session::delete('name');
    	$this->redirect('login/login');
    }
}
