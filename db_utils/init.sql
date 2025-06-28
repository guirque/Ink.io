CREATE TABLE user(
    Username varchar(30),
    Password varchar(65) NOT NULL,
    Profile_Picture varchar(65) DEFAULT NULL,
    Email varchar(30) UNIQUE NOT NULL,
    PRIMARY KEY (Username)
);

CREATE TABLE drawing(
    Id varchar(60),
    Author varchar(30) NOT NULL,
    Title varchar(25) DEFAULT "Untitled",
    Description varchar(50),
    Image varchar(30) NOT NULL,
    Published_Date date,

    PRIMARY KEY (Id),

    CONSTRAINT author FOREIGN KEY (Author)
        REFERENCES user(Username)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);