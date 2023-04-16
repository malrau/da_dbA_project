CREATE DATABASE cb_collection;

USE cb_collection;

CREATE TABLE figure(
    firstName VARCHAR(30),
    lastName VARCHAR(30),
    pseudonym VARCHAR(20),
    PRIMARY KEY(pseudonym)
    );
    
CREATE TABLE comic_book(
    series VARCHAR(30),
    issueNumber INT,
    coverTitle VARCHAR(50),
    PRIMARY KEY(series, issueNumber)
    );

CREATE TABLE starring(
    comic_book VARCHAR(50),
    issue INT,
    figure VARCHAR(20),
    role VARCHAR(12),
    city VARCHAR(30),
    state VARCHAR(30),
    PRIMARY KEY(comic_book, issue, figure),
    FOREIGN KEY(comic_book, issue) 
        REFERENCES comic_book(series, issueNumber)
        ON DELETE no action
        ON UPDATE cascade,
    FOREIGN KEY(figure)
        REFERENCES figure(pseudonym)
        ON DELETE no action
        ON UPDATE cascade
    );

CREATE TABLE editor(
    name VARCHAR(30),
    city VARCHAR(30),
    PRIMARY KEY(name)
    );

CREATE TABLE publishing(
    editor VARCHAR(30),
    comic_book VARCHAR(30),
    issue INT,
    PRIMARY KEY(editor, comic_book, issue),
    FOREIGN KEY(editor)
        REFERENCES editor(name)
        ON DELETE no action
        ON UPDATE cascade,
    FOREIGN KEY(comic_book, issue)
        REFERENCES comic_book(series, issueNumber)
        ON DELETE no action
        ON UPDATE cascade
    );

CREATE TABLE writer(
    firstName VARCHAR(30),
    lastName VARCHAR(30),
    pseudonym VARCHAR(30),
    PRIMARY KEY(firstName, lastName)
    );

CREATE TABLE artist(
    firstName VARCHAR(30),
    lastName VARCHAR(30),
    pseudonym VARCHAR(30),
    PRIMARY KEY(firstName, lastName)
    );

CREATE TABLE authoring(
    writerFirstName VARCHAR(30),
    writerLastName VARCHAR(30),
    artistFirstName VARCHAR(30),
    artistLastName VARCHAR(30),
    PRIMARY KEY(writerFirstName, writerLastName, artistFirstName, artistLastName),
    FOREIGN KEY(writerFirstName, writerLastName)
        REFERENCES writer(firstName, lastName)
        ON DELETE no action
        ON UPDATE cascade,
    FOREIGN KEY(artistFirstName, artistLastName)
        REFERENCES artist(firstName, lastName)
        ON DELETE no action
        ON UPDATE cascade
    );
