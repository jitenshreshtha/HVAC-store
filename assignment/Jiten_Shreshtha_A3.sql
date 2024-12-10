-- Name:Jiten Shreshtha
-- Student number: 8980448


CREATE DATABASE shreshtha48;
USE shreshtha48;

-- Creating Student table with given fields on it.
CREATE TABLE Student(
    student_id INT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    dob DATE
);
SELECT * FROM Student;
-- Creating Course table with course name and course code in it.
CREATE TABLE Course(
    course_id INT PRIMARY KEY,
    course_name VARCHAR(50) NOT NULL,
    course_code VARCHAR(100)
);
SELECT * FROM Course;
-- Creating Term table with term name in it
CREATE TABLE Term (
    term_id INT PRIMARY KEY,
    term_name VARCHAR(100)
);

SELECT * FROM Term;

-- creating enrollment table with student id and course id from student and course table respectively 
-- which links this enrollment table with those two tables.
-- term id links this enrollment table with term table
CREATE TABLE Enrollment(
    enrollment_id INT PRIMARY KEY,
    student_id INT,
    course_id INT,
    grade VARCHAR(2),
    term_id INT,  
    FOREIGN KEY(student_id) REFERENCES Student(student_id),
    FOREIGN KEY(course_id) REFERENCES Course(course_id),
    FOREIGN KEY(term_id) REFERENCES Term(term_id)  
);
SELECT * FROM Enrollment;
-- Insert data into Student table
INSERT INTO Student (student_id, first_name, last_name, email, dob) VALUES
    (8980448, 'Jiten', 'Shreshtha', 'jitenshreshtha07@yahoo.com', '1999-07-11'),
    (8980535, 'John', 'Cena', 'johncena@hotmail.com', '2001-01-19'),
    (8980212, 'Stone', 'Cold', 'stonecold@yahoomail.com', '1995-10-29');

-- Insert data into Course table
INSERT INTO Course (course_id, course_name, course_code) VALUES
    (1, 'Database', 'F2022'),
    (2, 'JavaScript', 'W2022'),
    (3, 'Java', 'S2022'),
    (4, 'Python', 'F2021'),
    (5, 'C++', 'W2021');

-- Insert data into Term table
INSERT INTO Term (term_id, term_name) VALUES
    (1, 'Fall 2021'),
    (2, 'Winter 2022'),
    (3, 'Spring 2022');

-- Insert data into Enrollment table
INSERT INTO Enrollment (enrollment_id, student_id, course_id, grade, term_id) VALUES
    (1, 8980448, 1, 'A+', 2),  
    (2, 8980448, 2, 'A+', 2),  
    (3, 8980448, 3, 'A+', 3),  
    (4, 8980535, 4, 'A+', 1),  
    (5, 8980535, 5, 'A+', 1),  
    (6, 8980535, 1, 'A', 2),   
    (7, 8980212, 3, 'B+', 3),  
    (8, 8980212, 1, 'A+', 1), 
    (9, 8980212, 2, 'A+', 2);   
