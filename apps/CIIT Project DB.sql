select * from employee e ;

\\select id,last_name,first_name from employee e ;

\\insert into employee (email, department_id, last_name, first_name, birth_date, date_hired , created_date)
values ('mahalkong@pilipinas.com', 3, 'BAYANI', 'MAC', '2025-01-01', '2026-12-01', '2026-12-01');

\\update employee set email='sprikitik@magic.com' where id=3;

\\select id, last_name , first_name from employee e where e.department_id = 1;

delete from employee where id=3;