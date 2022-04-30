-- create database systeme_productions_laitiers;
-- grant all privileges on database systeme_productions_laitiers to admin;
-- psql -d systeme_productions_laitiers -U admin -W

create extension pgcrypto;

create table if not exists utilisateur(
	id_utilisateur serial not null,
	nom_utilisateur varchar(60) not null,
	prenom_utilisateur varchar(60) not null,
	date_de_naissance date not null,
	username_utilisateur varchar(60) not null,
	mdp_utilisateur varchar(60) not null,
	etat_compte varchar(20) not null,
	primary key(id_utilisateur)
);
insert into utilisateur values(default, 'RAKOTOSON', 'Jean Paul', '2000-07-23', 'rakotoson@gmail.com', encode(digest('rakotoson','sha1'),'hex'), 'Non valide');



create table if not exists token_utilisateur(
	id_token_utilisateur serial not null,
	id_utilisateur int not null,
	token varchar(100) not null,
	dure date not null,
	primary key(id_token_utilisateur),
	foreign key(id_utilisateur) references utilisateur(id_utilisateur)
);



create table if not exists super_utilisateur(
	id_super_utilisateur int not null,
	username_super_utilisateur varchar(60) not null,
	mdp_super_utilisateur varchar(60) not null,
	primary key(id_super_utilisateur)
);
insert into super_utilisateur values(1, 'administrateur@gmail.com', encode(digest('administrateur','sha1'),'hex'));



create table if not exists matiere_premiers(
	id_matiere_premiers int not null,
	nom_matiere_premiers varchar(50) not null,
	sueil_mininum int not null,
	primary key(id_matiere_premiers)
);
insert into matiere_premiers values(1, 'Lait', 15);
insert into matiere_premiers values(2, 'Sucre', 10);
insert into matiere_premiers values(3, 'Parfum', 20);
insert into matiere_premiers values(4, 'Conservateur', 12);
insert into matiere_premiers values(5, 'Colorant', 15);
insert into matiere_premiers values(6, 'Fruit', 20);
insert into matiere_premiers values(7, 'Ferment', 14);
insert into matiere_premiers values(8, 'Banane', 14);



create table if not exists stock_entrant(
	id_stock_entrant serial not null,
	id_matiere_premiers int not null,
	quantite_stock_entrant decimal(10,4) not null,
	date_stock_entrant date not null,
	primary key(id_stock_entrant),
	foreign key(id_matiere_premiers) references matiere_premiers(id_matiere_premiers)
);
insert into stock_entrant values(default, 1, 100, '2022-04-24');
insert into stock_entrant values(default, 2, 100, '2022-04-24');
insert into stock_entrant values(default, 3, 100, '2022-04-24');
insert into stock_entrant values(default, 4, 100, '2022-04-24');
insert into stock_entrant values(default, 5, 100, '2022-04-24');
insert into stock_entrant values(default, 6, 100, '2022-04-24');
insert into stock_entrant values(default, 7, 100, '2022-04-24');
insert into stock_entrant values(default, 8, 100, '2022-04-24');

create view view_stock_entrant as select id_matiere_premiers, sum(quantite_stock_entrant) as somme_quantite_stock_entrant from stock_entrant group by id_matiere_premiers;



create table if not exists stock_sortant(
	id_stock_sortant serial not null,
	id_matiere_premiers int not null,
	quantite_stock_sortant decimal(10,4) not null,
	date_stock_sortant date not null,
	primary key(id_stock_sortant),
	foreign key(id_matiere_premiers) references matiere_premiers(id_matiere_premiers)
);
insert into stock_sortant values(default, 1, 20, '2022-04-24');
insert into stock_sortant values(default, 2, 10, '2022-04-24');
insert into stock_sortant values(default, 3, 15, '2022-04-24');
insert into stock_sortant values(default, 4, 12, '2022-04-24');
insert into stock_sortant values(default, 5, 20, '2022-04-24');
insert into stock_sortant values(default, 6, 10, '2022-04-24');

create view view_stock_sortant as select id_matiere_premiers, sum(quantite_stock_sortant) as somme_quantite_stock_sortant from stock_sortant group by id_matiere_premiers; 


create table if not exists produits_fini(
	id_produits int not null,
	nom_produits varchar(100) not null,
	primary key(id_produits)
);
insert into produits_fini values(1, 'Yaourt');
insert into produits_fini values(2, 'Beure');
insert into produits_fini values(3, 'Glace');


create table if not exists formule(
	id_formule serial not null,
	id_produits int not null,
	nom_formule varchar(100) not null,
	primary key(id_formule),
	foreign key(id_produits) references produits_fini(id_produits)
);
insert into formule values(default, 1, 'Formule Yaourt');
insert into formule values(default, 3, 'Formule Glace');


create table if not exists details_formule(
	id_details_formule serial not null,
	id_formule int not null,
	id_matiere_premiers int not null,
	pourcentage int not null,
	primary key(id_details_formule),
	foreign key(id_formule) references formule(id_formule),
	foreign key(id_matiere_premiers) references matiere_premiers(id_matiere_premiers)
);
insert into details_formule values(default, 1, 1, 80);
insert into details_formule values(default, 1, 7, 10);
insert into details_formule values(default, 1, 8, 10);
insert into details_formule values(default, 2, 1, 40);
insert into details_formule values(default, 2, 3, 20);
insert into details_formule values(default, 2, 6, 20);
insert into details_formule values(default, 2, 2, 10);
insert into details_formule values(default, 2, 7, 10);


create table if not exists stock_produit_fini_entrant(
	id_stock_produit_fini_entrant serial not null,
	id_produits int not null,
	quantite_stock_produit_fini_entrant int not null,
	date_stock_produit_fini_entrant date not null,
	primary key(id_stock_produit_fini_entrant),
	foreign key(id_produits) references produits_fini(id_produits)
);
create view view_stock_entrant_produits_fini as select id_produits, sum(quantite_stock_produit_fini_entrant) as somme_quantite_stock_produit_fini_entrant from stock_produit_fini_entrant group by id_produits;



create table if not exists stock_produit_fini_sortant(
	id_stock_produit_fini_sortant serial not null,
	id_produits int not null,
	quantite_stock_produit_fini_sortant int not null,
	date_stock_produit_fini_sortant date not null,
	primary key(id_stock_produit_fini_sortant),
	foreign key(id_produits) references produits_fini(id_produits)
);
create view view_stock_sortant_produits_fini as select id_produits, sum(quantite_stock_produit_fini_sortant) as somme_quantite_stock_produit_fini_sortant from stock_produit_fini_sortant group by id_produits;


create view view_stock_sortant_produits_finiv2 as select
	produits_fini.id_produits,
	produits_fini.nom_produits,
	sum(stock_produit_fini_sortant.quantite_stock_produit_fini_sortant) as quantite_stock_produit_fini_sortant,
	stock_produit_fini_sortant.date_stock_produit_fini_sortant
from produits_fini join stock_produit_fini_sortant on produits_fini.id_produits = stock_produit_fini_sortant.id_produits
group by produits_fini.id_produits,produits_fini.nom_produits,stock_produit_fini_sortant.date_stock_produit_fini_sortant;


create view view_formule as select
	produits_fini.id_produits,
	produits_fini.nom_produits,
	formule.id_formule,
	formule.nom_formule,
	details_formule.id_details_formule,
	details_formule.id_matiere_premiers,
	details_formule.pourcentage,
	matiere_premiers.nom_matiere_premiers,
	matiere_premiers.sueil_mininum
from produits_fini join formule on produits_fini.id_produits = formule.id_produits
join details_formule on formule.id_formule = details_formule.id_formule
join matiere_premiers on details_formule.id_matiere_premiers = matiere_premiers.id_matiere_premiers;


create view view_stock_restant as select
	matiere_premiers.nom_matiere_premiers,
	matiere_premiers.sueil_mininum,
	view_stock_entrant.id_matiere_premiers,
	view_stock_entrant.somme_quantite_stock_entrant,
	case
		when somme_quantite_stock_sortant is Null then 0
		else somme_quantite_stock_sortant
	end as somme_quantite_stock_sortant
from matiere_premiers join view_stock_entrant on matiere_premiers.id_matiere_premiers = view_stock_entrant.id_matiere_premiers
left join view_stock_sortant on view_stock_entrant.id_matiere_premiers = view_stock_sortant.id_matiere_premiers;


create view view_stock_restant_finale as select
	view_stock_restant.nom_matiere_premiers,
	view_stock_restant.sueil_mininum,
	view_stock_restant.id_matiere_premiers,
	(view_stock_restant.somme_quantite_stock_entrant - view_stock_restant.somme_quantite_stock_sortant) as somme_quantite_stock_restant,
	current_date as date_stock
from view_stock_restant group by view_stock_restant.nom_matiere_premiers,view_stock_restant.sueil_mininum,view_stock_restant.id_matiere_premiers,view_stock_restant.somme_quantite_stock_entrant,view_stock_restant.somme_quantite_stock_sortant,date_stock;


create view view_quantite_minimale as select
	view_formule.nom_produits,
	view_formule.pourcentage,
	view_stock_restant_finale.nom_matiere_premiers,
	view_stock_restant_finale.sueil_mininum,
	view_stock_restant_finale.id_matiere_premiers,
	view_stock_restant_finale.somme_quantite_stock_restant,
	view_stock_restant_finale.date_stock
from view_formule join view_stock_restant_finale on view_formule.id_matiere_premiers = view_stock_restant_finale.id_matiere_premiers order by pourcentage desc;


create view view_stock_restant_produits_fini as select
	produits_fini.id_produits,
	produits_fini.nom_produits,
	view_stock_entrant_produits_fini.somme_quantite_stock_produit_fini_entrant,
	case
		when somme_quantite_stock_produit_fini_sortant is Null then 0
		else somme_quantite_stock_produit_fini_sortant
	end as somme_quantite_stock_produit_fini_sortant
from produits_fini join view_stock_entrant_produits_fini on produits_fini.id_produits = view_stock_entrant_produits_fini.id_produits
left join view_stock_sortant_produits_fini on view_stock_entrant_produits_fini.id_produits = view_stock_sortant_produits_fini.id_produits;


create view view_stock_restant_produits_fini_final as select
	view_stock_restant_produits_fini.id_produits,
	view_stock_restant_produits_fini.nom_produits,
	(view_stock_restant_produits_fini.somme_quantite_stock_produit_fini_entrant - view_stock_restant_produits_fini.somme_quantite_stock_produit_fini_sortant) as somme_quantite_stock_produit_fini_restant,
	current_date as date_stock
from view_stock_restant_produits_fini group by view_stock_restant_produits_fini.id_produits,view_stock_restant_produits_fini.nom_produits,view_stock_restant_produits_fini.somme_quantite_stock_produit_fini_entrant,view_stock_restant_produits_fini.somme_quantite_stock_produit_fini_sortant,date_stock;


create view view_token as select
	utilisateur.id_utilisateur,
	utilisateur.username_utilisateur,
	utilisateur.mdp_utilisateur,
	token_utilisateur.id_token_utilisateur,
	token_utilisateur.token,
	token_utilisateur.dure
from utilisateur join token_utilisateur on utilisateur.id_utilisateur = token_utilisateur.id_utilisateur;



