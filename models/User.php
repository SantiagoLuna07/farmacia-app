<?php
  /**
   *
   */
  class User {
    private $id;
    private $identificationCard;
    private $name;
    private $lastname;
    private $email;
    private $username;
    private $password;

    function __construct($id, $identificationCard, $name, $lastname, $email,
      $username, $password) {
        $this->id= $id;
        $this->identificationCard= $identificationCard;
        $this->name= $name;
        $this->lastname= $lastname;
        $this->email= $email;
        $this->username= $username;
        $this->password= $password;
    }

    public function getid() {
      return $this->email;
    }

    public function getIdentificationCard() {
      return $this->identificationCard;
    }

    public function setIdentificationCard($identificationCard) {
      $this->identificationCard = $identificationCard;
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
