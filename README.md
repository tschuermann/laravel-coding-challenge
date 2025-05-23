# laravel-coding-challenge

Eine Laravel-Anwendung zum Verwalten und Teilen von Beiträgen mit Gast- und Nutzerfunktion.

## Systemvoraussetzungen

- PHP >= 8.2
- Composer
- Node.js & npm

## Verwendete Technologien

- [Laravel Breeze](https://laravel.com/docs/starter-kits) als Authentifizierungs-Starterkit
- [Tailwind CSS 4](https://tailwindcss.com/docs/installation) als CSS-Framework
- Vite für das Asset-Building
- Livewire für dynamische Komponenten
- SQLite als Datenbank

## Installation

1. Repository klonen:
git clone https://github.com/tschuermann/laravel-coding-challenge
cd laravel-coding-challenge

2. Abhängigkeiten installieren:
composer install
npm install

3. Umgebungsdatei kopieren 
cp .env.example .env

4. Umgebungsdatei für SQLite konfigurieren:
"DB_CONNECTION=sqlite"
"# DB_HOST=127.0.0.1"
"# DB_PORT=3306"
"DB_DATABASE=database.sqlite"
"# DB_USERNAME=root"
"# DB_PASSWORD="

5. Anwendungsschlüssel generieren:
php artisan key:generate

6. Migrationen und ggf. Seed-Daten ausführen:
php artisan migrate

7. Speicherordner verlinken (für Bild-Uploads):
php artisan storage:link

8. Assets bauen:
npm run build

9. Lokalen Server starten:
php artisan serve

Die Anwendung ist unter http://localhost:8000 erreichbar.

## Hinweise

- Standard-Login/Registrierung ist über `/login` und `/register` erreichbar.
- Gäste können Beiträge anonym erstellen, eingeloggte Nutzer mit Zuordnung.
- Bilder werden im Ordner `storage/app/public/images` gespeichert.
- Das Projekt nutzt [Tailwind CSS 4](https://tailwindcss.com/docs/installation) und [Laravel Breeze](https://laravel.com/docs/starter-kits).
- Nach dem Klonen und Installieren der Abhängigkeiten (`composer install`, `npm install`) können mit `npm run dev` oder `npm run build` die Assets gebaut werden.
- Für die PHP Konfiguration müssen in der php.ini eventuell folgende Attribute aktiviert werden:
extension=fileinfo, extension=pdo_sqlite