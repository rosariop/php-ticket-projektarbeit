/* User */
CREATE TABLE user (
    username VARCHAR(16),
    pass VARCHAR(32),
    user_role VARCHAR(32),
    PRIMARY KEY (username)
);

select * from user where username = 'admin' AND pass = 'admin';


/* Categortie */
create TABLE categorie (
    cat_name VARCHAR(16),
    PRIMARY KEY (cat_name)
);

insert into categorie(cat_name) values("Hardware");
insert into categorie(cat_name) values("Software");

select * from categorie;