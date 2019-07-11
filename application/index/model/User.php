<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-08
 * Time: 15:38
 */

namespace app\index\model;

use think\Db;
use think\Model;

class User extends Model
{
    protected $pk = 'id';

    protected $table = 's_user';

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function show(array $where = [])
    {
        $list = Db::name('user')->where($where)->select();
        return $list;
    }

    public function add(string $u_name, string $u_tel)
    {
        $this->data(['u_name' => $u_name, 'u_tel' => $u_tel])->save();
        $last_id = $this->getLastInsID();
        return $last_id;
    }

    public function edit(array $data, array $where)
    {
        return $this->where($where)->update($data);
    }

    public function remove($id)
    {
        return $this->get(['id' => $id])->delete();
    }
}