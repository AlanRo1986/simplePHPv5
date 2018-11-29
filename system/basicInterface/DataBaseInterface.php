<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/5/20 0020
 * Time: 14:53
 */

namespace App\System\BasicInterface;


interface DataBaseInterface
{
    public function getOne($sql,$x = 0,$y = 0);
    public function getRow($sql,$output = "ARRAY_A",$y = 0);
    public function getAll($sql,$output = "ARRAY_A");
    public function getTables($output = "ARRAY_A");
    public function getTableInfo($sql,$output = "ARRAY_A");
    public function getInsertId();
    public function autoExecute($table,$fieldValues,$mode = 'INSERT', $where = '');
    public function insertAll($table, $fieldValues);


}