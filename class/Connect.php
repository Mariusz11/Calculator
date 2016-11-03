<?php

/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 02.11.16
 * Time: 15:29
 */
class Connection
{
    static public function getConnection()
    {
        $conn = new mysqli(
            '127.0.0.1',
            'root',
            'coderslab',
            'Calculator');

        if(mysqli_connect_errno()){
            $conn_error = mysqli_connect_error();
            return "Błąd połączenia bazy danych:" . $conn_error;
        }

        return $conn;
    }

    static public function checkSql($sql)
    {
        $connection = self::getConnection();
        $result = $connection->query($sql);

        if (!$result || $connection->error) {
            die(sprintf("Połączenie nieudane. SQL: %s \n Bład: %s\n", $sql, $connection->error));
        }return $result;
    }

}