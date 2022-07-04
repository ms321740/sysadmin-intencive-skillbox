create database wp;
create user wp@localhost IDENTIFIED by 'wp-pass';
grant all on wp.* to wp@localhost;
