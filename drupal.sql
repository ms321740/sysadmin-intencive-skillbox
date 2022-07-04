create database drupal;
create user drupal@localhost IDENTIFIED by 'drupal-pass';
grant all on drupal.* to drupal@localhost;
