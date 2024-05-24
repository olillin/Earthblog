# EarthBlog ⛰️

## Setup

1. Importera [database/db.sql](database/db.sql) för att sätta upp databasen. Det är inte
   säkert att webbplatsen fungerar annars.
2. Webbplatsen förväntar sig ha tillgång till databasen `blogg` med användaren
   `it` och lösenord `abc123!`, detta kan konfigureras i
   [lib/db-helper.php](lib/db-helper.php). Säg till att användaren finns med
   korrekta privileger.

## Användare

| userFullName     | loginName | password        |
| ---------------- | --------- | --------------- |
| Oliver Lindell   | oli       | abc123!         |
| Salar Asker Zada | salar     | sakertlosen456! |
