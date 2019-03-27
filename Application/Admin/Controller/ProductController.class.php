<?php
namespace Admin\Controller;

use Think\Controller;

class ProductController extends BaseController
{
    /**
     * 获取新闻列表
     */
    public function index()
    {
    	
    	$product = D('Product')->getProduct();

      $this->assign('product_list', $product);

      $this->display();

    }

    /**
     * 新增/修改新闻
     */
    public function create()
    {

        $do = I('do');

        if (empty($do)) {

            $title = "创建产品";

            $param = I();

            if ($param){

                $title = "修改产品";

                $map['id'] = $param['id'];

                $product_detail = M('product')->where($map)->order('id desc')->find();

                $this->assign('product_detail', $product_detail);
           
            }

            $this->assign('title', $title);

            $this->display();

        } elseif ($do == 'create') {

            $param = I();

            $result = D('Product')->Create($param);

            $this->ajaxReturn($result);

        }  elseif ($do == 'edit') {

            $param = I();

            $result = D('Product')->Edit($param);

            $this->ajaxReturn($result);

        }

    }

    /**
     * 删除新闻
     */
    public function del()
    {

        $param = I();

        $result = D('Product')->Del($param);

        $this->ajaxReturn($result);

    }

     /**
     * 导出
     */
    public function exportCSV()
    {
        $data = D('Product')->getProduct();

        $headList = array(
            'ID',
            '标题',
            '内容',
            '发布时间',
            '类型',
            '是否显示',
            '描述',
            '类型ID',
            '是否删除',
        );
        $fileName = '新闻列表';
        
        writeCsv($data,$headList,$fileName);

        die;

    }   

}