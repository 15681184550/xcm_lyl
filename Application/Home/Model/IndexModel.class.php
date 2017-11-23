<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/5
 * Time: 11:59
 */
class IndexModel extends \Think\Model
{
    public function Index(){
        dump(55555);
        $data = $this->table('friend')->select();
        dump($this->getLastSql());
        dump($data);
        die;
        return $data;
    }
}