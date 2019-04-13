DROP TABLE IF EXISTS admin;

CREATE TABLE admin(
	email VARCHAR(60), 
	password VARCHAR(60),
	PRIMARY KEY(email));
INSERT INTO admin VALUES('dan@swole.ie', 'password');
INSERT INTO admin VALUES('martin@swole.ie', 'password');
INSERT INTO admin VALUES('oisin@swole.ie', 'password');
INSERT INTO admin VALUES('admin@swole.ie', 'password');
INSERT INTO admin VALUES('dan@pff.ie', 'password');
INSERT INTO admin VALUES('martin@pff.ie', 'password');
INSERT INTO admin VALUES('oisin@pff.ie', 'password');
INSERT INTO admin VALUES('admin@pff.ie', 'password');
