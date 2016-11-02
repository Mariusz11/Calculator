<?php

class Expenses{

    private $id;
    private $description;
    private $cost;
    private $date;

    public function __construct()
    {
        $this->id = -1;
        $this->description = "";
        $this->cost = "";
        $this->date = "";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

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
}