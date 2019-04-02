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
	first_name, last_name, date_of_birth, gender, email, membership, class, password
	)VALUES (
		'Dan', 'Quinn', '1989-07-24', 'male', 'dan@swole.ie', 'admin', 'Cardio', 'password');

