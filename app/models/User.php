<?php

/**
 * Class User
 */
  class User
  {
      private $db;

      /**
       * User constructor.
       */
      public function __construct()
      {
          $this->db = new Database();
      }

      /**
       * @param array $data
       * @return bool
       */
      public function register(array $data) : bool
      {
          $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');

          $this->db->bindValue(':name', $data['name']);
          $this->db->bindValue(':email', $data['email']);
          $this->db->bindValue(':password', $data['password']);

          if ($this->db->execute()) {
              return true;
          } else {
              return false;
          }
      }

      /**
       * @param string $email
       * @param string $password
       * @return bool|mixed
       */
      public function login(string $email, string $password)
      {
          $this->db->query('SELECT * FROM users WHERE email = :email');
          $this->db->bindValue(':email', $email);

          $row = $this->db->findOne();

          $hashed_password = $row->password;
          if (password_verify($password, $hashed_password)) {
              return $row;
          } else {
              return false;
          }
      }

      /**
       * @param string $email
       * @return bool
       */
      public function findUserByEmail(string $email) : bool
      {
          $this->db->query('SELECT * FROM users WHERE email = :email');
          $this->db->bindValue(':email', $email);

          $this->db->findOne();

          if ($this->db->rowCount() > 0) {
              return true;
          } else {
              return false;
          }
      }
  }
