<?php
  /**
   *
   */
  class Medicine {

    private $id;
    private $name;
    private $description;
    private $expirationDate;
    private $quantity;
    private $fabricationDate;
    private $price;
    private $labId;
    private $userId;

    function __construct($id, $description, $expirationDate, $quantity,
      $fabricationDate, $price, $labId, $userId) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->expirationDate = $expirationDate;
        $this->quantity = $quantity;
        $this->fabricationDate = $fabricationDate;
        $this->price = $price;
        $this->labId = $labId;
        $this->userId = $userId;
    }

    public function getId() {
      return $this->id;
    }

    public function getname() {
      return $this->name;
    }

    public function setname($name) {
      $this->name = $name;
    }

    public function getDescription() {
      return $this->description;
    }

    public function setDescription($description) {
      $this->description = $description;
    }

    public function getExpirationDate() {
      return $this->expirationDate;
    }

    public function setExpirationDate($expirationDate) {
      $this->expirationDate = $expirationDate;
    }

    public function getQuantity() {
      return $this->quantity;
    }

    public function setQuantity($quantity) {
      $this->quantity = $quantity;
    }

    public function getfabricationDate() {
      return $this->fabricationDate;
    }

    public function setfabricationDate($fabricationDate) {
      $this->fabricationDate = $fabricationDate;
    }

    public function getPrice() {
      return $this->price;
    }

    public function setPrice($price) {
      $this->price = $price;
    }

    public function getLabId() {
      return $this->labId;
    }

    public function setLabId($labId) {
      $this->labId = $labId;
    }

    public function getUserId() {
      return $this->userId;
    }

    public function setUserId($userId) {
      $this->userId = $userId;
    }
  }

 ?>
