CREATE DATABASE cb_collection;

USE cb_collection;

CREATE TABLE figure(
    firstName VARCHAR(30),
    lastName VARCHAR(30),
    pseudonym VARCHAR(20),
    PRIMARY KEY(pseudonym)
    );
    
CREATE TABLE comic_book(
    cbID INT AUTO_INCREMENT,
    series VARCHAR(30),
    issueNumber INT,
    coverTitle VARCHAR(50),
    UNIQUE(series, issueNumber),
    PRIMARY KEY(cbID)
    );

CREATE TABLE starring(
    comic_bookID INT,
    figure VARCHAR(20),
    figureRole VARCHAR(20),
    city VARCHAR(30),
    country VARCHAR(30),
    PRIMARY KEY(comic_bookID, figure),
    FOREIGN KEY(comic_bookID) 
        REFERENCES comic_book(cbID)
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
    comic_bookID INT,
    PRIMARY KEY(editor, comic_bookID),
    FOREIGN KEY(editor)
        REFERENCES editor(name)
        ON DELETE no action
        ON UPDATE cascade,
    FOREIGN KEY(comic_bookID)
        REFERENCES comic_book(cbID)
        ON DELETE no action
        ON UPDATE cascade
    );

CREATE TABLE writer(
    writerID INT AUTO_INCREMENT,
    firstName VARCHAR(30),
    lastName VARCHAR(30),
    pseudonym VARCHAR(30),
    UNIQUE(firstName, lastName),
    PRIMARY KEY(writerID)
    );

CREATE TABLE artist(
    artistID INT AUTO_INCREMENT,
    firstName VARCHAR(30),
    lastName VARCHAR(30),
    pseudonym VARCHAR(30),
    UNIQUE(firstName, lastName),
    PRIMARY KEY(artistID)
    );

CREATE TABLE authoring(
    writerID INT,
    artistID INT,
    comic_bookID INT,
    PRIMARY KEY(writerID, artistID, comic_bookID),
    FOREIGN KEY(writerID)
        REFERENCES writer(writerID)
        ON DELETE no action
        ON UPDATE cascade,
    FOREIGN KEY(artistID)
        REFERENCES artist(artistID)
        ON DELETE no action
        ON UPDATE cascade,
    FOREIGN KEY(comic_bookID)
		REFERENCES comic_book(cbID)
		ON DELETE no action
		ON UPDATE cascade
    );
