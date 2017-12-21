<!DOCTYPE html>
<html lang="hu">
  <head>
    <meta charset="utf-8">
	</head>
<body>
<h1>REST API for Academy Award Ceremony</h1>
<h2>Rövid leírás</h2>
<p>A program célja egy egyszerű REST API szerver megvalósítása PHP nyelven, ami az idei oszkár díj átadó rendezvényre lett tervezve.</p>
<h2>Fájlok és mappák</h2>
<ul>
<li>CONFIG</li>
<li><ul><li>core.php<br>hibajelzések és a lapozó alapbeállításai</li>
		<li>database.php<br>Database osztály -> adatbázis kapcsolat</li>
	</ul>
</li>
<li>OBJECTS</li>	
<li><ul><li>participants.php<br>Participants osztály -> Az oszkár díj átadó résztvevői. Lehetnek jelöltek és nyertesek, továbbá felvehetünk különféle tulajdonságokat nekik, amiket front-end oldalon a részletezésnél felhasználhatunk. Az osztály metódusai pedig a REST API szerver funkciói</li></ul>
</li>
<li>PARTICIPANTS</li>
<li><ul><li>create.php<br>
			POST alapján felvesz egy jelöltet az adatbázisba és beállítja date_added mezőt az aktuális timestamp-pel.
			Mely feladathoz: Minden oldalról (listák, részletező oldal) lehetőség van új jelölt felvételére. Ehhez egy
űrlapot kell megjeleníteni, ahol megadható a film címe, egy rövid leírás, egy borítókép
illetve egy checkbox a nyertes flag állítására.</li>
		<li>delete.php<br>
			id alapján inaktívvá tesz egy jelöltet, törlés helyet az active mezőt állítja 0-ról 1-re, ami listázáskor a megjelenés / nem megjelenést eredményezi
		</li>
		<li>read.php<br>
			Kiolvassa az összes sort az adatbázisból JSON formába. ->quality tulajdonság jelöli, hogy jelölt vagy nyertes
			Mely feladat(ok)hoz: 
				Lista megjelenítése a jelöltekről jelezve ha a jelölt egyben nyertes is.
				A lista elemekre kattintva egy info oldalra jutunk, ahol további információkat olvashatunk a
jelöltről.</li>
		<li>read_one.php<br>
			Kiolvas 1 sort az adatbázisból id alapján JSON formába.
		</li>
		<li>read_paging.php<br>
			Kiolvas core-php-ban megadott sort oldalakra tagolva az adatbázisból JSON formába.
		</li>
		<li>search.php<br>
			Id alapján, ha "s" GET-et kap, megkeresi az adott sort az adatbázisban
			Mely feladathoz: Lista megjelenítése csak a nyertesekről, a lista struktúrája megegyezik a jelöltek listájának
struktúrájával. -> ?s=winner
		</li>
		<li>update.php<br>
			POST alapján módosít egy jelöltet az adatbázisban és beállítja a változtatás aktuális timestamp-jét -> last_modified.
		Mely feladathoz: A részletező oldalról lehetőség van az adott jelölt adatainak módosítására (a felvételhez
hasonló űrlap segítségével).
		</li>
		</ul>
	</li>
	<li>SHARED</li>
	<li>
		<ul><li>database_schema.sql<br>
			A példaprogramhoz használt adatbázis participants táblájának szerkezete
			<li>
			<li>utilities.php<br>
		Különféle segédeszköz függvények lehetnének itt, jelenleg egy lapozó van megírva
			</li>
		</ul>
	</li>
</ul>
<h3>Megjegyzések<h3>
<p>Feladat: Legyen rendezhető a lista filmcím alapján, illetve nyertesek alapján (nyertesek elöl,
jelöltek utána) ->erre nem csináltam külön függvényt, mert úgy gondoltam, hogy a read funkció elegendő a lekéréshez, melyből bármi bárhogyan rendezhető.</p>
</body>
</html>