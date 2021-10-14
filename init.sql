CREATE TABLE users(
    uid INT NOT NULL AUTO_INCREMENT,
    uname VARCHAR(60) UNIQUE NOT NULL,
    uemail VARCHAR(100) NOT NULL,
    upassword VARCHAR(500) NOT NULL,
    uprofileimg MEDIUMBLOB,
    uprofileimgtype VARCHAR(10),
    PRIMARY KEY(uid)
) ENGINE=InnoDB;