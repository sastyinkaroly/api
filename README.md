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
#			Mely feladathoz: Minden oldalról (listák, részletező oldal) lehetőség van új jelölt felvételére. Ehhez egy
űrlapot kell megjeleníteni, ahol megadható a film címe, egy rövid leírás, egy borítókép
illetve egy checkbox a nyertes flag állítására.
#		delete.php
#			id alapján inaktívvá tesz egy jelöltet, törlés helyet az active mezőt állítja 0-ról 1-re, ami listázáskor a megjelenés / nem megjelenést eredményezi
#		read.php
#			Kiolvassa az összes sort az adatbázisból JSON formába. ->quality tulajdonság jelöli, hogy jelölt vagy nyertes
#			Mely feladat(ok)hoz: 
#				Lista megjelenítése a jelöltekről jelezve ha a jelölt egyben nyertes is.
#				A lista elemekre kattintva egy info oldalra jutunk, ahol további információkat olvashatunk a
jelöltről.
#		read_one.php
#			Kiolvas 1 sort az adatbázisból id alapján JSON formába.
#		read_paging.php
#			Kiolvas core-php-ban megadott sort oldalakra tagolva az adatbázisból JSON formába.
#		search.php
#			Id alapján, ha "s" GET-et kap, megkeresi az adott sort az adatbázisban
#			Mely feladathoz: Lista megjelenítése csak a nyertesekről, a lista struktúrája megegyezik a jelöltek listájának
struktúrájával. -> ?s=winner
#		update.php
#			POST alapján módosít egy jelöltet az adatbázisban és beállítja a változtatás aktuális timestamp-jét -> last_modified.
#		Mely feladathoz: A részletező oldalról lehetőség van az adott jelölt adatainak módosítására (a felvételhez
hasonló űrlap segítségével).
#	SHARED
#		database_schema.sql
#			A példaprogramhoz használt adatbázis participants táblájának szerkezete
#		utilities.php
#		Különféle segédeszköz függvények lehetnének itt, jelenleg egy lapozó van megírva
##############
#Megjegyzések#
##############
# Feladat: Legyen rendezhető a lista filmcím alapján, illetve nyertesek alapján (nyertesek elöl,
jelöltek utána) ->erre nem csináltam külön függvényt, mert úgy gondoltam, hogy a read funkció elegendő a lekéréshez, melyből bármi bárhogyan rendezhető.
