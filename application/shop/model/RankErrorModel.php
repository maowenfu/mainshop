<?php

/**
 * @Author: Mr.Mao
 * @Date:   2021-02-24 21:45:59
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2021-02-26 16:34:37
 */
namespace app\shop\model;
use app\BaseModel;
// 排位表
class RankErrorModel extends BaseModel
{
	protected $table = 'shop_rank_error_log';
	protected $pk = 'log_id';
}