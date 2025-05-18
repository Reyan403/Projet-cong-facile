-- Création de la base de données (congefacile)
CREATE DATABASE congefacile;

-- Création de la table (user) avec les colonnes id, email, password, enabled, role, created_at, person_id, token et connected
CREATE TABLE user (
    id INT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    enabled tinyint(1) NOT NULL,
    role VARCHAR(50) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    person_id INT NOT NULL,
    token VARCHAR(255),
    connected tinyint(1) DEFAULT 0,
    FOREIGN KEY (person_id) REFERENCES person(id)
);

-- Création de la table (person) avec les colonnes id, first_name, last_name, manager_id, department_id, position_id, alert_new_request, alert_on_answer, alert_before_vacation
CREATE TABLE person (
    id INT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    manager_id INT,
    department_id INT,
    position_id INT,
    alert_new_request tinyint(1) DEFAULT 0,
    alert_on_answer tinyint(1) DEFAULT 0,
    alert_before_vacation tinyint(1) DEFAULT 0,
    FOREIGN KEY (manager_id) REFERENCES person(id),
    FOREIGN KEY (department_id) REFERENCES department(id),
    FOREIGN KEY (position_id) REFERENCES position(id)
);

-- Création de la table (department) avec les colonnes id et name
CREATE TABLE department (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Création de la table (position) avec les colonnes id et name
CREATE TABLE position (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Création de la table (request) avec les colonnes id, request_type_id, collaborator_id, department_id, created_at, start_at, end_at, receipt_file, comment, answer_comment, answer, answer_at, jours_demandes
CREATE TABLE request (
    id INT PRIMARY KEY,
    request_type_id INT NOT NULL,
    collaborator_id INT NOT NULL,
    department_id INT NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    start_at datetime NOT NULL,
    end_at datetime NOT NULL,
    receipt_file VARCHAR(2000),
    comment TEXT,
    answer_comment TEXT,
    answer tinyint(1) NULL,
    answer_at datetime DEFAULT CURRENT_TIMESTAMP,
    jours_demandes INT DEFAULT 0,
    FOREIGN KEY (request_type_id) REFERENCES request_type(id),
    FOREIGN KEY (collaborator_id) REFERENCES person(id),
    FOREIGN KEY (department_id) REFERENCES department(id)
);

-- Création de la table (request_type) avec les colonnes id et name
CREATE TABLE request_type (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Création de la table (password_reset) avec les colonnes id, email, token, created_at, pwd_created_at
CREATE TABLE password_reset (
    id INT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    pwd_created_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- Insertion de données dans la table (user)
INSERT INTO user (id, email, password, enabled, created_at, role, person_id, token, connected)
VALUES
(1, 'manager@entreprise.com', '$argon2i$v=19$m=16,t=2,p=1$NXhERzI5WmpDM3dva1U3NA$HcFgQ+6+4DnWDT7ZUhS7ZA', 0, NOW(), 'manager', 1, NULL, 0),
(2, 'employe@entreprise.com', '$argon2i$v=19$m=16,t=2,p=1$ZHNFWUwxR2xGd1JQYmV1aA$905jIKfELFc9uYr+yKDdjg', 0, NOW(), 'employe', 2, NULL, 0),
(3, 'ghazzaoui.reyan@gmail.com', '$argon2i$v=19$m=16,t=2,p=1$UmRRWEZSQUVpNzFYWWhuOQ$81dvn2+OaJ+G5mxYMJXgRQ', 0, NOW(), 'manager', 3, NULL, 0),
(4, 'julie.denes29@gmail.com', '$argon2i$v=19$m=16,t=2,p=1$N21SUU5kNGpwTGtzd3VjMw$KUe1ZOLMklpu8/cHwU6XyQ', 0, NOW(), 'employe', 4, NULL, 0);

-- Insertion de données dans la table (person)
INSERT INTO person (id, first_name, last_name, manager_id, department_id, position_id, alert_new_request, alert_on_answer, alert_before_vacation)
VALUES
(1, 'Frédéric', 'Salesse', NULL, 3, 56, 0, 0, 0),
(2, 'Jeff', 'Martins', 1, 3, 57, 0, 0, 0),
(3, 'Reyan', 'Ghazzaoui', NULL, 2, 58, 0, 0, 0),
(4, 'Julie', 'Denes', 3, 2, 59, 0, 0, 0);


-- Insertion de données dans la table (department)
INSERT INTO department (id, name)
VALUES
(1, 'BU Symfony'),
(2, 'BU Wordpress'),
(3, 'BU Marketing'),
(4, 'BU Applications mobiles'),
(8, 'Autre'),

-- Insertion de données dans la table (position)
INSERT INTO position (id, name)
VALUES
(56, 'Directeur Techinique'), 
(57, 'Développeur Web'), 
(58, 'Développeur d\applications'), 
(59, 'Directeur de l\agence'), 
(61, 'Autre');

-- Insertion de données dans la table (request_type)
INSERT INTO request_type (id, name)
VALUES
(239, 'Congé sans solde'),
(240, 'Congé payé'),
(241, 'Congé maladie'),
(242, 'Congé paternité/maternité'),
(243, 'Autre');



