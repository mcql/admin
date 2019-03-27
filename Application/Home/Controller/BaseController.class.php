<?php
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{

    public function _initialize()
    {

        $map['is_deleted'] = 0;

		$co_new_list = M('news')->where(['type_id' => 1])->order('id asc')->limit(7)->select();
	
        $this->assign('co_new_list',$co_new_list);
        
		$ind_new_list = M('news')->where(['type_id' => 2])->order('id asc')->limit(7)->select();
	
        $this->assign('ind_new_list',$ind_new_list);
        
		$case_list = M('cases')->where($map)->order('id desc')->limit(5)->select();
	
		$this->assign('footer_case_list',$case_list);

		$about = M('about')->select();

        $this->assign('about', $about[0]['content']);

        $system = M('system')->select();

        $this->assign('system', $system[0]);

        $custom = M('custom')->where(['is_deleted' => 0])->select();

        $custom_arr = array();

        foreach($custom as $k => $v)

        {

            $custom_arr[$v['key']] = $v['value'];

        }

        $this->assign('custom', $custom_arr);

    }

}