<?php
  /**
   *
   */
  class User {
    private $id;
    private $idCard;
    private $name;
    private $lastname;
    private $email;
    private $username;
    private $password;

    function __construct($id, $idCard, $name, $lastname, $email,
      $username, $password) {
        $this->id= $id;
        $this->idCard= $idCard;
        $this->name= $name;
        $this->lastname= $lastname;
        $this->email= $email;
        $this->username= $username;
        $this->password= $password;
    }

    public function getId() {
      return $this->id;
    }

    public function getIdCard() {
      return $this->idCard;
    }

    public function setIdCard($idCard) {
      $this->idCard = $idCard;
    }

    public function getName() {
      return $this->name;
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function getLastname() {
      return $this->lastname;
    }

    public function setLastname($lastname) {
      $this->lastname = $lastname;
    }

    public function getEmail() {
      return $this->email;
    }

    public function setEmail($email) {
      $this->email = $email;
    }

    public function getUsername() {
      return $this->username;
    }

    public function setUsername($username) {
      $this->username = $username;
    }

    public function getPassword() {
      return $this->password;
    }

    public function setPassword($password) {
      $this->password = $password;
    }
  }

 ?>
