# Membuat Sistem Login Multi User pada Codeigniter 4 menggunakan Library Myth / Auth

Sumber referensi
NGOBAR #26 - Membuat SISTEM LOGIN MULTI USER Pada CODEIGNITER 4 Menggunakan Library Myth / Auth
https://www.youtube.com/watch?v=E5LC4v0_JVE

Instalasi
composer create-project codeigniter4/appstarter ci4_login --no-dev

Package myth-auth
https://github.com/lonnieezell/myth-auth

Template
https://startbootstrap.com/theme/sb-admin-2

update composer.json
"minimum-stability": "beta",
"prefer-stable": true,

Install myth-auth
composer require myth/auth

Tambah halaman login.php, register.php pada folder auth
Tambah halaman index.php pada folder user
Tambah template untuk user dan admin

# Setup Auth

Edit app/Config/Validation.php dan tambahkan ruleSets array: \Myth\Auth\Authentication\Passwords\ValidationRules::class

Ubah file Migration
vendor\myth\auth\src\Database\Migrations
'fullname' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
'user_image' => ['type' => 'varchar', 'constraint' => 255, 'default' => 'default.svg'],

Buat database
ci4_login

Lakukan migrasi
php spark migrate -all

# User Model & Entity

group = tipe user
contoh: admin, user

permissions = hak akses untuk user
contoh: manage-users, manage-profile

Beri default group

# Registration & Login

Buka app/Config/Filters.php
'login' => \Myth\Auth\Filters\LoginFilter::class,
'role' => \Myth\Auth\Filters\RoleFilter::class,
'permission' => \Myth\Auth\Filters\PermissionFilter::class,

Gunakan global
public $globals = [
'before' => [
//'honeypot'
// 'csrf',
'login'
],
'after' => [
'toolbar',
//'honeypot'
],
];

buka vendor\myth\auth\src\Filters\LoginFilter.php
public function before(RequestInterface $request, $arguments = NULL)
public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)

Arahkan login ke view
buka vendor\myth\auth\src\Config\Auth.php
public $views = [
'login' => '\App\Views\Auth\login',
'register' => '\App\Views\Auth\register',
'forgot' => 'Myth\Auth\Views\forgot',
'reset' => 'Myth\Auth\Views\reset',
'emailForgot' => 'Myth\Auth\Views\emails\forgot',
'emailActivation' => 'Myth\Auth\Views\emails\activation',
];

Samakan register pada view auth dengan view register yang kita buat
