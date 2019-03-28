CREATE TABLE testimonial(
	first_name VARCHAR(30) NOT NULL,
	date DATETIME DEFAULT CURRENT_TIMESTAMP,
	class_name VARCHAR(30),
	message VARCHAR(300),
	approved BOOLEAN DEFAULT 0,
	PRIMARY KEY(first_name, date)
);
