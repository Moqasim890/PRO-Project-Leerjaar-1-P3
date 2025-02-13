-- Verwijder database `GymSignUp` als die bestaat
DROP DATABASE IF EXISTS `GymSignUp`;
 
-- Maak de database `GymSignUp` aan
CREATE DATABASE `GymSignUp`;
 
-- Gebruik de database `GymSignUp`
USE `GymSignUp`;
 
 
 
CREATE TABLE Gebruiker
(
     Id                INT             UNSIGNED       NOT NULL    AUTO_INCREMENT
    ,Voornaam         VARCHAR(50)                    NOT NULL
    ,Tussenvoegsel    VARCHAR(10)                        NULL
    ,Achternaam       VARCHAR(50)                    NOT NULL
    ,Gebruikersnaam   VARCHAR(100)                   NOT NULL    UNIQUE
    ,Wachtwoord       VARCHAR(60)                    NOT NULL
    ,IsIngelogd       BIT                            NOT NULL    DEFAULT 0
    ,Ingelogd         DATETIME(6)                    NULL
    ,Uitgelogd        DATETIME(6)                    NULL
    ,IsActief         BIT                            NOT NULL    DEFAULT 1
    ,Opmerking        VARCHAR(250)                        NULL
    ,DatumAangemaakt  DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd   DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
    ,CONSTRAINT       PK_Gebruiker                   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;
 
 
CREATE TABLE Rol
(
     Id               INT             UNSIGNED       NOT NULL    AUTO_INCREMENT
    ,GebruikerId      INT             UNSIGNED       NOT NULL
    ,Naam             VARCHAR(100)                   NOT NULL
    ,IsActief         BIT                            NOT NULL    DEFAULT 1
    ,Opmerking        VARCHAR(250)                        NULL
    ,DatumAangemaakt  DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd   DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
    ,CONSTRAINT       PK_Rol                        PRIMARY KEY CLUSTERED(Id)
    ,CONSTRAINT       FK_Rol_Gebruiker              FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id) ON DELETE CASCADE
) ENGINE=InnoDB;
 
 
 
CREATE TABLE Lid
(
     Id               INT             UNSIGNED       NOT NULL    AUTO_INCREMENT
    ,Voornaam         VARCHAR(50)                    NOT NULL
    ,Tussenvoegsel    VARCHAR(10)                        NULL
    ,Achternaam       VARCHAR(50)                    NOT NULL
    ,Relatienummer    MEDIUMINT                      NOT NULL
    ,Mobiel           VARCHAR(20)                    NOT NULL
    ,Email            VARCHAR(100)                   NOT NULL    UNIQUE
    ,IsActief         BIT                            NOT NULL    DEFAULT 1
    ,Opmerking        VARCHAR(250)                        NULL
    ,DatumAangemaakt  DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd   DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
    ,CONSTRAINT       PK_Lid                        PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;
 
 
 
CREATE TABLE Les
(
     Id               INT             UNSIGNED       NOT NULL    AUTO_INCREMENT
    ,Naam             VARCHAR(50)                    NOT NULL
    ,Datum            DATE                           NOT NULL
    ,Tijd             TIME                           NOT NULL
    ,MinAantalPersonen TINYINT                       NOT NULL
    ,MaxAantalPersonen TINYINT                       NOT NULL
    ,Beschikbaarheid  VARCHAR(50)                    NOT NULL
    ,IsActief         BIT                            NOT NULL    DEFAULT 1
    ,Opmerking        VARCHAR(250)                        NULL
    ,DatumAangemaakt  DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd   DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
    ,CONSTRAINT       PK_Les                        PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;
 
 
 
CREATE TABLE Reservering
(
     Id               INT             UNSIGNED       NOT NULL    AUTO_INCREMENT
    ,Voornaam         VARCHAR(50)                    NOT NULL
    ,Tussenvoegsel    VARCHAR(10)                        NULL
    ,Achternaam       VARCHAR(50)                    NOT NULL
    ,Nummer           MEDIUMINT                      NOT NULL
    ,Datum            DATE                           NOT NULL
    ,Tijd             TIME                           NOT NULL
    ,Reserveringstatus VARCHAR(20)                   NOT NULL
    ,IsActief         BIT                            NOT NULL    DEFAULT 1
    ,Opmerking        VARCHAR(250)                        NULL
    ,DatumAangemaakt  DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd   DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
    ,CONSTRAINT       PK_Reservering                 PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;
