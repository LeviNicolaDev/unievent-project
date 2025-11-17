CREATE TABLE responsavelevento(
id integer primary key auto_increment,
nome varchar(200) not null,
fotoPerfil varchar(200)
) engine=InnoDB;
 
CREATE TABLE endereco(
id integer primary key auto_increment,
rua varchar(100) not null,
cidade varchar(80) not null,
bairro varchar(100) not null,
estado char(2) not null,
cep varchar(13) not null,
numero varchar(5) not null
)engine=InnoDB;
 
CREATE TABLE instituicao(
id integer primary key auto_increment,
email_login varchar(100) not null,
senha_login varchar(60) not null,
foto_perfil varchar(200) not null,
cnpj varchar (14) not null,
id_endereco_fk integer,
foreign key(id_endereco_fk)
references endereco(id)
ON DELETE CASCADE
ON UPDATE CASCADE
) engine=InnoDB;
 
CREATE TABLE aluno(
ra bigint primary key not null,
nome varchar (100) not null,
senha varchar (12) not null,
email_login varchar (100) not null,
foto_perfil varchar(200),
data_nascimento date not null,
id_instituicao_fk integer, foreign key(id_instituicao_fk)
references instituicao(id) ON DELETE CASCADE ON UPDATE CASCADE
 
)engine=InnoDB;

CREATE TABLE evento(
id integer primary key auto_increment,
nome varchar(80) not null,
descricao varchar(150) not null,
categoria_evento varchar (40) not null,
data_evento date not null,
hora_evento time not null,
capacidade int not null,
thumbnail varchar(400) not null,
thumbnail2 varchar(400),
thumbnail3 varchar(400) ,
id_responsavel_evento_fk integer, foreign key  (id_responsavel_evento_fk)
references responsavelevento(id) ON UPDATE CASCADE
ON DELETE CASCADE,
id_endereco_fk integer, foreign key  (id_endereco_fk)
references endereco(id) ON UPDATE CASCADE
ON DELETE CASCADE
)engine=InnoDB;
 
 
 
CREATE TABLE certificado(
id integer primary key auto_increment,
data_certificado date not null,
texto varchar(100) not null,
id_instituicao_fk integer, foreign key(id_instituicao_fk)
references instituicao(id) on update cascade on delete cascade,
id_aluno_fk bigint, foreign key(id_aluno_fk)
references aluno(ra) on update cascade on delete cascade,
id_evento_fk integer, foreign key  (id_evento_fk)
references evento(id) ON UPDATE CASCADE
ON DELETE CASCADE
)engine=InnoDB;
 
CREATE TABLE instituicao_evento (
    id integer PRIMARY KEY AUTO_INCREMENT,
    id_instituicao_fk integer NOT NULL,
    id_evento_fk integer NOT NULL,
    UNIQUE (id_instituicao_fk, id_evento_fk),
    FOREIGN KEY (id_instituicao_fk) REFERENCES instituicao(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_evento_fk) REFERENCES evento(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;
 
CREATE TABLE secretaria(
id int not null AUTO_INCREMENT,
nome varchar(80) not null,
email varchar(200) not null,
senha varchar(200) not null,
chave varchar(300) unique,
situacao varchar(50) default "inativo",
tentativas_login int default 0,
PRIMARY KEY (id),
id_instituicao_fk integer, foreign key (id_instituicao_fk)
references instituicao(id) ON UPDATE CASCADE ON DELETE CASCADE 
)engine=INNODB;
 
CREATE TABLE log_evento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    evento_id INT,
    data_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descricao VARCHAR(255),
    operacao VARCHAR(10)
) ENGINE=InnoDB;
 
DELIMITER //
create function emailInstitucional(email varchar (100)) returns boolean
begin 
	declare email_validado boolean;
	if email like '%@fatec.sp.gov.br' THEN set email_validado = true; 
    else set email_validado = false;
    end if;
    return email_validado;
end //
 
select emailInstitucional('levi@fatec.sp.gov.br');
 
 
DELIMITER //
 
CREATE TRIGGER log_evento_update
AFTER UPDATE ON evento
FOR EACH ROW
BEGIN
    INSERT INTO log_evento (evento_id, descricao, operacao)
    VALUES (NEW.id, CONCAT('Evento atualizado: ', OLD.nome, ' para ', NEW.nome), 'UPDATE');
END //
 
DELIMITER ;
 
INSERT INTO evento (nome, descricao, categoria_evento, data_evento, capacidade, thumbnail)
	VALUES ("Teck Rock", "Evento de musica", "Musica", '2025-01-02', 100, "foto.png")
SELECT * FROM log_evento
UPDATE evento set nome = "Hackatom" WHERE id = 1
 
 
DELIMITER //
 
CREATE TRIGGER valida_desabilita_evento
BEFORE DELETE ON evento
FOR EACH ROW
BEGIN
    DECLARE cert_count INT;
    SELECT COUNT(*) INTO cert_count
    FROM certificado
    WHERE id_evento_fk = OLD.id;
 
    IF cert_count > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Não é possível excluir este evento, pois existem certificados associados a ele.';
    END IF;
END //
 
DELIMITER ;