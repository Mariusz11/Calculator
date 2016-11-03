<?php

/**
 * Description of Revenues
 *
 * @author mariusz
 */
class Revenues {

    private $id;
    private $description;
    private $quantity;
    private $price;
    private $total;
    private $date;

    public function __construct()
    {
        $this->id = -1;
        $this->description = "";
        $this->quantity = "";
        $this->price = "";
        $this->total = "";
        $this->date = "";
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setTotal() {
        $this->total = $this->quantity * $this->price;
    }

    public function setDate($date) {
        $this->date = $date;
    }
    
    public function saveToDb()
    {
        if($this->id == -1){

            $sql = "INSERT INTO revenues (description, quantity, price, total, date)
                        VALUES ('$this->description', $this->quantity, $this->price, $this->total, '$this->date') ";

            $result = Connection::checkSql($sql);
            $conn = Connection::getConnection();

            if($result == true){
                $this->id = $conn->insert_id;
                return true;
            }

        }    return false;
    }

    public function loadAllRevenues()
    {
        $sql = "SELECT * FROM revenues";
        self::loadRevenues($sql);

        return true;
    }

    public function loadRevenuesByDate($from, $to)
    {
        $sql = "SELECT * FROM revenues WHERE date BETWEEN ($from AND $to)";
        self::loadRevenues($sql);
    }
    public function loadRevenues($sql)
    {
        $ret = [];
        $result = Connection::checkSql($sql);

        if($result == true && $result->num_rows > 0){
            foreach($result as $row){
                $loadedRevenues = new Revenues();
                $loadedRevenues->id = $row['id'];
                $loadedRevenues->description = $row['description'];
                $loadedRevenues->quantity = $row['quantity'];
                $loadedRevenues->price = $row['price'];
                $loadedRevenues->total = $row['total'];
                $loadedRevenues->date = $row['date'];
                $ret[] = $loadedRevenues;

            }
            krsort($ret);
            foreach($ret as $row){
                echo <<<EOT
                <tr>
                    <td>{$row->description}</td>
                    <td>{$row->quantity}</td>
                    <td>{$row->price} zł</td>
                    <td>{$row->total} zł</td>
                    <td>{$row->date}</td>
                    <td>
                        <form method="POST">
                            <input type='hidden' name='idRev' value='{$row->id}'>
                            <input type='submit' value='X'>
                        </form>
                    </td>
                </tr>
EOT;
            }
        }
    }

    public function deleteRevenue($id)
    {
        $sql = "DELETE FROM revenues WHERE id=$id";
        Connection::checkSql($sql);

        return true;
    }
    
}
