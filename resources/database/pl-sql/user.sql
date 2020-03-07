-- DELIMITER //
-- CREATE FUNCTION save_user(
--   v_idCard VARCHAR(45),
--   v_name VARCHAR(45),
--   v_lastname VARCHAR(45),
--   v_email VARCHAR(45),
--   v_username VARCHAR(45),
--   v_password VARCHAR(45)
-- ) RETURNS INT(1) READS SQL DATA DETERMINISTIC
-- BEGIN
--   DECLARE res INT DEFAULT 0;
--   IF NOT EXISTS(SELECT idUser FROM users WHERE email = v_email)
--     THEN
--       INSERT INTO users(idCard, name, lastname, email, username, password)
--       VALUES(v_idCard, v_name, v_lastname, v_email, v_username, v_password);
--       SET res = 1;
--   END IF;
--   RETURN res;
-- END
-- //
-- DELIMITER ;
--
-- DELIMITER //
-- CREATE PROCEDURE read_user()
-- BEGIN
--   SELECT idUser, idCard, name, lastname, email, username FROM users;
-- END
-- //
-- DELIMITER ;

DELIMITER //
CREATE FUNCTION update_user(
  v_idUser INT,
  v_idCard VARCHAR(45),
  v_name VARCHAR(45),
  v_lastname VARCHAR(45),
  v_email VARCHAR(45),
  v_username VARCHAR(45)
) RETURNS INT(1) READS SQL DATA DETERMINISTIC
BEGIN
  DECLARE res INT DEFAULT 0;
  IF EXISTS(SELECT idUser FROM users WHERE idUser = v_idUser)
    THEN
      UPDATE users SET idCard= v_idCard, name= v_name, lastname= v_lastname,
        email= v_email, username= v_username WHERE idUser = v_idUser;
      SET res = 1;
  END IF;
  RETURN res;
END
//
DELIMITER ;

-- DELIMITER //
-- CREATE FUNCTION delete_user(v_idUser INT) RETURNS INT(1) READS SQL DATA DETERMINISTIC
-- BEGIN
--   DECLARE res INT DEFAULT 0;
--   IF EXISTS(SELECT idUser FROM users WHERE idUser = v_idUser)
--     THEN
--       DELETE FROM users WHERE idUser= v_idUser;
--       SET res = 1;
--   END IF;
--   RETURN res;
-- END
-- //
-- DELIMITER ;
--
-- DELIMITER //
-- CREATE PROCEDURE read_by_id_user(v_idUser INT)
-- BEGIN
--   SELECT idUser, idCard, name, lastname, email, username, password
--     FROM users
--     WHERE idUser= v_idUser;
-- END
-- //
-- DELIMITER ;
--
-- DELIMITER //
-- CREATE PROCEDURE login_user(v_email VARCHAR(45), v_password VARCHAR(45))
-- BEGIN
--   SELECT idUser, name, lastname FROM users
--     WHERE email= v_email AND password= v_password;
-- END
-- //
-- DELIMITER ;
