use project;
INSERT INTO `projects` VALUES 
(1,'My first project','My first project description', '2020-01-05 18:30:04', '2020-01-06 18:30:04'),
(2,'My second project','My second project description', '2020-01-05 18:30:04', '2020-01-06 18:30:04'),
(3,'My third project','My third project description', '2020-01-05 18:30:04', '2020-01-06 18:30:04');

select * from jobs
where title = 'Marketing assistant';

select * from users;
select * from contacts;


select * from job_user;

CREATE USER 'carloss'@'localhost'IDENTIFIED WITH mysql_native_password BY 'P@ssw0rd';

