-- DELIMITER //
-- CREATE FUNCTION save_sale(
--   v_saleDate VARCHAR(45),
--   v_totalValue VARCHAR(45),
--   v_cliId VARCHAR(45),
--   v_userId VARCHAR(45),
--   v_medIds VARCHAR(1000),
--   v_quants VARCHAR(1000)
-- ) RETURNS INT(1) READS SQL DATA DETERMINISTIC
-- BEGIN
--   DECLARE res INT DEFAULT 0;
--   DECLARE v_idSale INT;
--   DECLARE v_idMedicine INT;
--   DECLARE v_quantity INT;
--
--   INSERT INTO sales(saleDate, totalValue, client_idClient, user_idUser)
--     VALUES (v_saleDate, v_totalValue, v_cliId, v_userId);
--
--   SELECT MAX(idSale) INTO v_idSale
--       FROM sales
--       WHERE saleDate = v_saleDate
--       AND client_idClient = v_cliId
--       AND user_idUser = v_userId;
--
--   WHILE(LOCATE(',', v_medIds) > 0) DO
--     SET v_idMedicine = ELT(1, v_medIds);
--     SET v_medIds = SUBSTRING(v_medIds, LOCATE(',', v_medicines) + 1);
--     SET v_quantity = ELT(1, v_quants);
--     SET v_quants = SUBSTRING(v_quants, LOCATE(',', v_quants) + 1);
--
--     IF v_medIds <> ',' THEN
--       INSERT INTO sale_detatils(cuantity, medicine_idMedicine, sale_idSale)
--         VALUES(v_quantity, v_idMedicine, v_idSale);
--     END IF;
--   END WHILE;
--
--   SET res = 1;
--
--   RETURN res;
-- END
-- //
-- DELIMITER ;

-- DELIMITER //
-- CREATE FUNCTION save_sale(
--   v_saleDate VARCHAR(45),
--   v_totalValue DOUBLE,
--   v_idCardCli INT,
--   v_idUser INT
-- ) RETURNS INT(1) READS SQL DATA DETERMINISTIC
-- BEGIN
--   DECLARE res INT DEFAULT 0;
--   DECLARE v_idClient INT;
--   SET v_idClient = (SELECT idClient FROM clients WHERE idCard = v_idCardCli);
--   INSERT INTO sales(saleDate, totalValue, client_idClient, user_idUser)
--     VALUES(v_saleDate, v_totalValue, v_idClient, v_idUser);
--   SET res = 0;
--   RETURN res;
-- END
-- //
-- DELIMITER ;
--
-- DELIMITER //
-- CREATE PROCEDURE read_last_id_sale(v_saleDate VARCHAR(45), v_idCardCli INT)
-- BEGIN
--   DECLARE v_idClient INT;
--   SET v_idClient = (SELECT idClient FROM clients WHERE idCard = v_idCardCli);
--   SELECT MAX(idSale) AS id FROM sales
--     WHERE saleDate = v_saleDate AND client_idClient = v_idClient;
-- END
-- //
-- DELIMITER ;
--
-- DELIMITER //
-- CREATE FUNCTION save_sale_detail(
--   v_idMedicine INT,
--   v_quantity INT,
--   v_idSale INT
-- ) RETURNS INT(1) READS SQL DATA DETERMINISTIC
-- BEGIN
--   DECLARE res INT DEFAULT 0;
--
--   IF (SELECT quantity FROM medicines WHERE idMedicine = v_idMedicine) > v_quantity THEN
--     INSERT INTO sale_details(cuantity, medicine_idMedicine, sale_idSale)
--       VALUES(v_quantity, v_idMedicine, v_idSale);
--     UPDATE medicines SET quantity = (quantity - v_quantity)
--       WHERE idMedicine = v_idMedicine;
--     SET res = 1;
--     END IF;
--   RETURN res;
-- END
-- //
-- DELIMITER ;

DELIMITER //
CREATE PROCEDURE read_sales()
BEGIN
  SELECT s.idSale, s.saleDate, s.totalValue, CONCAT(c.name, ' ', c.lastname) AS client, u.username
    FROM sales s
    JOIN clients c ON s.client_idClient = c.idClient
    JOIN users u ON s.user_idUser = u.idUser;
END
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE read_sale_details( v_idSale INT )
BEGIN
  SELECT sd.idSaleDetail, sd.cuantity, sd.medicine_idMedicine, m.name, sd.sale_idSale
    FROM sale_details sd JOIN medicines m ON sd.medicine_idMedicine = m.idMedicine
    WHERE sd.sale_idSale = v_idSale;
END
//
DELIMITER ;

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

-- consulta1
SELECT * FROM pharmacydb.sales;
DELIMITER //
CREATE  PROCEDURE `consulta1`()
BEGIN
select res.client_idClient, totalcompras,gastado from (SELECT s.client_idClient,count(*) Totalcompras, SUM(totalValue) gastado
FROM sales s
GROUP BY s.client_idClient) res join clients cli on cli.idClient = res.client_idClient
order by res.gastado desc;
END//

-- CONSULTA 2

DELIMITER //
CREATE PROCEDURE  `consulta4`()
BEGIN
select s.saleDate, count(*) cantidad , sum(s.totalValue) total from sales s group by s.saleDate;
END//
DELIMITER ;
-- consulta 3
DELIMITER //
CREATE PROCEDURE  `consulta2`()
BEGIN
SELECT u.idCard, u.name, u.lastname, u.email, u.username, SUM(s.totalValue) total_sales
	FROM users u JOIN sales s ON u.idUser = s.user_idUser 
	GROUP BY u.idUser 
	ORDER BY totalValue DESC;
END//
DELIMITER ;
-- consulta3
DELIMITER //
CREATE PROCEDURE  `consulta3`()
BEGIN
SELECT m.idMedicine, m.name, SUM(sd.cuantity) quantity_sold
	FROM medicines m JOIN sale_details sd ON m.idMedicine = sd.medicine_idMedicine
    GROUP BY m.idMedicine
    ORDER BY quantity_sold DESC;
END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE listGeneros()
BEGIN
select count(case when clients.gender="Hombre" then 1 end) as Hombres, count(case when clients.gender="Mujer" then 1 end)as Mujeres from clients;
END//
DELIMITER ;
