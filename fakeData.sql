
INSERT INTO `Users` VALUES ('1','vandervort.ubaldo','Schaden','Tate','mose89@example.org','510675'),
('2','ullrich.aniya','Deckow','Rowland','qzboncak@example.net','200552'),
('3','earline48','Deckow','Gerda','donnelly.sigurd@example.net','106563'),
('4','qkiehn','Konopelski','Rhianna','xking@example.com','101614'),
('5','jazmyne.kohler','Gottlieb','Loyal','hector.nicolas@example.org','222027'); 

INSERT INTO 'Books' VALUES ('','Harry Potter and the Prisoner of Azkaban','J.K. Rowling','fiction','October 2017','October 2017','The book follows Harry Potter, a young wizard, in his third year at Hogwarts School of Witchcraft and Wizardry. Along with friends Ronald Weasley and Hermione Granger, Harry investigates Sirius Black, an escaped prisoner from Azkaban who they believe is one of Lord Voldemort's old allies.','336','');

INSERT INTO 'Owned' VALUES ('UserID','ISBN','copies',);
INSERT INTO 'Owned' VALUES ('1','','1','2018-12-01','An extraordinary creative achievement by an extraordinary talent, Jim Kay's inspired reimagining of J.K. Rowling's classic series has captured a devoted following worldwide. This stunning new fully illustrated edition of Harry Potter and the Prisoner of Azkaban brings more breathtaking scenes and unforgettable characters - including Sirius Black, Remus Lupin and Professor Trelawney. With paint, pencil and pixels, Kay conjures the wizarding world as we have never seen it before. Fizzing with magic and brimming with humour, this full-colour edition will captivate fans and new readers alike as Harry, now in his third year at Hogwarts School of Witchcraft and Wizardry, faces Dementors, death omens and - of course - danger.','5','1');

INSERT INTO 'Members' VALUES ('MemberID','LastName','FirstName','phnum', 'email','addr','#booksborrowed','memberstatus',);

INSERT INTO '


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



