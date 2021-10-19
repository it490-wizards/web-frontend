CREATE TABLE user(
    user_id         int PRIMARY KEY AUTO_INCREMENT,
    username        varchar(64),
    password_hash   binary(32), -- SHA-256 produces a 32-byte digest
    salt            binary(16)
);
