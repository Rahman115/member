<?php
class resultset
{
    private $query;
    private $qr;

    public function __construct($queryName)
    {
        $this->qr = $queryName;
    }

    public function toArray()
    {
        $data = array();

        //$record = mysqli_fetch_assoc($this->qr);
        //var_dump($record);
        if ($this->qr) {

            while ($record = mysqli_fetch_assoc($this->qr)) {
                array_push($data, $record);

            }

        }
        return $data;
    }
    /**
        public function toObject(){
            $data = array();

            if($this->query) {

                while($record = mysqli_fetch_object($this->query)){
                    array_push($data, $record);
                }

            }

            return $data;
        }

        public function numRows() {

            return mysqli_num_rows($this->query);
        }
        **/
} // end class

class database
{

    private $instance;
    private $sql;

    public $data;

    public function __construct()
    {
        $this->instance = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Ada Masalah Di Koneksi! - HOSTING");

        if (mysqli_connect_errno()) {

            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    } // end function 

    public function getAll($tableName)
    {

        $this->sql = "SELECT * FROM " . $tableName;

        return $this->instance->query($this->sql);

    }

    public function getWhere($tableName, $where = array(), $params = '')
    {

        $this->sql = "SELECT * FROM " . $tableName;


        if (is_array($where)) {

            $this->sql .= " WHERE ";
            $i = 0;
            foreach ($where as $key => $value) {
                $i++;
                $this->sql .= $key . "='" . $value . "' ";

                if ($i < count($where))
                    $this->sql .= " AND ";
            }

        }

        if (is_array($params)) {
            if (isset($params["limit"])) {

                $this->sql .= " LIMIT " . $params["limit"];
            }
        }

        return $this->instance->query($this->sql);
    }

}

class model
{
    public $db;
    public $result;
    protected $tableName;
    public $tabelName = null;

    public function __construct($table)
    {
        $this->db = new database();
        // $this->result = new resultset();
        $this->tabelName = $table;

    }

    public function rows()
    {

        // return $this->tabelName;
        //return $this->db->getAll($this->tabelName)->numRows();

        return mysqli_num_rows($this->db->getAll($this->tabelName));
    }

    public function dataArray()
    {
        $data = array();
        $result = $this->db->getAll($this->tabelName);

        /**
                if($this->db->getAll($this->tabelName)) {
        **/
        while ($record = $result->fetch_assoc()) {
            // printf("%s (%s)\n", $record['judul'], $record['tanggal']);
            array_push($data, $record);
        }
        /**
                }
                **/
        //return mysqli_fetch_assoc($this->db->getAll($this->tabelName));

        return $data;
    }

    public function dataGetWhere($where = array())
    {

        $data = array();
        $result = $this->db->getWhere($this->tabelName, $where);


        while ($record = $result->fetch_assoc()) {
            // printf("%s (%s)\n", $record['judul'], $record['tanggal']);
            array_push($data, $record);
        }
        //var_dump($data);
        return $data;

    }
} // end class Model

?>