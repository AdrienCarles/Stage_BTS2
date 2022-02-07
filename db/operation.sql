DELIMITER |

CREATE EVENT nettoyage_table_commande
  ON SCHEDULE EVERY 1 DAY STARTS '2022-02-01 00:00:00'
  ON COMPLETION PRESERVE
DO BEGIN
   DELETE FROM commande
   WHERE datediff(sysdate(),'2022-02-01 00:00:00') > 50 
   AND id_statut = 1;
END|
DELIMITER ;
 

Datediff renvoie le nombre de jour de différence. Il faudra mettre, par exemple, un jour.