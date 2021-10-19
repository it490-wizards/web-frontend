CREATE TABLE user(
    user_id     INT PRIMARY KEY,
    username    VARCHAR(64),
    password    CHAR(64),
    salt        CHAR(16)
);
