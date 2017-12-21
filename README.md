# academy-award-ceremony
#
##############
#Rövid leírás#
##############
#
#	A program célja egy egyszerű REST API szerver megvalósítása PHP nyelven, ami az idei oszkár díj átadó rendezvényre lett tervezve.
#
##################
#Fájlok és mappák#
##################
#
#	CONFIG
#		core.php
#			hibajelzések és a lapozó alapbeállításai
#		database.php
#			Database osztály -> adatbázis kapcsolat
#	OBJECTS	
#		participants.php
#			Participants osztály -> Az oszkár díj átadó résztvevői. Lehetnek jelöltek és nyertesek, továbbá felvehetünk különféle tulajdonságokat nekik, amiket front-end oldalon a részletezésnél felhasználhatunk. Az osztály metódusai pedig a REST API szerver funkciói
#	PARTICIPANTS
#		create.php
#			POST alapján felvesz egy jelöltet az adatbázisba és beállítja date_added mezőt az aktuális timestamp-pel.
#		delete.php
#			id alapján inaktívvá tesz egy jelöltet, törlés helyet az active mezőt állítja 0-ról 1-re, ami listázáskor a megjelenés / nem megjelenést eredményezi
#		read.php
#			Kiolvassa az összes sort az adatbázisból JSON formába.
#		read_one.php
#			Kiolvassa 1 sort az adatbázisból id alapján JSON formába.
#		read_paging.php
#			Kiolvas core-php-ban megadott sort oldalakra tagolva az adatbázisból JSON formába.
#		search.php
#			Id alapján, ha "s" GET-et kap, megkeresi az adott sort az adatbázisban
#		update.php
#			POST alapján módosít egy jelöltet az adatbázisban és beállítja a változtatás aktuális timestamp-jét -> last_modified.
#	SHARED
#		database_schema.sql
#			A példaprogramhoz használt adatbázis participants táblájának szerkezete
#		utilities.php
#			Különféle segédeszköz függvények lehetnének itt, jelenleg egy lapozó van megírva