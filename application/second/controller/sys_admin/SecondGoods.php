<?php

namespace app\second\controller\sys_admin;

use think\Db;
use app\AdminController;
use app\second\model\SecondModel;
use app\second\model\GoodsModel;
use app\shop\model\GoodsModel as ShopGoodsModel;


/**
 * 秒杀商品相关
 * Class Index
 * @package app\store\controller
 */
class SecondGoods extends AdminController
{
    //*------------------------------------------------------ */
    //-- 初始化
    /*------------------------------------------------------ */
    public function initialize()
    {
        parent::initialize();
        $this->Model = new SecondModel();
    }
    //*------------------------------------------------------ */
    //-- 首页
    /*------------------------------------------------------ */
    public function index()
    {
        $this->getList(true);
        return $this->fetch('index');
    }
    /*------------------------------------------------------ */
    //-- 获取列表
    //-- $runData boolean 是否返回模板
    /*------------------------------------------------------ */
    public function getList($runData = false) {
        $where = [];

        $search['keyword'] = input('keyword', '', 'trim');
        if (empty($search['keyword']) == false) {
            $where[] = ['g.goods_name|g.goods_sn', 'like',"%".$search['keyword']."%"];
        }

        $viewObj = $this->Model->alias('sg')->join("shop_goods g", 'sg.goods_id=g.goods_id', 'left');
        $viewObj->where(join(' AND ', $where))->field('sg.*,g.goods_name,g.goods_sn,g.is_spec')->order('sg_id DESC');

        $this->data = $this->getPageList($this->Model, $viewObj);

        $this->assign("data", $this->data);
        if ($runData == false){
            $this->data['content'] = $this->fetch('list')->getContent();
            unset($this->data['list']);
            return $this->success('','',$this->data);
        }
        return true;
    }


    /*------------------------------------------------------ */
    //-- 信息页调用
    //-- $data array 自动读取对应的数据
    /*------------------------------------------------------ */
    public function asInfo($data)
    {
        if ($data['sg_id'] > 0){
            $goods = (new ShopGoodsModel)->info($data['goods_id']);
            $this->assign('goods',$goods);
            if ($goods['is_spec'] == 1){
                $sg_rows = (new GoodsModel)->where('sg_id',$data['sg_id'])->select();
                $sg_goods = [];
                foreach ($sg_rows as $fg){
                    $sg_goods[$fg['sku_id']] = $fg;
                }
            }else{
                $sg_goods = (new GoodsModel)->where('sg_id',$data['sg_id'])->find();
            }

            $this->assign('sg_goods',$sg_goods);
        }
        return $data;
    }
    /*------------------------------------------------------ */
    //-- 添加前调用
    /*------------------------------------------------------ */
    public function beforeAdd($row)
    {
        $row = $this->checkData($row);
        Db::startTrans();//启动事务
        $row['add_time'] = $row['update_time'] = time();
        return $row;
    }
    /*------------------------------------------------------ */
    //-- 添加后调用
    /*------------------------------------------------------ */
    public function afterAdd($row)
    {
        $sku_ids = input('sku_ids');
        $sg_number = input('sg_number');
        $sg_price = input('goods_price');
        $GoodsModel = new GoodsModel();
        $inData['sg_id'] = $row['sg_id'];
        $inData['update_time'] = time();
        if (empty($sku_ids)) {
            $inData['goods_id'] = $row['goods_id'];
            $inData['sg_number'] = $sg_number * 1;
            $inData['sg_price'] = $sg_price * 1;
            if ($inData['sg_price'] < 0) {
                Db::rollback();// 回滚事务
                return $this->error('操作失败:秒杀价格不能小于0.');
            }

            $res = $GoodsModel::create($inData);
            if ($res < 1) {
                Db::rollback();// 回滚事务
                return $this->error('写入秒杀商品失败.');
            }
        }else{
            foreach ($sku_ids as $key => $sku_id) {
                $inData['sku_id'] = $sku_id;
                $inData['goods_id'] = $row['goods_id'] * 1;
                $inData['sg_number'] = $sg_number[$sku_id] * 1;
                $inData['sg_price'] = $sg_price[$sku_id] * 1;
                if ($inData['sg_price'] < 0) {
                    Db::rollback();// 回滚事务
                    return $this->error('操作失败:秒杀价格不能小于0.');
                }
                $res = $GoodsModel::create($inData);
                if ($res < 1) {
                    Db::rollback();// 回滚事务
                    return $this->error('写入秒杀商品失败.');
                }
            }
        }
        Db::commit();// 提交事务
        return $this->success('添加成功', url('index'));
    }
    /*------------------------------------------------------ */
    //-- 修改前处理
    /*------------------------------------------------------ */
    public function beforeEdit($row)
    {
        $row = $this->checkData($row);
        Db::startTrans();//启动事务
        $row['update_time'] = time();
        return $row;
    }
    /*------------------------------------------------------ */
    //-- 修改后调用
    /*------------------------------------------------------ */
    public function afterEdit($row)
    {
        $sku_ids = input('sku_ids');
        $sg_number = input('sg_number');
        $sg_price = input('sg_price');
        $GoodsModel = new GoodsModel();
        $inData['update_time'] = time();
        if (empty($sku_ids)) {

            $inData['sg_number'] = $sg_number * 1;
            $inData['sg_price'] = $sg_price * 1;

            if ($inData['sg_price'] < 0) {
                Db::rollback();// 回滚事务
                return $this->error('操作失败:秒杀价格不能小于0.');
            }

            $where = [];
            $where[] = ['sg_id','=',$row['sg_id']];
            $where[] = ['goods_id','=',$row['goods_id']];
            $count = $GoodsModel->where($where)->count();
            if ($count > 0){
                $res = $GoodsModel->where($where)->update($inData);
            }else{
                $res = $GoodsModel::create($inData);
            }

            if ($res < 1) {
                Db::rollback();// 回滚事务
                return $this->error('处理秒杀商品失败.');
            }
        }else{
            foreach ($sku_ids as $key => $sku_id) {
                $inData['sku_id'] = $sku_id;
                $inData['goods_id'] = $row['goods_id'];
                $inData['sg_number'] = $sg_number[$sku_id] * 1;
                $inData['sg_price'] = $sg_price[$sku_id] * 1;
                if ($inData['goods_price'] < 0) {
                    Db::rollback();// 回滚事务
                    return $this->error('操作失败:秒杀价格不能小于0.');
                }

                $where = [];
                $where[] = ['sg_id','=',$row['sg_id']];
                $where[] = ['goods_id','=',$row['goods_id']];
                $where[] = ['sku_id','=',$sku_id];
                $count = $GoodsModel->where($where)->count();
                if ($count > 0){
                    $res = $GoodsModel->where($where)->update($inData);
                }else{
                    $res = $GoodsModel::create($inData);
                }
                if ($res < 1) {
                    Db::rollback();// 回滚事务
                    return $this->error('处理秒杀商品失败.');
                }
            }
        }
        //删除没定义的数据
        $where = [];
        $where[] = ['sg_id','=',$row['sg_id']];
        $where[] = ['goods_id','=',$row['goods_id']];
        $where[] = ['update_time','<',time()];
        $GoodsModel->where($where)->delete();
        Db::commit();// 提交事务
        return $this->success('修改成功', url('index'));
    }
    /*------------------------------------------------------ */
    //-- 验证相关数据
    /*------------------------------------------------------ */
    public function checkData($row)
    {
        if ($row['goods_id'] < 1) {
            return $this->error('请先择需要参与秒杀的商品.');
        }
        $sku_ids = input('sku_ids');
        $sg_price = input('sg_price');
        $sg_number = input('sg_number');
        $goods = (new ShopGoodsModel)->info($row['goods_id']);
        if ($goods['is_spec'] == 1) {
            if (empty($sku_ids) == true) {
                return $this->error('请设置需要秒杀商品.');
            }
            foreach ($sku_ids as $key => $sku_id) {
                if ($sg_number[$sku_id] <= 0){
                    return $this->error('勾选的sku没有设置秒杀库存.');
                }
                if ($sg_price[$sku_id] <= 0){
                    return $this->error('勾选的sku没有设置秒杀价格.');
                }
                $prices[] = $sg_price[$sku_id];
            }
        } else {
            if ($sg_number <= 0){
                return $this->error('没有设置秒杀库存.');
            }
            if ($sg_price <= 0){
                return $this->error('没有设置秒杀价格.');
            }
            $prices[] = $sg_price * 1;
        }

        $row['show_price'] = min($prices);
        if (empty($row['start_date']) || empty($row['end_date'])) return $this->error('操作失败:请选择秒杀时间.');
        if (!checkDateIsValid($row['start_date'])) return $this->error('操作失败:开始时间格式不合法.');
        if (!checkDateIsValid($row['end_date'])) return $this->error('操作失败:结束时间格式不合法.');
        $row['start_date'] = strtotime($row['start_date']);
        $row['end_date'] = strtotime($row['end_date']);
        if ($row['start_date'] >= $row['end_date']) return $this->error('操作失败::开始时间必须大于结束时间.');

        return $row;
    }

    /*------------------------------------------------------ */
    //-- 获取秒杀列表-供选择使用
    /*------------------------------------------------------ */
    public function selectSecond()
    {
        $this->getselectSecondList(true);
        return $this->fetch('select_second');
    }
    /*------------------------------------------------------ */
    //-- 获取秒杀列表
    //-- $runData boolean 是否返回模板
    /*------------------------------------------------------ */
    public function getselectSecondList($runData = false)
    {
        $SecondModel = new SecondModel();
        $where = [];
        $status = input('status', 0, 'intval');
        $time = time();
        switch ($status) {
            case 1:
                $where[] = ['fg.start_date', '>', $time];
                break;
            case 2:
                $where[] = ['fg.start_date', '<', $time];
                $where[] = ['fg.end_date', '>', $time];
                break;
            case 3:
                $where[] = ['fg.end_date', '<', $time];
                break;
            default:
                break;
        }
        $search['goodsArr'] = input('goodsArr', 0, 'trim');
        if (empty($search['goodsArr']) == false) {
            $where[] = ['sg.sg_id', 'not in', $search['goodsArr']];
        }

        $search['keyword'] = input('keyword', '', 'trim');
        if (empty($search['keyword']) == false) {
            $where[] = ['g.goods_name|g.goods_sn', 'like',"%".$search['keyword']."%"];
        }

        $viewObj = $SecondModel->alias('sg')->join("shop_goods g", 'sg.goods_id=g.goods_id', 'left');
        $viewObj->where($where)->field('sg.*,g.goods_name,g.goods_sn,g.is_spec')->order('sg_id DESC');
        $this->data = $this->getPageList($SecondModel, $viewObj);
        $this->assign("data", $this->data);
        $this->assign("time", $time);
        if ($runData == false) {
            $this->data['content'] = $this->fetch('second_list')->getContent();
            unset($this->data['list']);
            return $this->success('', '', $this->data);
        }
        return true;
    }
    /*------------------------------------------------------ */
    //-- 获取商品详情
    /*------------------------------------------------------ */
    public function getGoodsInfo()
    {
        $goods_id = input('goods_id',0,'intval');
        if ($goods_id < 1) return $this->error('传参错误.');
        $goods = (new ShopGoodsModel)->info($goods_id);
        if (empty($goods)){
            return $this->error('商品不存在.');
        }
        $return['code'] = 1;
        $return['goods'] = $goods;
        return $this->ajaxReturn($return);
    }
}