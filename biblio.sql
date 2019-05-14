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
    ISBN INT NOT NULL,
    Title VARCHAR(50) NOT NULL,
    Author VARCHAR(50) NOT NULL,
    Genre VARCHAR (50),
    PublishedDate DATE NOT NULL,
    Publisher VARCHAR(50) NOT NULL,
    BookDescription VARCHAR(255),
    Pages INT,
    BookCover INT,
    CONSTRAINT PK_Book PRIMARY KEY(ISBN)
);

CREATE TABLE Owned (
    UserID INT NOT NULL,
    ISBN INT NOT NULL,
    Copies int,
    CreatedDate DATE NOT NULL,
    Review VARCHAR(255),
    Rate int,
    BookStatus VARCHAR (30) NOT NULL,
    FOREIGN KEY(UserID) REFERENCES Users(UserID),
    FOREIGN KEY(ISBN) REFERENCES Books(ISBN),
    CONSTRAINT PK_Owned PRIMARY KEY (UserID,ISBN)
);

CREATE TABLE Members (
    MemberID VARCHAR(10) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    FistName VARCHAR(30) NOT NULL,
    PhoneNumber INT NOT NULL,
    Email VARCHAR(50),
    MemberAddress VARCHAR(255),
    BooksBorrowed INT NOT NULL,
    MemberStatus VARCHAR(20) NOT NULL,
    CONSTRAINT PK_Member PRIMARY KEY(MemberID)
);


CREATE TABLE BookTransactions (
    TransactionID INT NOT NULL,
    ISBN INT NOT NULL,
    MemberID VARCHAR(50) NOT NULL,
    BorrowDate DATE NOT NULL,
    ReturnDate DATE NOT NULL,
    CONSTRAINT PK_Transaction PRIMARY KEY(TransactionID),
    CONSTRAINT FK_BorrowMember FOREIGN KEY(MemberID)
    REFERENCES Members(MemberID),
    CONSTRAINT FK_BorrowedBook FOREIGN KEY(ISBN)
    REFERENCES Books(ISBN)
) 