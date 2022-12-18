
-- PROCEDURE delete_category
DROP PROCEDURE IF EXISTS delete_category;

DELIMITER //
CREATE PROCEDURE delete_category (category_id VARCHAR(50))
BEGIN
    DECLARE idx INT;
    DECLARE current_delete VARCHAR(50);
    DECLARE next_delete VARCHAR(50);
    SET idx = 0;
    SET current_delete = category_id;

    WHILE idx = 0 DO
        IF current_delete IS NOT NULL THEN
            SET next_delete = (SELECT category_id FROM wp_category WHERE parent_category_id = current_delete);
            DELETE FROM wp_category WHERE category_id = current_delete;
            SET current_delete = next_delete;
        ELSE
            SET idx = 1;
        END IF;
    END WHILE;
END; //
DELIMITER ;
-- 

-- PROCEDURE get_master_category
DROP PROCEDURE IF EXISTS get_master_category;

DELIMITER //
CREATE PROCEDURE get_master_category (
    IN current_category_id VARCHAR(50),
    OUT master_category_id VARCHAR(50)
)
BEGIN
    DECLARE idx INT;
    DECLARE current_id VARCHAR(50);
    SET idx = 0;
    SET current_id = current_category_id;

    WHILE idx = 0 DO
        SET master_category_id = (SELECT parent_category_id FROM wp_category WHERE category_id = current_id);
        IF master_category_id IS NOT NULL THEN
            SET current_id = master_category_id;
        ELSE
            SET idx = 1;
            SET master_category_id = current_id;
        END IF;
    END WHILE;

    SELECT @master_category_id;
END; //
DELIMITER ;

CALL get_master_category('sub-category-1', @master_category_id);