<?php

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

class Expenses
{

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

    public function saveToDb()
    {
        if($this->id == -1){

            $sql = "INSERT INTO expenses (description, cost, date)
                        VALUES ('$this->description',$this->cost,'$this->date') ";

            $result = Connection::checkSql($sql);
            $conn = Connection::getConnection();

            if($result == true){
                $this->id = $conn->insert_id;
                return true;
            }

        }    return false;
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

    public function loadAllExpenses()
    {

        $sql = "SELECT * FROM expenses";
        $ret = [];
        $result = Connection::checkSql($sql);

        if($result == true && $result->num_rows > 0){
            foreach($result as $row){
                $loadedExpense = new Expenses();
                $loadedExpense->id = $row['id'];
                $loadedExpense->description = $row['description'];
                $loadedExpense->cost = $row['cost'];
                $loadedExpense->date = $row['date'];
                $ret[] = $loadedExpense;

            }
            krsort($ret);
            foreach($ret as $row){
                echo <<<EOT
                <tr>
                    <td>{$row->description}</td>
                    <td>{$row->cost} zł</td>
                    <td>{$row->date}</td>
                    <td>
                        <input type='hidden' name='id' value='{$row->id}'>
                        <input type='submit' value='X'>
                    </td>
                </tr>
EOT;
            }
        }
    }

}