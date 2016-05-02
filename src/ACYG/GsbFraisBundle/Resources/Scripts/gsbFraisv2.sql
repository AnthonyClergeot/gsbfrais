#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

DROP DATABASE gsb_frais ;

CREATE DATABASE gsb_frais ;
USE gsb_frais ;

#------------------------------------------------------------
# Table: Comptable
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Comptable(
        id           Varchar (4)  NOT NULL ,
        nom          Varchar (40) ,
        prenom       Varchar (40) ,
        login        Varchar (20) ,
        mdp          Varchar (20) ,
        adresse      Varchar (60) ,
        cp           Char (5) ,
        ville        Varchar (40) ,
        dateEmbauche Date ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Visiteur
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Visiteur(
        id           Varchar (4)  NOT NULL ,
        nom          Varchar (40) ,
        prenom       Varchar (40) ,
        login        Varchar (20) ,
        mdp          Varchar (30) ,
        adresse      Varchar (60) ,
        cp           Char (5) ,
        ville        Varchar (40) ,
        dateEmbauche Date ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Etat
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Etat(
        id      Varchar (3)  NOT NULL ,
        libelle Varchar (30) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FicheFrais
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FicheFrais(
        id              int (11) Auto_increment  NOT NULL ,
        mois            Int NOT NULL ,
        annee           Int NOT NULL ,
        nbJustificatifs Int ,
        montantValide   Decimal (10,2) ,
        dateModif       Date ,
        id_Visiteur     Varchar (4) NOT NULL ,
        id_Etat         Varchar (3) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FraisForfait
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FraisForfait(
        id      Varchar (3)  NOT NULL ,
        libelle Varchar (40) ,
        montant Decimal (5,2) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: LigneFraisHorsForfait
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LigneFraisHorsForfait(
        id            int (11) Auto_increment  NOT NULL ,
        libelle       Varchar (100) ,
        date          Date ,
        montant       Decimal (10,2) ,
        id_FicheFrais Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: LigneFraisForfait
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LigneFraisForfait(
        id              int (11) Auto_increment  NOT NULL ,
        quantite        Int ,
        id_FraisForfait Varchar (3) NOT NULL ,
        id_FicheFrais   Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


ALTER TABLE FicheFrais ADD CONSTRAINT FK_FicheFrais_id_Visiteur FOREIGN KEY (id_Visiteur) REFERENCES Visiteur(id);
ALTER TABLE FicheFrais ADD CONSTRAINT FK_FicheFrais_id_Etat FOREIGN KEY (id_Etat) REFERENCES Etat(id);
ALTER TABLE LigneFraisHorsForfait ADD CONSTRAINT FK_LigneFraisHorsForfait_id_FicheFrais FOREIGN KEY (id_FicheFrais) REFERENCES FicheFrais(id);
ALTER TABLE LigneFraisForfait ADD CONSTRAINT FK_LigneFraisForfait_id_FraisForfait FOREIGN KEY (id_FraisForfait) REFERENCES FraisForfait(id);
ALTER TABLE LigneFraisForfait ADD CONSTRAINT FK_LigneFraisForfait_id_FicheFrais FOREIGN KEY (id_FicheFrais) REFERENCES FicheFrais(id);
