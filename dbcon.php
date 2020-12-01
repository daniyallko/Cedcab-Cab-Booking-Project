<?
    class dbcon
    {

    public $dbhost;
    public $dbuser;
    public $dbpass;
    public $dbname;
    public $server;
    public $db;
    public $conn;

    function __construct(){

    $this->conn = new mysqli("localhost", "root", "password", "cedcab");
       

    if ($this->conn->connect_error) {
    die("Connection failed: " . $this->conn->connect_error);
    }
    }

    }
    ?>