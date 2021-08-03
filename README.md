<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requirement

- [Composer](https://getcomposer.org/).
- [Node JS](https://nodejs.org/en/) (Optional).
- Code editor for doing coding activities [Visual Studio Code](https://code.visualstudio.com/) or [Sublime](https://www.sublimetext.com/) or [Atom](https://atom.io/).
- Php and Web server for running laravel in web browser, can use [XAMPP](https://www.apachefriends.org/) or [Laragon](https://laragon.org/).
- Database Management System.

Because it uses Laravel migrations feature it can use any type of DBMS as long as it's a Relational Database.

## Getting Started

1. Clone repository with the command `git clone https://github.com/rdp77/veyaz.git`
2. Installing package form Composer with command `composer install`
3. Installing package module node js with command `node install` (Optional)
4. Running web application using commands `php artisan serve` or running manually with web server.

Copy the `.env.example` file then change the name to `.env`, then adjust the settings with the database you want to connect to so that it is connected to the desired database, like the example below.

```
DB_CONNECTION=mysql //Driver Database
DB_HOST=127.0.0.1 //Host
DB_PORT=3306 //Port
DB_DATABASE=database //Name Database
DB_USERNAME=root //Username
DB_PASSWORD= //Password
```
If the key in .env is empty run this command to generate a key `php artisan key:generate` Run the migrations database to import all databases using the command `php artisan migrate:refresh --seed`

Login using username `admin` and password `admin`

## Third-party Library
- [jQuery](https://github.com/jquery/jquery)
- [Moment](https://github.com/moment/moment/)
- [Popper](https://github.com/popperjs/popper-core)
- [DataTables](https://github.com/DataTables/DataTables)
- [Nicescroll](https://github.com/inuyaksa/jquery.nicescroll)
- [Sweet Alert](https://github.com/t4t5/sweetalert)
- [iziToast](https://github.com/marcelodolza/iziToast)
- [Dropzone](https://github.com/dropzone/dropzone)
- [NProgress](https://github.com/rstacruz/nprogress)
- [Material Floating Button](https://github.com/nobitagit/material-floating-button)
- [Date Range Picker](https://github.com/dangrossman/daterangepicker)
- [Select2](https://github.com/select2/select2)
- [Chocolat](https://github.com/nicolas-t/Chocolat)
- [Bootstrap Tag Input](https://github.com/bootstrap-tagsinput/bootstrap-tagsinput)
- [Summernote](https://github.com/summernote/summernote/)
- [Chart](https://github.com/chartjs/Chart.js)
- [Cleave](https://github.com/nosir/cleave.js)
- [Laravel Mix](https://github.com/JeffreyWay/laravel-mix)
- [Laravel Page Speed](https://github.com/renatomarinho/laravel-page-speed)
- [Laravel Jetstream](https://github.com/laravel/jetstream)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [Barcode Generator](https://github.com/milon/barcode)

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct) or veyaz [Code of Conduct](https://github.com/rdp77/veyaz/blob/master/CODE_OF_CONDUCT.md).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT), and veyaz under the [GPL-3.0](https://github.com/rdp77/veyaz/blob/master/LICENSE)
