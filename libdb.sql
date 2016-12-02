create table author(
    aut_id varchar(5) primary key,
    aut_name varchar(30) not null,
    aut_phone varchar(10) not null,
    aut_addr varchar(100) not null
);

create table publisher(
    pub_id varchar(5) primary key,
    pub_name varchar(30) not null,
    pub_phone varchar(10) not null,
    pub_addr varchar(100) not null
);

CREATE TABLE book(
	accn varchar(5) primary key,
	aut_id varchar(5),
	pub_id varchar(5),
	book_name varchar(30) NOT NULL,
	book_stock int,
	CONSTRAINT fk_book_author FOREIGN KEY (aut_id) REFERENCES author(aut_id),
	CONSTRAINT fk_book_publisher FOREIGN KEY (pub_id) REFERENCES publisher(pub_id),
	CHECK(book_stock>=0)
);

create table issue_books(
	issue_id int(5) primary key,
	issue_date date,
	std_id varchar(5),
	num_books INT(3) NOT NULL,
	ret_date date
);

create table book_issue(
	issue_id int(5),
	accn varchar(5)
);

ALTER TABLE book_issue
ADD CONSTRAINT pk_issue_bookId PRIMARY KEY (issue_id,accn);

ALTER TABLE book_issue
ADD FOREIGN KEY (issue_id)
REFERENCES issue_books(issue_id)

ALTER TABLE book_issue
ADD FOREIGN KEY (accn)
REFERENCES book(accn)

CREATE TABLE student(
	usn varchar(11) primary key,
	name varchar(30) not null,
	branch varchar(10) not null,
	sem int(1) not null
);

ALTER TABLE student
ADD CONSTRAINT chk_sem CHECK (sem>0 AND sem<8);

ALTER TABLE `issue_books` ADD `usn` VARCHAR(11) NOT NULL AFTER `issue_id`;

ALTER TABLE issue_books
ADD FOREIGN KEY (usn)
REFERENCES student(usn);

CREATE TABLE category(
	cat_id int(5) PRIMARY KEY,
	cat_name VARCHAR(30) not null
);

ALTER TABLE `book` ADD `cat_id` INT(5) NOT NULL AFTER `book_name`;

ALTER TABLE book
ADD FOREIGN KEY (cat_id)
REFERENCES category(cat_id);

ALTER TABLE category
MODIFY COLUMN cat_id int(5) auto increment;


ALTER TABLE issue_books ADD FOREIGN KEY (accn) REFERENCES book(accn)