# Local Development Only

-- Remove commentary if you want build database from zero
# DROP DATABASE IF EXISTS `dev-hello-framework`;
# CREATE DATABASE `dev-hello-framework`;
# USE `dev-hello-framework`;

# End Local Development Only

-- Table Active Status
-- Default from Hello-Framework
DROP TABLE IF EXISTS active_status;
CREATE TABLE IF NOT EXISTS active_status (
    id CHAR(36) NOT NULL,
    name VARCHAR(150) DEFAULT NULL,
    created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT pk_active_status_id PRIMARY KEY (id)
)ENGINE=InnoDB;

-- Table Type
-- Default from Hello-Framework
DROP TABLE IF EXISTS type;
CREATE TABLE IF NOT EXISTS type (
    id CHAR(36) NOT NULL,
    name VARCHAR(150) DEFAULT NULL,
    created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT pk_type_id PRIMARY KEY (id)
)ENGINE=InnoDB;

-- Table Gender
-- Default from Hello-Framework
DROP TABLE IF EXISTS gender;
CREATE TABLE IF NOT EXISTS gender (
    id CHAR(36) NOT NULL,
    name VARCHAR(150) DEFAULT NULL,
    created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT pk_gender_id PRIMARY KEY (id)
)ENGINE=InnoDB;

-- Table Contact
-- Default from Hello-Framework
DROP TABLE IF EXISTS contact;
CREATE TABLE IF NOT EXISTS contact (
    id CHAR(36) NOT NULL,
    name VARCHAR(255) DEFAULT NULL,
    birthdate DATE DEFAULT NULL,
    genderId CHAR(36) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    email VARCHAR(255) UNIQUE DEFAULT NULL,
    phoneNumber VARCHAR(150) DEFAULT NULL,
    image TEXT DEFAULT NULL,
    typeId CHAR(36) NOT NULL,
    active_statusId CHAR(36) NOT NULL,
    created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by CHAR(36) DEFAULT NULL,
    modified_by CHAR(36) DEFAULT NULL,

    CONSTRAINT pk_contact_id PRIMARY KEY (id),
    CONSTRAINT fk_contact_genderId FOREIGN KEY (genderId) REFERENCES gender (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_contact_typeId FOREIGN KEY (typeId) REFERENCES type (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_contact_active_statusId FOREIGN KEY (active_statusId) REFERENCES active_status (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_contact_created_by FOREIGN KEY (created_by) REFERENCES contact (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_contact_modified_by FOREIGN KEY (modified_by) REFERENCES contact (id) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE=InnoDB;

-- Table User
-- Default from Hello-Framework
DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user (
    id CHAR(36) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    contactId CHAR(36) NOT NULL,
    active_statusId CHAR(36) NOT NULL,
    created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by CHAR(36) DEFAULT NULL,
    modified_by CHAR(36) DEFAULT NULL,

    CONSTRAINT pk_user_id PRIMARY KEY (id),
    CONSTRAINT fk_user_contactId FOREIGN KEY (contactId) REFERENCES contact (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_user_active_statusId FOREIGN KEY (active_statusId) REFERENCES active_status (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_user_created_by FOREIGN KEY (created_by) REFERENCES contact (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_user_modified_by FOREIGN KEY (modified_by) REFERENCES contact (id) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE=InnoDB;

-- Table Access
-- Default from Hello-Framework
DROP TABLE IF EXISTS access;
CREATE TABLE IF NOT EXISTS access (
    id CHAR(36) NOT NULL, 
    name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    icon VARCHAR(255) DEFAULT NULL,
    router VARCHAR(255) NOT NULL,
    position TINYINT(1) DEFAULT 0,
    created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT pk_access_id PRIMARY KEY (id)
)ENGINE=InnoDB;

-- Table Access Right
-- Default from Hello-Framework
DROP TABLE IF EXISTS access_right;
CREATE TABLE IF NOT EXISTS access_right (
    id CHAR(36) NOT NULL, 
    userId CHAR(36) NOT NULL,
    accessId CHAR(36) NOT NULL,
    isCanInsert TINYINT(1) DEFAULT 0,
    isCanUpdate TINYINT(1) DEFAULT 0,
    isCanDelete TINYINT(1) DEFAULT 0,
    isCanRead TINYINT(1) DEFAULT 0,
    created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT pk_access_right_id PRIMARY KEY (id),
    CONSTRAINT fk_access_right_userId FOREIGN KEY (userId) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_access_right_accessId FOREIGN KEY (accessId) REFERENCES access (id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB;