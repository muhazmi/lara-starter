<h1>LaraStarter</h1>
LaraStarter is Laravel starter template with AdminLTE 3 and Bootstrap 5. 

<h2>Features</h2>
<ul>
    <li>CRUD Post, Category, Tag, User</li>
    <li>Spatie Permission v6</li>
</ul>

<h3>Layout</h3>
Frontend: Bootstrap 5, Backend: AdminLTE 3

<h3>Package</h3>
<ul>
    <li>Select2</li>
    <li>Bootstrap Datepicker</li>
    <li>Fontawesome 6</li>
</ul>

Or you can see all package that i've used in this repo from plugins in public > assets folder and composer.json file. But the plugins and packages are not all used, so you can see the actual one from layouts > app.blade.php and script.blade.php.

<h2>How to Install</h2>
<ul>
    <li>Make sure you are connected to internet and PHP 8.1 installed.</li>
    <li>Open your terminal / cmd / powershell to this project and run these commands:
        <ul>
            <li>composer install / composer update</li>
            <li>cp .env.example .env</li>
            <li>php artisan migrate</li>
            <li>php artisan db:seed</li>
        </ul>
    </li>
    <li>Setup SMTP Mail Credential (optional)
        <ul>
            <li>MAIL_MAILER=</li>
            <li>MAIL_HOST=</li>
            <li>MAIL_PORT=</li>
            <li>MAIL_USERNAME=</li>
            <li>MAIL_PASSWORD=</li>
            <li>MAIL_ENCRYPTION=</li>
            <li>MAIL_FROM_ADDRESS=""</li>
        </ul>
    </li>
</ul>

<h2>User Login Credential</h2>
<ul>
    <li>Admin: email and password; amperakoding@gmail.com</li>
    <li>Author: email and password; muhazmi@gmail.com</li>
</ul>

Do you have another suggestions? Star, fork, and create PR for this repo. Let's make this repo better!

<h2>Wanna Work with Me?</h2>
Let's talk: <a href="mailto: mail@muhazmi.my.id">mail@muhazmi.my.id</a>
