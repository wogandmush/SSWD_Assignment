DROP TABLE IF EXISTS admin;

CREATE TABLE admin(
	email VARCHAR(30), 
	password VARCHAR(60),
	PRIMARY KEY(email));
INSERT INTO admin VALUES('dan@swole.ie', 'happy');
