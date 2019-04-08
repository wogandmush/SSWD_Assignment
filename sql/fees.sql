DROP TABLE IF EXISTS fees;
CREATE TABLE fees(
	membership_type VARCHAR(60) NOT NULL,
	cost VARCHAR(30) NOT NULL,
	PRIMARY KEY(membership_type)
);
	
