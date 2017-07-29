<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DbConfig {

    private $dbHost;
    private $dbName;
    private $username;
    private $password;

    public function defaultDBConfig() {
        $this->dbHost = "mysql:dbname=test;host=localhost";
        $this->username = "root";
        $this->password = "";
    }

    public function customDBConfig($dbHost, $username, $password, $dbName) {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
    }

    public function set_connections() {
        $this->defaultDBConfig();
        try {
            $dbh = new PDO($this->dbHost, $this->username, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        return $dbh;
    }

    public static function connection() {
        $DbConfig = New DbConfig();
        return $DbConfig;
    }

    public function query($query) {
        $connection = $this->set_connections();
        $fetch_row = $connection->query($query)->fetch(PDO::FETCH_ASSOC);
        return $fetch_row;
    }
    
    public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function queryAll($query) {
        $connection = $this->set_connections();
        $fetch_row = $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $fetch_row;
    }

    public function insert($query) {
        $connection = $this->set_connections();
        $connection->query($query)->execute();
        return $connection->lastInsertId();
    }

    public function findValue($type, $basetable, $otherOptions = array(), $condition = array()) {
        $connection = $this->set_connections();
        $select = "SELECT ";
        $join = array();
        $joinclause = "";
        $from = "FROM " . $basetable;
        $orderBy = "";
        $groupBy = "";
        $having = "";
        $where = "";
        $clause_arr = array();
        if (!empty($otherOptions)) {
            $select.= $fields = implode(",", $otherOptions['fields']);
        }
        if (!empty($condition)) {
            foreach ($condition['joins'] as $value) {
                $join[] = $value['type'] . " JOIN" . " " . $value['table'] . " " . $value['alias'] . " ON (" . $value['conditions'][0] . ")";
            }
            if (!empty($join))
                $joinclause = implode(" ", $join);
        }
        if (isset($otherOptions['order']))
            $orderBy = " ORDER BY " . $otherOptions['order'];
        if (isset($otherOptions['group']))
            $orderBy = " GROUP BY " . $otherOptions['group'];

       
        if (isset($condition['conditions']) && $condition['conditions'] != "" ) {
            $clause = "";
            foreach ($condition['conditions'] as $key => $con) {
                $clause_arr[] = $key . "=" . $con;
            }
            if (!empty($clause_arr))
                $clause = implode(" AND ", $clause_arr);
            $where = " WHERE" . " " . $clause;
        }
        echo $select = $select . " " . $from . " " . $joinclause . $having . $where . $orderBy;
//        if ($type == "All")
//            return $connection->query($select)->fetchAll(PDO::FETCH_ASSOC);
//        if ($type == "First")
//            return $connection->query($select)->fetch(PDO::FETCH_ASSOC);
//        if ($type == "Count")
//            return $connection->query($select)->rowCount();
    }

}
