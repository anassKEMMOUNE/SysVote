DROP DATABASE IF EXISTS votingDB;
CREATE DATABASE votingDB;

USE votingDB;
DROP table if exists Users;
CREATE TABLE Users (
  user_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  username VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_admin INT NOT NULL default 0
);
DROP table if exists Elections;
CREATE TABLE Elections (
  election_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL,
  description text(1000) NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL
);
DROP table if exists Candidates;
CREATE TABLE Candidates (
  candidate_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  photo VARCHAR(100) NOT NULL,
  election_id INTEGER,
  FOREIGN KEY (election_id) REFERENCES Elections(election_id)
);
DROP table if exists Votes;
CREATE TABLE Votes (
  vote_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  timestamp date NOT NULL,
  election_id INTEGER,
  candidate_id INTEGER,
  user_id INTEGER,
  FOREIGN KEY (candidate_id) REFERENCES Candidates(candidate_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id),
  FOREIGN KEY (election_id) REFERENCES Elections(election_id)
);
DROP table if exists Programs;
CREATE TABLE Programs (
  program_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  program_title VARCHAR(255) NOT NULL,
  program_description Text(1000) NOT NULL,
  program_video VARCHAR(255) NOT NULL,
  program_affiche VARCHAR(255) NOT NULL,
    candidate_id INTEGER,
  FOREIGN KEY (candidate_id) REFERENCES Candidates(candidate_id)

);
