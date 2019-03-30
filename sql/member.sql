CREATE TABLE member(
	user_no INT NOT NULL AUTOINCREMENT,
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

