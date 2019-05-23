CREATE DATABASE biblio;

CREATE TABLE Users (
    UserID INT NOT NULL,
    Username VARCHAR (30) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    FirstName VARCHAR(30) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Pword VARCHAR(30) NOT NULL,
    CONSTRAINT PK_User PRIMARY KEY(UserID)
);


CREATE TABLE Books (
    ISBN VARCHAR(255) NOT NULL,
    Title VARCHAR(50) NOT NULL,
    Author VARCHAR(50) NOT NULL,
    Genre VARCHAR (50),
    BookLanguage VARCHAR(32),
    PublishedDate DATE NOT NULL,
    Publisher VARCHAR(50) NOT NULL,
    BookDescription VARCHAR(255),
    Pages INT,
    BookCover VARCHAR(255),
    CONSTRAINT PK_Book PRIMARY KEY(ISBN)
);

CREATE TABLE Owned (
    UserID INT NOT NULL,
    ISBN VARCHAR(255) NOT NULL,
    Copies int,
    CreatedDate DATE NOT NULL,
    Review VARCHAR(255),
    Rate int,
    AvailableCopies INT NOT NULL,
    FOREIGN KEY(UserID) REFERENCES Users(UserID),
    FOREIGN KEY(ISBN) REFERENCES Books(ISBN),
    CONSTRAINT PK_Owned PRIMARY KEY (UserID,ISBN)
);

CREATE TABLE Members (
    MemberID INT NOT NULL AUTO_INCREMENT,
    LastName VARCHAR(50) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    PhoneNumber VARCHAR(30) NOT NULL,
    Email VARCHAR(255),
    MemberAddress TEXT,
    BooksBorrowed INT NOT NULL,
    UserID INT NOT NULL,
    Photo VARCHAR (255),
    FOREIGN KEY(UserID) REFERENCES Users(UserID),
    CONSTRAINT PK_Member PRIMARY KEY(MemberID)
);


CREATE TABLE Transactions (
    TransactionID INT NOT NULL AUTO_INCREMENT,
    ISBN VARCHAR(255) NOT NULL,
    MemberID INT NOT NULL,
    BorrowDate DATE NOT NULL,
    ReturnDate DATE NOT NULL,
    CONSTRAINT PK_Transaction PRIMARY KEY(TransactionID),
    CONSTRAINT FK_BorrowMember FOREIGN KEY(MemberID)
    REFERENCES Members(MemberID),
    CONSTRAINT FK_BorrowedBook FOREIGN KEY(ISBN)
    REFERENCES Books(ISBN)
) 