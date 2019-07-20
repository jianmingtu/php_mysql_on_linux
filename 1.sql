create table admins (
   id INT(11) not null auto_increment,
    first_name varchar(255),
     last_name varchar(255),
     email varchar(255),
     username varchar(255),
     hashed_password varchar(255),
     primary key (id)
     );

