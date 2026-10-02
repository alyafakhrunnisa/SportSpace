-- Tabel untuk menyimpan data akun login (Satpam)
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
);

CREATE EXTENSION IF NOT EXISTS pgcrypto;

INSERT INTO users (nama, username, password, role) 
VALUES (
    'Administrator Utama', 
    'admin', 
    crypt('password123', gen_salt('bf')), 
    'admin'
);