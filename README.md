# I-motive case


##Installatie
Ik heb gewerkt met xampp voor de database.
### 1 
PHP – minimaal versie 8.1 (afhankelijk van je Laravel-versie)

Composer – voor PHP dependencies

Database – MySQL, MariaDB, SQLite, of PostgreSQL (wat jij gebruikt)

Node.js + npm – voor frontend bundling met Vite

Git – om het repository te clonen


## keuzes
Eerlijk gezegd heb ik niet heel veel invloed gehad op de structuur, dit was voor mij de eerste keer werken met het opzetten van een API, een super leuke uitdaging en ik heb er zeker wat van kunnen leren. Maar om het te leren heb ik een YouTube tutorial gevolgd en die stappen heb ik gevolgd om te zorgen dat het werkt.
Omdat dit de eerste keer is dat ik werk met het opzetten van een API heb ik me daarom eigenlijk alleen maar verdiept in het neerzetten van een functionele pagina en niet eentje die er mooi uitziet.

##Verbeterpunten
Er zijn een aantal punten die ik zou willen verbeteren aan wat ik nu heb
1. Een detail pagina, op deze manier kan een gebruiker meer zien of info krijgen dan in een kleine table. Hoe groter een tabel uiteindelijk wordt hoe beter het is in mijn mening om hier een detail pagina voor op te zetten. Ik zou dan ook meteen de update form op deze detail pagina neerzetten met het ID al ingevuld.
2. Ik zou een delete button maken die in een column aan de rechterkant van de tafel staat ipv wat ik nu gedaan heb doormiddel van een form. Ook zou ik er een mooie pop-up bij maken die vraagt of je zeker weten de delete actie wilt uitvoeren. Nu is het done and dusted als je op de knop drukt
3. Beveiliging, op dit moment heeft de app geen gebruikers oid, maar mocht deze app uitgebreid worden naar gebruikers zou ik beveiliging willen toevoegen die ervoor zorgt dat alleen ingelogde gebruikers (en als het toeppaselijk is, met een bepaalde rol) de acties mogen uitvoeren.
4. User feedback, op dit moment laat ik niet aan de gebruiker weten dat acties voltooid zijn, ik zou eventueel een pop-up of bericht onder het form kunnen maken die aangeeft wanneer een actie voltooid is of gefaald is.
5. Styling, styling en nog eens styling. Ik ben niet trots op de front-end en het is verre van mobile friendly, echter zoals eerder uitgelegd bij keuzes, heb ik gekozen voor funtionaliteit > een mooie front-end omdat ik graag een goedwerkende API wilde neerzetten.

