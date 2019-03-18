CREATE TABLE testimonial(
	first_name VARCHAR(30),
	date DATETIME DEFAULT CURRENT_TIMESTAMP,
	class_name VARCHAR(30), 
	message VARCHAR(200),
	approved BOOLEAN NOT NULL DEFAULT 0,
	PRIMARY KEY(first_name, date)
);
