# Gangster-Legends-V2-Ducth
Powerd by: https://www.ictscripters.com/
Original: https://github.com/ChristopherDay/Gangster-Legends-V2

Gangster Legends V2 Dutch is een open source PBBG game engine, geschreven in PHP en zijn data opslaat in een MySQL backend.
Deze vertaling wordt bijgehouden door Jeroen.G van `https://www.ictscripters.com/`
Gangster Legends v2 is a open source PBBG game engine written in PHP using a MySQL backend.

# Systeem eisen

- PHP 5.6.X of hoger
- MySQL 5.5 of hoger

# Hoe te installeren

1. Pak je bestanden uit op je webserver.
2. Navigeer naar Ganster Legends op je webserver in een browser. Voorbeeld: `http://127.0.0.1/Gangster-Legends-V2`
3. Volg de instructies.

# Handmatige installatie

1. Pak je bestanden uit op je webserver.
2. Maak een nieuwe database en database gebruiker.
3. Importeer `install/schema.sql` en `install/data.sql` in je SQL database.
4. Open `config.php` en pas de gegevens aan met jou database gebruikersnaam, wachtwoord en database naam.
5. De game zou nu gemaakt moeten zijn met wat voorbeeld data.
6. Registreer een nieuw gebruikers account op je game.
7. Open phpmyAdmin en ga naar de `users` tabel en bewerk het `U_userlevel` (van je recent aangemaakte gebruiker) van 1 naar 2. Je hebt nu admin rechten.

# Voorbeeld
Een engelstalige demo kun je vinden op: http://demo.glscript.net/ 
**Na het aanmelden ben je automatisch admin op de engelse demo site**
