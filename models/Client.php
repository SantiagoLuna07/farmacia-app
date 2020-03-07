<?php
  /**
   *
   */
  class Client {
    private $id;
    private $idCard;
    private $name;
    private $lastname;
    private $gender;
    private $birthDate;

    function __construct($id, $idCard, $name, $lastname, $gender,
      $birthDate) {
        $this->id= $id;
        $this->idCard= $idCard;
        $this->name= $name;
        $this->lastname= $lastname;
        $this->gender= $gender;
        $this->username= $birthDate;
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

    public function getGender() {
      return $this->gender;
    }

    public function setGender($gender) {
      $this->gender = $gender;
    }

    public function getBirthDate() {
      return $this->birthDate;
    }

    public function setBirthDate($birthDate) {
      $this->birthDate = $birthDate;
    }
  }

 ?>
