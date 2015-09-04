DROP TABLE IF EXISTS board;
CREATE TABLE board (
	id INTEGER AUTO_INCREMENT NOT NULL,
	user_name VARCHAR(20) NOT NULL,
	password VARCHAR(40) NOT NULL,
	subject VARCHAR(30) NOT NULL,
	body TEXT,
	updated_at DATETIME,
	created_at DATETIME,
	PRIMARY KEY (id)
) ENGINE = INNODB;
