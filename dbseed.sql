DROP TABLE IF EXISTS conferences;

CREATE TABLE IF NOT EXISTS conferences (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        date BIGINT(15) NOT NULL,
        location POINT NOT NULL,
        country VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY (id),
        SPATIAL INDEX `SPATIAL` (`location`)
    ) ENGINE=INNODB;

INSERT INTO conferences
        (name, date, location, country)
    VALUES
        ('NAME_TEST_1', 1661288848897, Point(34,35), 'UKRAINE'),
        ('NAME_TEST_2', 1661287848897, Point(34,35.4232), 'GREAT BRITAIN');