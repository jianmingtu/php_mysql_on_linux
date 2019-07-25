# php_mysql_on_linux


we built public facing pages, which display database driven HTML content complete with page navigation. 
And we excluded subjects and pages, which should not be visible to the public. 
We learned to encrypt passwords and to perform and require user authentication. 
We nested the CRUD for our pages inside the subjects area complete with code to automatically manage their positions. 
In the end, we developed a respectable content management system together.

This is, of course, only the beginning. A real world content management system would use these same techniques to build even more tools. 
Maybe there's a database table of products and product categories, or maybe there's an area that lists recent press releases. 
A database could hold office locations, staff, salespeople, or job openings. 
The details are different for every single project, but the fundamental concepts are the same as those that we've learned in this course.

Important terminology:
- index array vs associated array
- null coalesce (only php7) ex., $id = $_GET['id'] ?? '';
- strip_tags, strtlower, implore, empty, echo, print_r, in_array, trim, ucfirst, sort, rsort, strpos, strsub, new DateTime('America/LosAngoles'), isset, header('Location: xx.php)
  $_GET, $_POST, $_SERVER['REQUEST_METHOD'], htmlentities, urlencode, htmlspecialchars, $$name, preg_match, etc.
- SHOW DA;TABASE; CREATE DATABASE db_name; USE db_name; DROP DATABASE db_name;
- GRANT ALL PRIVILEGES ON db_name.* TO 'username'@'localhost' IDENTIFIED BY 'password';
- DROP USER [IF EXISTS] user, [user],..
- SHOW GRANTS FOR 'username'@'localhost'
- SELECT user, host from mysql.user;
- SHOW variables like 'validate_password%';  to get policy
- CREATE TABLE table_name (col_name, definition, ...);
- SHOW TABLES;
- SHOW COLUMNS FROM table_name;
- DROP TABLE table_name;
- CRUD, INSERT INTO table_name (...) VALUES (...), SELECT, UPDATE table_name SET col=value,..., DELETE FROM table_name WHERE ;
- ALTER TABLE pages ADD INDEX fk_col(col)
- RENAME TABLE oldtablename TO newtablename;
- ALTER TABLE table_name CHANG oldfieldname newfieldname datatype;
- ALTER TABLE table_name ADD   fiedlname datatype;
- ALTER TABLE table_name DROP COLUMN deleting_fieldname;
- to rename db_name, first $mysqldump -u username -P -V olddb > olddb.sql, second $mysqladmin -u username -P create newdb, and then
                          $mysql -u username -P -V newdb > olddb.sql
- mysqli_connection, mysqli_query, mysqli_insert_id, mysqli_fetch_assoc, mysqli_free_result, mysqli_close, mysqli_real_escapt_string to convert '" to \' \"
- prepare mysql statement to secure query
- $COOKIE, $SESSION, setcookie($name, $value, $expire, ...), unset($COOKIE['admin']), unset($SESSION['admin'])

                           


