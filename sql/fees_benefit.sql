DROP TABLE IF EXISTS fees_benefit;
CREATE TABLE fees_benefit(
	membership_type VARCHAR(60),
	benefit VARCHAR(120)
	PRIMARY KEY(membership_type, benefit),
	FOREIGN KEY (membership_type) REFERENCES fees(membership_type) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(benefit) REFERENCES benefit(benefit) ON DELETE CASCADE ON UPDATE CASCADE
);
