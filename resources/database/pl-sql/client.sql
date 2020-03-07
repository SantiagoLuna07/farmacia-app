DELIMITER //
CREATE FUNCTION save_client(
  v_name VARCHAR(45),
  v_lastname VARCHAR(45),
  v_idCard VARCHAR(45),
  v_gender VARCHAR(45),
  v_birtDate VARCHAR(45)
) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
  IF NOT EXISTS(SELECT idClient FROM users WHERE idCard = v_idCard)
    THEN
      INSERT INTO clients(name, lastname, idCard, gender, birthDate)
      VALUES(v_name, v_lastname, v_idCard, v_gender, v_birtDate);
      SET res = 1;
  END IF;
  RETURN res;
END
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE read_client()
BEGIN
  SELECT idClient, name, lastname, idCard, gender, birthDate FROM clients;
END
//
DELIMITER ;

DELIMITER //
CREATE FUNCTION update_client(
  v_idClient INT,
  v_name VARCHAR(45),
  v_lastname VARCHAR(45),
  v_idCard VARCHAR(45),
  v_gender VARCHAR(45),
  v_birtDate VARCHAR(45)
) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
  IF EXISTS(SELECT idClient FROM clients WHERE idClient = v_idClient)
    THEN
      UPDATE clients SET name= v_name, lastame= v_lastname, gender= v_gender,
        birthDate= v_birtDate
        WHERE idClient= v_idClient;
      SET res = 1;
  END IF;
  RETURN res;
END
//
DELIMITER ;

DELIMITER //
CREATE FUNCTION delete_client(v_idClient INT) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
  IF EXISTS(SELECT idClient FROM clients WHERE idClient = v_idClient)
    THEN
      DELETE FROM clients WHERE idClient= v_idClient;
      SET res = 1;
  END IF;
  RETURN res;
END
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE read_by_id_Client(v_idClient INT)
BEGIN
  SELECT idClient, name, lastname, idCard, gender, birthDate
    FROM clients
    WHERE idClient= v_idClient;
END
//
DELIMITER ;
