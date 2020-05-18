<?php

/**
 * Class Database
 * MODEL
 */
class Database
{
    /**
     * @var string
     */
    private $host = DB_HOST;
    /**
     * @var string
     */
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $pdo;
    private $stmt;
    private $error;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        // DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Prepare statement
     */
    public function query(string $sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    /**
     * @param string $param
     * @param string $value
     * @param string|null $type
     */
    public function bindValue(string $param, string $value, string $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        $this->execute();

        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     */
    public function findOne()
    {
        $this->execute();

        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
