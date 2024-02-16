<?php
class database
{
    private $instance;
    private $sql;
    protected $tableName;
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

    public function update($tabelName, $val = array(), $where = array())
    {
        $this->sql = "UPDATE " . $tabelName . " SET ";
        if (is_array($val)) {
            $koma = 0;
            foreach ($val as $key => $value) {
                $koma++;
                $this->sql .= "`" . $key . "`='" . $value . "'";
                if ($koma < count($val))
                    $this->sql .= ",";
            }
        } // end if $val

        if (is_array($where)) {
            $this->sql .= " WHERE ";
            foreach ($where as $key => $value) {

                $this->sql .= $key . "=" . $value;

            }
        } // end if $val

        //return $this->sql;
        return $this->instance->query($this->sql);
    }

    public function delete($tabelName, $where = array())
    {
        // empty
    }

    public function insert($tabelName, $val = array())
    {
        $this->sql = "INSERT INTO " . $tabelName . " ";
        if (is_array($val)) {
            $koma = 0;
            $j = 0;
            $this->sql .= " (";
            foreach ($val as $key => $value) {
                $koma++;
                $this->sql .= "`" . $key . "`";
                if ($koma < count($val))
                    $this->sql .= ",";
            }
            $this->sql .= ") VALUES (";

            foreach ($val as $key => $value) {
                $j++;
                $this->sql .= "'" . $value . "'";
                if ($j < count($val))
                    $this->sql .= ",";
            }

            $this->sql .= ")";
        } // end if $val

        // return $this->sql;
        return $this->instance->query($this->sql);
    }

}

class resultset
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

    public function toArray()
    {
        $data = array();
        $result = $this->db->getAll($this->tabelName);

        while ($record = $result->fetch_assoc()) {
            // printf("%s (%s)\n", $record['judul'], $record['tanggal']);
            array_push($data, $record);
        }

        return $data;
    }

    public function toWhere($where = array())
    {
        $data = array();
        $result = $this->db->getWhere($this->tabelName, $where);
        while ($record = $result->fetch_assoc()) {
            array_push($data, $record);
        }
        return $data;
    }

    public function toUpdate($value = array(), $where = array())
    {
        $data = $this->db->update($this->tabelName, $value, $where);

        if ($data) {
            $message = "success";
        } else {
            $message = "wrong";
        }
        return $message;
    } // end function of toUpdate

    public function toInsert($value = array())
    {
        $data = $this->db->insert($this->tabelName, $value);

        if ($data) {
            $message = "success";
        } else {
            $message = "wrong";
        }
        // return $data;
        return $message;
    } // end function of toUpdate

} // end class resultset
?>