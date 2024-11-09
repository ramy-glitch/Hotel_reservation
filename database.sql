CREATE TABLE admins (
    id INTEGER NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT unique_username UNIQUE (username),
    CONSTRAINT unique_email UNIQUE (email)
);

CREATE TABLE hotel_managers (
    id INTEGER NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT unique_username UNIQUE (username),
    CONSTRAINT unique_email UNIQUE (email)
);

CREATE TABLE customers (
    id INTEGER NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT unique_username UNIQUE (username),
    CONSTRAINT unique_email UNIQUE (email)
);

CREATE TABLE services (
    id INTEGER NOT NULL AUTO_INCREMENT,
    servicename VARCHAR(255) NOT NULL,
    description TEXT,
    availability BOOLEAN NOT NULL,
    cost DOUBLE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE hotels (
    id INTEGER NOT NULL AUTO_INCREMENT,
    hotelname VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    child_age_limit INTEGER NOT NULL,
    manager_id INTEGER,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (manager_id) REFERENCES hotel_managers(id)
);

CREATE TABLE rooms (
    id INTEGER NOT NULL AUTO_INCREMENT,
    room_number VARCHAR(255) NOT NULL,
    room_type VARCHAR(255) NOT NULL,
    standard_capacity INTEGER NOT NULL,
    max_capacity INTEGER NOT NULL,
    adult_price DOUBLE NOT NULL,
    child_price DOUBLE NOT NULL,
    availability BOOLEAN NOT NULL,
    hotel_id INTEGER,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);

CREATE TABLE reviews (
    id INTEGER NOT NULL AUTO_INCREMENT,
    rating INTEGER NOT NULL,
    review_comment TEXT,
    customer_id INTEGER,
    hotel_id INTEGER,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);

CREATE TABLE notifications (
    id INTEGER NOT NULL AUTO_INCREMENT,
    message TEXT NOT NULL,
    customer_id INTEGER,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE reservations (
    id INTEGER NOT NULL AUTO_INCREMENT,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    customer_id INTEGER,
    hotel_id INTEGER,
    status VARCHAR(255) NOT NULL,
    number_of_adults INTEGER NOT NULL,
    number_of_children INTEGER NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);


CREATE TABLE reservation_rooms (
    reservation_id INTEGER,
    room_id INTEGER,
    room_price DOUBLE NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (reservation_id, room_id),
    FOREIGN KEY (reservation_id) REFERENCES reservations(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

CREATE TABLE hotel_photos (
    id INTEGER NOT NULL AUTO_INCREMENT,
    photo_url TEXT NOT NULL,
    hotel_id INTEGER,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);

CREATE TABLE room_photos (
    id INTEGER NOT NULL AUTO_INCREMENT,
    photo_url TEXT NOT NULL,
    room_id INTEGER,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

