USE minerva;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('teacher','student') NOT NULL
);

ALTER TABLE users
MODIFY role ENUM('teacher','student') NOT NULL DEFAULT 'teacher';

INSERT INTO users (name, email, password)
VALUES ('hakim', 'hakim@gmail.com', '123456');


delete from users where id_user = 4;



SELECT * FROM users;

CREATE TABLE classes (
    id_classe INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    id_teacher INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_teacher) REFERENCES users(id_user)
);

SELECT * FROM classes;


CREATE TABLE class_students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_classe INT,
    student_id INT,
    FOREIGN KEY (id_classe) REFERENCES classes(id_classe),
    FOREIGN KEY (student_id) REFERENCES users(id_user)
);

SELECT * FROM class_students;

delete from class_students where id = ;

CREATE TABLE works (
    id_work INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    description TEXT,
    file_path VARCHAR(255),
    id_classe INT,
    id_teacher INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_classe) REFERENCES classes(id_classe),
    FOREIGN KEY (id_teacher) REFERENCES users(id_user)
);


CREATE TABLE work_assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_work INT,
    student_id INT,
    FOREIGN KEY (id_work) REFERENCES works(id_work),
    FOREIGN KEY (student_id) REFERENCES users(id_user)
);


CREATE TABLE submissions (
    id_submission INT AUTO_INCREMENT PRIMARY KEY,
    id_work INT,
    student_id INT,
    content TEXT,
    file_path VARCHAR(255),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_work) REFERENCES works(id_work),
    FOREIGN KEY (student_id) REFERENCES users(id_user)
);


CREATE TABLE attendance (
    id_attendance INT AUTO_INCREMENT PRIMARY KEY,
    id_classe INT,
    student_id INT,
    status ENUM('present','absent'),
    date DATE,
    FOREIGN KEY (id_classe) REFERENCES classes(id_classe),
    FOREIGN KEY (student_id) REFERENCES users(id_user)
);


delete from attendance where id_attendance = 4 ;

SELECT * FROM attendance;


CREATE TABLE grades (
    id_grade INT AUTO_INCREMENT PRIMARY KEY,
    id_submission INT NOT NULL UNIQUE,
    grade DECIMAL(5,2) NOT NULL,
    comment TEXT,
    graded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_submission) REFERENCES submissions(id_submission)
);

CREATE TABLE chat_messages (
    id_chat INT AUTO_INCREMENT PRIMARY KEY,
    id_classe INT,
    id_user INT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_classe) REFERENCES classes(id_classe),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);
