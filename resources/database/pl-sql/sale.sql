DELIMITER //
CREATE FUNCTION save_sale(
  v_saleDate VARCHAR(45),
  v_totalValue VARCHAR(45),
  v_cliId VARCHAR(45),
  v_userId VARCHAR(45),
  v_medicines VARCHAR(2000)
) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
  DECLARE v_medicine VARCHAR(500);
  DECLARE v_idSale INT;
  DECLARE v_idMedicine INT;
  DECLARE v_quantity INT;

  INSERT INTO sales(saleDate, totalValue, client_idClient, user_idUser)
    VALUES (v_saleDate, v_totalValue, v_cliId, v_userId);

  SET v_idSale = (SELECT idSale
      FROM sales
      WHERE saleDate = v_saleDate
      AND client_idClient = v_cliId
      AND user_idUser = v_userId);

  WHILE(LOCATE(',', v_medicines) > 0) DO
    SET v_medicine = ELT(1, v_medicines);
    SET v_medicines = SUBSTRING(v_medicines, LOCATE(',', v_medicines) + 1);

    WHILE(LOCATE(',', v_medicine) > 0) DO
      SET v_idMedicine = ELT(1, v_medicine);
      SET v_quantity = SUBSTRING(v_medicine, LOCATE(',', v_medicine) + 1);
      SET v_idMedicine = ELT(1, v_medicine);

      IF v_medicine <> ',' THEN
        INSERT INTO sale_detatils(cuantity, medicine_idMedicine, sale_idSale)
          VALUES(v_quantity, v_idMedicine, v_idSale);
      END IF;
    END WHILE;
  END WHILE;

  SET res = 1;

  RETURN res;
END
//
DELIMITER ;

-- DELIMITER //
-- CREATE PROCEDURE read_sale()
-- BEGIN
--   SELECT s.idSale, s.saleDate, s.totalValue, c.name || ' ' || c.lastname, s.user_idUser
--     FROM sales s
--     JOIN clients c ON s.client_idClient = c.idClient
--     JOIN users ON s.user_idUser = u.idUser;
-- END
-- //
-- DELIMITER ;

-- DELIMITER //
-- CREATE FUNCTION update_sale(
--   v_idSale INT,
--   v_saleDate VARCHAR(45),
--   v_totalValue VARCHAR(45),
--   v_cliId VARCHAR(45),
--   v_userId VARCHAR(45)
-- ) RETURNS INT(1) READS SQL DATA DETERMINISTIC
-- BEGIN
--   DECLARE res INT DEFAULT 0;
--   IF EXISTS(SELECT idSale FROM sales WHERE idSale = v_idSale)
--     THEN
--       UPDATE medicines SET name= v_name, description= v_description, expirationDate= v_expirationDate,
--         quantity= v_quantity, fabricationDate= v_fabricationDate, price= v_price,
--         laboratory_idlaboratory = v_labId, user_idUser= v_userId
--         WHERE idSale= v_idSale;
--       SET res = 1;
--   END IF;
--   RETURN res;
-- END
-- //
-- DELIMITER ;

-- DELIMITER //
-- CREATE FUNCTION delete_medicine(v_idMedicine INT) RETURNS INT(1) READS SQL DATA DETERMINISTIC
-- BEGIN
--   DECLARE res INT DEFAULT 0;
--   IF EXISTS(SELECT idMedicine FROM medicines WHERE idMedicine = v_idMedicine)
--     THEN
--       DELETE FROM medicines WHERE idMedicine= v_idMedicine;
--       SET res = 1;
--   END IF;
--   RETURN res;
-- END
-- //
-- DELIMITER ;

-- DELIMITER //
-- CREATE PROCEDURE read_by_id_medicine(v_idMedicine INT)
-- BEGIN
-- SELECT m.idMedicine, m.name, m.description, m.expirationDate, m.quantity, m.fabricationDate,
--   m.price, l.name, u.username FROM medicines m
--   JOIN laboratories l ON m.laboratory_idlaboratory = l.idlaboratory
--   JOIN users ON m.user_idUser = u.idUser
--   WHERE m.idMedicine= v_idMedicine;
-- END
-- //
-- DELIMITER ;
