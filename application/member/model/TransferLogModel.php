<?php

/**
 * @Author: Maowenfu
 * @Date:   2020-11-19 17:51:51
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2020-11-20 16:47:48
 */

namespace app\member\model;
use app\BaseModel;
//*------------------------------------------------------ */
//-- 转赠日志
/*------------------------------------------------------ */
class TransferLogModel extends BaseModel
{
	protected $table = 'users_transfer_log';
	public $pk = 'log_id';

}