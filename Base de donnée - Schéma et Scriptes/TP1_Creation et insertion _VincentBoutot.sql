
use twitchbot;

drop table if exists LiveViewers;
drop table if exists Timeout;
drop table if exists UtilisateursBadges;
drop table if exists Utilisateurs;
drop table if exists Badges;
drop table if exists Live;


create table if not exists Live(
						id INT PRIMARY KEY,
                        titre varchar(60) not null,
                        description varchar(60),
                        datedebut date not null,
                        datefin date,
                        nbmessagestotal double);
                        
                                      
create table if not exists Badges(
						id int primary key auto_increment,
                        titre varchar(20),
                        description text);
                        
                        
                   
create table if not exists Utilisateurs(
						id INT primary key,
                        username varchar(30),
                        nbtempsregarder time,
                        nbpointstotal int,
                        nbmessagetotal double,
                        badgeid int,
                        foreign key (badgeid) references Badges(id));
                        
                        
                        
create table if not exists Timeout(
						usernameID int, 
                        datemoderation date not null,
                        liveid int,
                        description text not null,
                        foreign key (usernameID) references Utilisateurs(id),
                        foreign key (liveid) references Live(id));
                        
                        
                        
create table if not exists LiveViewers(
						usernameID int not null, 
                        tempsregarder time,
                        nbpoints int,
                        nbmessage double,
                        foreign key (usernameID) references Utilisateurs(id));
                        



INSERT INTO `twitchbot`.`badges` (`id`, `titre`, `description`) VALUES ('1', 'Paysant', 'Fonctionnalités de base');
INSERT INTO `twitchbot`.`badges` (`id`, `titre`, `description`) VALUES ('2', 'Artisant', 'Haut-gradé du rang paysant');
INSERT INTO `twitchbot`.`badges` (`id`, `titre`, `description`) VALUES ('3', 'Compte', 'Contrôle sur les Artisant et les paysants');
INSERT INTO `twitchbot`.`badges` (`id`, `titre`, `description`) VALUES ('4', 'Bourgeois', 'La richesse n\'est plus un problème');
INSERT INTO `twitchbot`.`badges` (`id`, `titre`, `description`) VALUES ('5', 'Chevalier', 'Au service du Roi');
INSERT INTO `twitchbot`.`badges` (`id`, `titre`, `description`) VALUES ('6', 'Roi', 'Contrôle sur tous. ');