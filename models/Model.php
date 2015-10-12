<?php

namespace magnabb\model;


/**
 * Class Model
 * @package magnabb\model
 */
class Model
{
    /**
     * @var \PDO
     */
    protected $conection;

    /**
     * Config DB conection
     */
    public function __construct()
    {
        try {
            $this->conection = new \PDO('mysql:dbname=testtask;host=localhost', 'root', 'root');
            $this->conection->query('set names utf8');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Insert new user data in DB
     * @param $phone
     * @param $pass
     */
    public function writeUser($phone, $pass)
    {
        $sql = 'INSERT INTO users(created_at, phone, password) VALUES (:created_at, :phone, :password)';
        $stml = $this->conection->prepare($sql);
        $stml->execute([
            ':phone' => $phone,
            ':password' => $pass,
            ':created_at' => date('d.m.Y H:i:s')
        ]);
    }

    /**
     * Get user data from DB
     * @param $phone
     * @return mixed
     */
    public function getUser($phone)
    {
        $sql = 'SELECT users.id, users.phone, users.password FROM users WHERE users.phone = :phone AND users.is_active = 1 LIMIT 1;';

        $stml = $this->conection->prepare($sql);
        $stml->execute([
            ':phone' => $phone
        ]);
        return $stml->fetch(\PDO::FETCH_ASSOC);
    }
}