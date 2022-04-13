<?php
class DB
{
    public $conn;
    private $severname = "localhost";
    private $username = 'root';
    private $password = "";
    private $dbname = 'polyquiz';
   
    // function QueryAll() {
    //     // this -> table , khi class kế thừa phải xet table cho nó
    //     $sql="SELECT * FROM  " .$this->table;
    //     $stmt=$this->conn->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }
    // function QueryOne($id){
    //     $sql="SELECT * FROM ".$this->table ." WHERE id_dm =$id";
    //     $stmt=$this->conn->prepare($sql);
    //     $stmt->execute();
    //    return  $stmt->fetch();
    // }
    private $colums;
    private $from;
    private $distinct = false;
    private $joins;
    private $wheres;
    private $groups;
    private $havings;
    private $orders;
    private $limit;
    private $offset;
    public function __construct()
    {
       
        try {
            $this->conn = new PDO('mysql:host=' . $this->severname . ';dbname=' . $this->dbname . ';charset=utf8', $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Kết nối thất bại" . $e->getMessage();
        }
    }
    public  function table($tableName)
    {
        $this->from=$tableName;
        return $this;
    }
    function select($colums)
    {
        $this->colums = is_array($colums) ? $colums : func_get_args(); //ko thì lấy all tham số tạo 1 mảng
        return $this;
    }
    function distinct()
    {
        $this->distinct = true;
        return $this;
    }
    function join($table, $first, $operator, $second, $type = "inner")
    {
        $this->joins[] = [$table, $first, $operator, $second, $type];
        return $this;
    }
    function leftjoin($table, $first, $operator, $second)
    {
        return   $this->joins[] = [$table, $first, $operator, $second, "left"];
    }
    function rightjoin($table, $first, $operator, $second)
    {
        return   $this->joins[] = [$table, $first, $operator, $second, "right"];
    }
    function where($colum, $operator, $value, $bolean = 'and')
    {
        $this->wheres[] = [$colum, $operator, $value, $bolean];
        return $this;
    }
    function orwhere($colum, $operator, $value)
    {
        return  $this->where($colum, $operator, $value, "or");
    }
    function groupBy($colums)
    {
        $this->groups = is_array($colums) ? $colums : func_get_args();
        return $this;
    }
    function having($colum, $operator, $value, $bolean = 'and')
    {
        $this->havings[] = [$colum, $operator, $value, $bolean];
        return $this;
    }
    function orhaving($colum, $operator, $value)
    {
        return $this->having($colum, $operator, $value, 'or');
    }
    function orderBy($colum, $direction = 'asc')
    {
        $this->orders[] = [$colum, $direction];
        return $this;
    }
    function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
    function get()
    {
        // kiểm tra có from /
        if (!isset($this->from) || empty($this->from)) {
            return false;
        }
        $sql = $this->distinct ? "SELECT DISTINCT" : "SELECT ";
        if (isset($this->colums) && is_array($this->colums)) {
            $sql .= implode(',', $this->colums);
        } else {
            $sql .= ' * ';
        }
        $sql .= ' FROM ' . $this->from;
        if (isset($this->joins) && is_array($this->joins)) {
            foreach ($this->joins as $join) {
                // mảng join gồm join ,leftjoin,right join 
                switch (strtolower($join[4])) { //inner
                    case 'inner':
                        $sql .= ' INNER JOIN ';
                        break;
                    case 'left':
                        $sql .= ' LEFT JOIN ';
                        break;
                    case 'right':
                        $sql .= ' RIGHT JOIN ';
                        break;
                    default:
                        $sql .= ' INNER JOIN ';
                        break;
                }
                $sql .= " $join[0] ON $join[1] $join[2] $join[3] ";
            }
        }
        if (isset($this->wheres) && is_array($this->wheres)) {
            $sql .= " WHERE ";
            foreach ($this->wheres as $index => $where) {
                $sql .= " $where[0] $where[1] $where[2] ";
                if ($index < (count($this->wheres) - 1)) {
                    $sql .= (strtolower($where[3]) === 'and') ? 'AND' : 'OR';
                }
            }
        }
        if (isset($this->groups) && is_array($this->groups)) {
            $sql .= ' GROUP  BY ' . implode(', ', $this->groups);
        }
        if (isset($this->havings) && is_array($this->havings)) {
            $sql .= ' HAVING';
            foreach ($this->havings as $index => $having) {
                $sql .= " $having[0] $having[1] $having[2]";
                if ($index < (count($this->havings) - 1)) {
                    $sql .= (strtolower($having[3]) === 'and') ? ' AND ' : 'OR';
                }
            }
        }
        if (isset($this->orders) && is_array($this->orders)) {
            $sql .= ' ORDER BY';
            foreach ($this->orders as $index => $order) {
                $sql .= " $order[0] $order[1] ";
                if ($index < (count($this->orders) - 1)) {
                    $sql .= ' , ';
                }
            }
        }
        if (isset($this->limit)) {
            $sql .= " LIMIT $this->limit";
        }
        if (isset($this->offset)) {
            $sql .= " OFFSET $this->offset";
        }
        $stmt = $this->conn->query($sql);
        $users = $stmt->fetchAll();
        return $users;
    }
    // 
    function insert($args)
    {
        $arr = func_get_args();
        // kiểm tra có from /
        if (!isset($this->from) || empty($this->from)) {
            return false;
        }
        $sql = "INSERT INTO $this->from";
        $keys = [];
        $vals = [];
        foreach ($arr[0] as $key => $val) {
            array_push($keys, $key);
            array_push($vals, $val);
        }
        $stringkey = implode(', ', $keys);
        $stringval = implode(', ', $vals);

        $bidanh = explode(",", $stringval);
        count($bidanh);
        $arr = [];
        for ($i = 0; $i < count($bidanh); $i++) {
            array_push($arr, '?');
        }
        $tach = implode(',', $arr);
        $sql .= " ($stringkey)";
        $sql .= " VALUES ($tach)";

        //thêm 
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute($bidanh);
        return $result;
    }
    // update
    function update($args, $colums, $operator, $value)
    {
        $arr = $args;

        // kiểm tra có from /
        if (!isset($this->from) || empty($this->from)) {
            return false;
        }
        $sql = "UPDATE $this->from SET ";
        $bidanh = [];
        $i = 0;
        foreach ($arr as $key => $val) {
            if ($i < count($arr) - 1) {
                $sql .= "$key = ? " . ',';
            }else{
                $sql .= "$key = ? " ;

            }
            $i++;
            array_push($bidanh, $val);
        }
        $sql .= " WHERE $colums $operator $value";
        // update
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute($bidanh);
        return $result;
    }
     // delete
     function delete( $colums, $operator, $value)
     {
 
         // kiểm tra có from /
         if (!isset($this->from) || empty($this->from)) {
             return false;
         }
         $sql = "DELETE FROM $this->from  ";
        
         $sql .= " WHERE $colums $operator $value";
         // dlelet
         $stmt = $this->conn->prepare($sql);
         $result = $stmt->execute();
         return $result;
     }
}
