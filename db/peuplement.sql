INSERT INTO `role`(`lib_role`) 
VALUES 
("Utilisateur"),
("Controleur"),
("Administrateur");

INSERT INTO `produit`(`lib_produit`, `type_produit`, `spec_produit`, `prix_produit`, `diametre_produit`) 
VALUES 
("Petit Badge","Badge","Petit",1,56),
("Grand Badge","Badge","Grand",1.50,70),
("Porte-clé","Porte-clé",NULL,1,56),
("Porte-clé Miroir","Porte-clé","Miroir",2,56),
("Petit Magnet","Magnet","Petit",1,56),
("Grand Magnet","Magnet","Grand",1.50,70),
("Petit Miroir","Miroir","Petit",1,56),
("Grand Miroir","Miroir","Grand",1.50,70),
("Décapsuleur Porte-clé","Décapsuleur","Porte-clé",2,56),
("Décapsuleur Magnet","Décapsuleur","Magnet",2,56);

INSERT INTO `famille`(`lib_famille`,'promo_famille') 
VALUES 
("Héro",0),
("Zen",0),
("Vanlentin",1),

INSERT INTO `image`(`id_famille`, `id_image`) 
VALUES 
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(1,6),
(1,7),
(1,8),
(1,9),
(1,10),
(1,11),
(1,12),
(1,13),
(1,14),
(1,15),
(1,16),
(1,17),
(1,18),
(1,19),
(1,20),
(1,21),
(1,22),
(1,23),
(1,24),
(1,25),
(1,26),
(2,1),
(2,2),
(2,3),
(2,4),
(2,5),
(2,6),
(2,7),
(2,8),
(2,9),
(2,10),
(2,11),
(2,12),
(2,13),
(2,14),
(2,15),
(2,16),
(2,17),
(2,18),
(2,19),
(2,20),
(2,21),
(2,22),
(2,23),
(2,24),
(2,25),
(2,26),
(2,27),
(2,28),
(2,29),
(2,30),

INSERT INTO `statut`(`lib_statut`) 
VALUES 
("Panier"),
("Valider_client"),
("Valider_controleur"),
("Annulee_client"),
("Annulee_controleur"),
("Fabrique"),
("Livre")

INSERT INTO `utilisateur`(`nom_user`, `prenom_user`, `mdp_user`, `classe_user`, `tel_user`, `mail_user`, `id_role`) 
VALUES 
("Default","Default",NULL,NULL,NULL,NULL,1),



 