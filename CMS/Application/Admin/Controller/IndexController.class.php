<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		if(session('?name')){
			$this->redirect('Admin/Admin/index');
		}else{
			$this->display();
		} 
    }
	public function login(){
		$arr['Mana_Num']=I('username');
		$arr['Mana_PSD']=I('password','','md5');
		$m=M("manager");
		$data=$m->where($arr)->find();
		if($data){
			session('num',$data['Mana_Num']);
			session('name',$data['Mana_Name']);
			session('type',$data['Mana_Type']);
			echo '1';	
		}else{
			echo '0';
		}
	}
}