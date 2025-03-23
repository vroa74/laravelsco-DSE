#pricipio
este proyecto se instalo con laravel new.
las opciones de este proyecto fue instalado con jetestream, livewire, modo dark y con bases de datos en mysql

##componentes adicionales instalados:
Hasta el momento se ha instalado **laravel-dompdf**

##comando para instalacion po medio de composer
**composer require barryvdh/laravel-dompdf**
##publicar la configuracion
<span style="color:blue">**php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"**</span>
# <span style="color:red">07-01-2025 13:20 hrs.</span>
##instalacion de laravel snappy para la creacion de reportes pdf
###comando de instalacion:
composer require barryvdh/laravel-snappy
### para publicar la configuracion escribe
<span style="color:green">php artisan vendor:publish --provider="Barryvdh\Snappy\ServiceProvider"</span>

#instalacion de wireui
comando de instalacion de wireui
composer require wireui/wireui

publicas configuraciones
-php artisan vendor:publish --tag="wireui.lang"
-php artisan vendor:publish --tag="wireui.config"

instalacion de flowbite

-npm install flowbite
