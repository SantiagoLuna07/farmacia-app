DELIMITER //
CREATE FUNCTION save_medicine(
  v_name VARCHAR(45),
  v_description VARCHAR(45),
  v_expirationDate VARCHAR(45),
  v_quantity INT,
  v_fabricationDate VARCHAR(45),
  v_price DOUBLE,
  v_labId INT,
  v_userId INT
) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
    INSERT INTO medicines(name, description, expirationDate, quantity,
      fabricationDate, price, laboratory_idlaboratory, user_idUser)
      VALUES(v_name, v_description, v_expirationDate, v_quantity, v_fabricationDate,
        v_price, v_labId, v_userId);
    SET res = 1;
  RETURN res;
END
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE read_medicine()
BEGIN
  SELECT m.idMedicine, m.name, m.description, m.expirationDate, m.quantity, m.fabricationDate,
    m.price, l.name, u.username FROM medicines m
    JOIN laboratories l ON m.laboratory_idlaboratory = l.idlaboratory
    JOIN users u ON m.user_idUser = u.idUser;
END
//
DELIMITER ;

DELIMITER //
CREATE FUNCTION update_medicine(
  v_idMedicine INT,
  v_name VARCHAR(45),
  v_description VARCHAR(45),
  v_expirationDate VARCHAR(45),
  v_quantity INT,
  v_fabricationDate VARCHAR(45),
  v_price DOUBLE,
  v_labId INT,
  v_userId INT
) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
  IF EXISTS(SELECT idMedicine FROM medicines WHERE idMedicine = v_idMedicine)
    THEN
      UPDATE medicines SET name= v_name, description= v_description, expirationDate= v_expirationDate,
        quantity= v_quantity, fabricationDate= v_fabricationDate, price= v_price,
        laboratory_idlaboratory = v_labId, user_idUser= v_userId
        WHERE idMedicine= v_idMedicine;
      SET res = 1;
  END IF;
  RETURN res;
END
//
DELIMITER ;

DELIMITER //
CREATE FUNCTION delete_medicine(v_idMedicine INT) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
  IF EXISTS(SELECT idMedicine FROM medicines WHERE idMedicine = v_idMedicine)
    THEN
      DELETE FROM medicines WHERE idMedicine= v_idMedicine;
      SET res = 1;
  END IF;
  RETURN res;
END
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE read_by_id_medicine(v_idMedicine INT)
BEGIN
SELECT m.idMedicine, m.name, m.description, m.expirationDate, m.quantity, m.fabricationDate,
  m.price, l.name, u.username FROM medicines m
  JOIN laboratories l ON m.laboratory_idlaboratory = l.idlaboratory
  JOIN users u ON m.user_idUser = u.idUser
  WHERE m.idMedicine= v_idMedicine;
END
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE read_laboratories()
BEGIN
  SELECT idlaboratory, name FROM laboratories;
END
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE cantidadProductos()
BEGIN
select  name,quantity from medicines;END//
DELIMITER ;

