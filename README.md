<h1>LaraStarter</h1>
LaraStarter is Laravel v10 starter template with AdminLTE 3 and Bootstrap 5. 

![image](https://github.com/muhazmi/lara-starter/assets/22718017/a0b50847-0c56-45ca-8344-4cbcec9707c9)
![image](https://github.com/muhazmi/lara-starter/assets/22718017/92cb9b0b-ca65-41a0-b63d-1e9856c686ab)
![image](https://github.com/muhazmi/lara-starter/assets/22718017/0754c01b-53ec-42a2-9c05-54fa7c5222e1)
![image](https://github.com/muhazmi/lara-starter/assets/22718017/4f4d11a1-1b0d-4b58-891f-d966a9fe6b61)
![image](https://github.com/muhazmi/lara-starter/assets/22718017/fc80ce1a-390d-4224-9346-7f764eeddf50)
![image](https://github.com/muhazmi/lara-starter/assets/22718017/c82315bd-9fff-4c23-ba3d-abf139d24fe1)

<h2>Features</h2>
<ul>
    <li>Laravel Breeze (Blade)</li>
    <li>Spatie Permission v6 with multi role</li>
    <li>Indonesian Region by Laravolt include: Province, City, District, Village</li>
    <li>Dashboard Admin: CRUD Post, Category, Tag, User, Navigation, Permission, Role</li>
    <li>Dashboard Author: CRUD Post, Edit Profile</li>
</ul>

<h3>Layout</h3>
Frontend: Bootstrap 5, Backend: AdminLTE 3

<h3>Packages</h3>
<ul>
    <li>Yajra Datatable</li>
    <li>SweetAlert</li>
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
