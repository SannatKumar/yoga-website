/* Asanas Table Query */

CREATE TABLE asanas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asana_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    asana_description VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    source_id INT,
	steps_id INT,
    category_id INT,
    tag_id INT,
    time_of_the_day_id INT,
    reference_id INT,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN
);


CREATE TABLE practice_steps(
    id INT AUTO_INCREMENT PRIMARY KEY,
    asana_id INT,
    practice_steps VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN
);

/* Asanas Benefits Table Query */
CREATE TABLE asana_benefits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asana_id INT,
    benefit_description VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN
);


/* Asanas Contradictions Table Query */
CREATE TABLE asana_contraindications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asana_id INT,
    contraindication_description VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN
);


/* Mudras Table Query */
CREATE TABLE mudras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mudra_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    mudra_description VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN
);

/* Bandhas Table Query */
CREATE TABLE bandhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bandha_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    bandha_description VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    bandha_benefit
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN
);





My_sql Used Statements:
SELECT * FROM yoga_project.asanas;
UPDATE yoga_project.asanas SET category_id = 1, tag_id = 1 WHERE id < 2; 



