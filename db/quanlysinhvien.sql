CREATE TABLE `role`
(
role_id INT AUTO_INCREMENT,
role_name VARCHAR(20),
PRIMARY KEY (role_id)
);

CREATE TABLE `subject`
(
subject_id INT AUTO_INCREMENT,
subject_name VARCHAR(50),
number_of_credits INT,
PRIMARY KEY (subject_id)
);

CREATE TABLE teacher
(
teacher_id INT AUTO_INCREMENT,
teacher_name VARCHAR(50),
date_of_birth DATE,
phonenumber VARCHAR(50),
email VARCHAR(50),
address VARCHAR(50),
user_name VARCHAR(50),
`password` VARCHAR(50),
role_id INT,
subject_id INT,
PRIMARY KEY (teacher_id),
FOREIGN KEY (role_id) REFERENCES `role`(role_id),
FOREIGN KEY (subject_id) REFERENCES `subject`(subject_id)
);

CREATE TABLE `admin`
(
admin_id INT AUTO_INCREMENT,
admin_name VARCHAR(50),
date_of_birth DATE,
phonenumber VARCHAR(50),
email VARCHAR(50),
address VARCHAR(50),
user_name VARCHAR(50),
`password` VARCHAR(50),
role_id INT,
PRIMARY KEY (admin_id),
FOREIGN KEY (role_id) REFERENCES `role`(role_id)
);

CREATE TABLE class
(
class_id INT AUTO_INCREMENT,
class_name VARCHAR(50),
grade VARCHAR(10),
academic_year VARCHAR(50),
number_of_students INT,
teacher_id INT,
PRIMARY KEY (class_id),
FOREIGN KEY (teacher_id) REFERENCES teacher(teacher_id)
);

CREATE TABLE parent
(
parent_id INT AUTO_INCREMENT,
parent_name VARCHAR(50),
phonenumber VARCHAR(50),
email VARCHAR(50),
address VARCHAR(50),
PRIMARY KEY (parent_id)
);

CREATE TABLE student
(
student_id INT AUTO_INCREMENT,
student_name VARCHAR(50),
date_of_birth DATE,
phonenumber VARCHAR(50),
email VARCHAR(50),
address VARCHAR(50),
user_name VARCHAR(50),
`password` VARCHAR(50),
role_id INT,
class_id INT,
parent_id INT,
image VARCHAR(50),
PRIMARY KEY (student_id),
FOREIGN KEY (role_id) REFERENCES `role`(role_id),
FOREIGN KEY (class_id) REFERENCES class(class_id),
FOREIGN KEY (parent_id) REFERENCES parent(parent_id)
);

CREATE TABLE registered_subject
(
subject_id INT,
student_id INT,
score FLOAT,
`schedule` DATE,
FOREIGN KEY (subject_id) REFERENCES `subject`(subject_id),
FOREIGN KEY (student_id) REFERENCES student(student_id)
);

CREATE TABLE evaluation
(
evaluation_id INT AUTO_INCREMENT,
reason VARCHAR(50),
`date` DATE,
type_evaluation TINYINT(1),
student_id INT,
PRIMARY KEY (evaluation_id),
FOREIGN KEY (student_id) REFERENCES student(student_id) 
);

CREATE TABLE fee
(
fee_id INT AUTO_INCREMENT,
total_amount FLOAT,
payment_deadline DATE,
payment_status TINYINT(1),
student_id INT,
PRIMARY KEY (fee_id),
FOREIGN KEY (student_id) REFERENCES student(student_id) 
);

CREATE TABLE subject_fee
(
fee_id INT,
subject_id INT,
FOREIGN KEY (fee_id) REFERENCES fee(fee_id),
FOREIGN KEY (subject_id) REFERENCES `subject`(subject_id)  
);

CREATE TABLE academic_transcript
(
transcript_id INT AUTO_INCREMENT,
gpa FLOAT,
student_id INT,
PRIMARY KEY (transcript_id),
FOREIGN KEY (student_id) REFERENCES student(student_id)
);

CREATE TABLE class_by_subject
(
class_id INT AUTO_INCREMENT,
class_name VARCHAR(50),
number_of_students INT,
subject_id INT,
teacher_id INT,
PRIMARY KEY (class_id),
FOREIGN KEY (teacher_id) REFERENCES teacher(teacher_id),
FOREIGN KEY (subject_id) REFERENCES `subject`(subject_id)
);

CREATE TABLE student_class_by_subject
(
student_id INT,
subject_id INT,
FOREIGN KEY (subject_id) REFERENCES `subject`(subject_id),
FOREIGN KEY (student_id) REFERENCES student(student_id)
);