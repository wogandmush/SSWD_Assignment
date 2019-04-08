DROP TABLE IF EXISTS member;

CREATE TABLE member(
	user_no INT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(30),
	last_name VARCHAR(30),
	date_of_birth DATE,
	gender VARCHAR(20),
	mobile VARCHAR(15),
	home_tel VARCHAR(15),
	email VARCHAR(50),
	address VARCHAR(100),
	membership VARCHAR(15),
	class VARCHAR(50),
	password VARCHAR(30),
	PRIMARY KEY(user_no)
);

INSERT INTO member (
	user_no, 
	first_name, 
	last_name, 
	gender, 
	email, 
	membership, 
	password
	) VALUES
	(0, 'Supreme', 'Overlord', 'male' 'admin@swole.ie', 'admin', 'password'),
	(1, 'Dan', 'Quinn', 'male', 'dan@swole.ie', 'admin', 'password'),
	(2, 'Martin', 'Feeley', 'male', 'martin@swole.ie', 'admin', 'password'),
	(3, 'Oisin', 'MacSweeney', 'male', 'oisin@swole.ie', 'admin', 'password'),
	(4, 'Student', 'Monthly', 'female', 'sm@swole.ie', 'Student Monthly', 'password'),
	(5, 'Adult', 'Monthly', 'female', 'am@swole.ie', 'Adult Monthly', 'password'),
	(6, 'Adult','Yearly', 'female', 'ay@swole.ie', 'Adult Yearly', 'password'); 
