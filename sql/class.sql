DROP TABLE IF EXISTS class;

CREATE TABLE class(
	class_title VARCHAR(30),
	summary VARCHAR(200),
	photo_url VARCHAR(999),
	PRIMARY KEY(class_title)
);

INSERT INTO class VALUES
	('Yoga', 'Yoga fire', 'images/yoga.jpg'),
	('Strength', 'Unlimited power!!!', 'images/strength.jpg'),
	('Cardio', 'Can\'t stop won\'t stop!', 'images/cardio.jpg');
