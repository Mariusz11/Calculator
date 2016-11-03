<?php

/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 03.11.16
 * Time: 19:57
 */
class Calculate
{
    public function sumAllRevenues()
    {
        $sql = "SELECT total FROM revenues";
        $result = Connection::checkSql($sql);
        $sum = 0;

        if($result == true && $result->num_rows > 0){
            foreach ($result as $row){
                $sum = $sum + $row['total'];
            }
        }
        return $sum;

    }

    public function sumAllExpenses()
    {
        $sql = "SELECT cost FROM expenses";
        $result = Connection::checkSql($sql);
        $sum = 0;

        if($result == true && $result->num_rows > 0){
            foreach ($result as $row){
                $sum = $sum + $row['cost'];
            }
        }
        return $sum;

    }

    public function total()
    {
        $rev = Calculate::sumAllRevenues();
        $exp = Calculate::sumAllExpenses();
        $total = $rev - $exp;
        $total = round($total, 2);

        return $total;
    }
}