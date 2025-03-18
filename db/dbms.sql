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
    ,Relatienummer    VARCHAR(20)                      NOT NULL
    ,Mobiel           VARCHAR(20)                    NOT NULL
    ,Email            VARCHAR(100)                   NOT NULL    
    ,IsActief         BIT                            NOT NULL    DEFAULT 1
    ,Opmerking        VARCHAR(250)                        NULL
    ,DatumAangemaakt  DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd   DATETIME(6)                    NOT NULL    DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
    ,CONSTRAINT       PK_Lid                        PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;
 
 CREATE TABLE Medewerker (
    Id INT NOT NULL AUTO_INCREMENT,
    Voornaam VARCHAR(50) NOT NULL,
    Tussenvoegsel VARCHAR(10) NULL,
    Achternaam VARCHAR(50) NOT NULL,
    Nummer MEDIUMINT NOT NULL,
    Medewerkersoort VARCHAR(20) NOT NULL CHECK (Medewerkersoort IN ('Manager', 'Beheerder', 'Diskmedewerker')),
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250) NULL,
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
);

 
 
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

-- If you want to work with roles.
-- The passwords are The admin "admin"  Medewerker "123" Lid "Lid"

-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('1', 'Admin', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('2', 'Medewerker', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('3', 'Medewerker', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('4', 'Medewerker', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('5', 'Lid', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('6', 'Lid', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('7', 'Lid', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('8', 'Lid', 0);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('9', 'Lid', 0);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('10', 'Lid', 0);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('11', 'Lid', 0);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('12', 'Lid', 0);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('13', 'Lid', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('14', 'Lid', 1);
-- INSERT INTO `gymsignup`.`rol` (`GebruikerId`, `Naam`, `IsActief`) VALUES ('15', 'Lid', 1);


-- SELECT g.Id, g.Gebruikersnaam, r.Naam AS RolNaam
-- FROM gebruiker g
-- LEFT JOIN rol r ON r.GebruikerId = g.Id
-- WHERE g.Gebruikersnaam = Gebruikersnaam
-- ORDER BY g.Id;

-- INSERT INTO Les (Naam, Datum, Tijd, MinAantalPersonen, MaxAantalPersonen, Beschikbaarheid, IsActief, Opmerking)
-- VALUES
--     ('Yoga Morning Flow', '2025-02-17', '08:30:00', 3, 9, 'Beschikbaar', 1, 'Bring your own mat'),
--     ('HIIT Burn', '2025-02-18', '10:00:00', 3, 9, 'Volgeboekt', 1, 'High-intensity interval training'),
--     ('Strength Training', '2025-02-19', '12:00:00', 3, 9, 'Beschikbaar', 1, 'Focus on full-body strength'),
--     ('Zumba Dance', '2025-02-20', '18:00:00', 3, 9, 'Beperkt beschikbaar', 1, 'Wear comfortable shoes'),
--     ('Pilates Core', '2025-02-21', '07:00:00', 3, 9, 'Beschikbaar', 1, 'Mat provided'),
--     ('Boxing Basics', '2025-02-22', '16:30:00', 3, 9, 'Beschikbaar', 1, 'Gloves required'),
--     ('CrossFit Challenge', '2025-02-23', '19:00:00', 3, 9, 'Volgeboekt', 1, 'Advanced level'),
--     ('Spin Class', '2025-02-24', '09:00:00', 3, 9, 'Beschikbaar', 1, 'Bring water bottle'),
--     ('Bootcamp Outdoor', '2025-02-25', '17:45:00', 3, 9, 'Beperkt beschikbaar', 1, 'Outdoor training'),
--     ('Mindful Meditation', '2025-02-26', '20:30:00', 3, 9, 'Beschikbaar', 1, 'Relaxing and calming session');


-- You can inssert these lessons for testing ight.

-- INSERT INTO Les (Naam, Datum, Tijd, MinAantalPersonen, MaxAantalPersonen, Beschikbaarheid, IsActief, Opmerking)
-- VALUES 
-- ('Yoga Basics', '2025-02-19', '09:00:00', 5, 15, 'Beschikbaar', 1, 'Beginner level'),
-- ('Pilates Core', '2025-02-20', '10:30:00', 4, 12, 'Beperkt beschikbaar', 1, 'Core strengthening'),
-- ('HIIT Training', '2025-02-21', '08:00:00', 6, 20, 'Vol', 1, 'High-intensity interval training'),
-- ('Zumba Dance', '2025-02-22', '18:00:00', 5, 25, 'Beschikbaar', 1, 'Fun dance workout'),
-- ('Spinning Class', '2025-02-23', '19:30:00', 4, 15, 'Beperkt beschikbaar', 1, 'Indoor cycling'),
-- ('Boxing Basics', '2025-02-24', '17:00:00', 3, 10, 'Beschikbaar', 1, 'Beginner boxing'),
-- ('Strength Training', '2025-02-25', '12:00:00', 5, 15, 'Vol', 1, 'Muscle building'),
-- ('Cardio Blast', '2025-02-26', '07:30:00', 6, 20, 'Beschikbaar', 1, 'Intense cardio'),
-- ('CrossFit', '2025-02-27', '16:00:00', 5, 12, 'Beperkt beschikbaar', 1, 'Functional fitness'),
-- ('Meditation & Stretching', '2025-02-28', '14:00:00', 2, 10, 'Beschikbaar', 1, 'Relaxation session'),
-- ('Kickboxing', '2025-03-01', '15:30:00', 4, 12, 'Vol', 1, 'Martial arts training'),
-- ('Power Yoga', '2025-03-02', '11:00:00', 5, 18, 'Beschikbaar', 1, 'Advanced yoga poses'),
-- ('Aerobics', '2025-03-03', '09:30:00', 4, 20, 'Beperkt beschikbaar', 1, 'Cardio dance workout'),
-- ('Full Body Workout', '2025-03-04', '13:00:00', 6, 15, 'Beschikbaar', 1, 'All-round training'),
-- ('Functional Training', '2025-03-05', '18:30:00', 5, 10, 'Vol', 1, 'Strength and mobility'),
-- ('Tai Chi', '2025-03-06', '10:00:00', 3, 15, 'Beschikbaar', 1, 'Slow movement exercise'),
-- ('Calisthenics', '2025-03-07', '07:00:00', 5, 12, 'Beperkt beschikbaar', 1, 'Bodyweight exercises'),
-- ('Step Workout', '2025-03-08', '16:30:00', 4, 15, 'Beschikbaar', 1, 'Step aerobics'),
-- ('Stretch & Relax', '2025-03-09', '20:00:00', 2, 12, 'Beperkt beschikbaar', 1, 'Flexibility and relaxation'),
-- ('Bootcamp', '2025-03-10', '06:00:00', 6, 25, 'Vol', 1, 'Outdoor military-style training');
