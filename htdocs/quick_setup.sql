CREATE TABLE user (
    username VARCHAR(16),
    pass VARCHAR(32),
    user_role VARCHAR(32),
    PRIMARY KEY (username)
);

create TABLE categorie (
    cat_name VARCHAR(16),
    PRIMARY KEY (cat_name)
);

CREATE TABLE ticket (
    ticket_id INT AUTO_INCREMENT,
    titel VARCHAR(16),
    frage VARCHAR(255),
    antwort VARCHAR(255),
    ticket_status VARCHAR(2),
    
    categorie VARCHAR(16),
    fragensteller VARCHAR(16),

    PRIMARY KEY (ticket_id),
    FOREIGN KEY(categorie) REFERENCES categorie(cat_name),
    FOREIGN KEY(fragensteller) REFERENCES user(username)
);

insert into categorie(cat_name) values("Hardware");
insert into categorie(cat_name) values("Software");