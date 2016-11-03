<?php

/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 03.11.16
 * Time: 19:57
 */
class Calculate
{
    public function sumRevenues()
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

    public function sumExpenses()
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
        $rev = Calculate::sumRevenues();
        $exp = Calculate::sumExpenses();
        $total = $rev - $exp;

        return $total;
    }
}