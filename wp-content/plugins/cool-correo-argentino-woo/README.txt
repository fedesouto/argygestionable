=== Cool Correo Argentino - WooCommerce ===
Contributors: matiasanca
Tags: correoargentino, woocommerce, shipments
Requires at least: 5.4.1
Tested up to: 5.9.3
Requires PHP: 7.0
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Método de Envío de WooCommerce para Correo Argentino.

== Description ==
Calculadora de Envíos para Correo Argentino
Envío a Sucursales y a Domicilio
Actualización Manual y Automática de Costos
Opciones: Envío Gratuito | Recargo | Descuento | Costo Fijo
Generación de archivo CSV Lote para importar en Correo Argentino
Solicitud DNI en Checkout
Se incorpora el cálculo por Peso y Peso Volumétrico

https://vimeo.com/734714417


Tarifario de precios:

[Responsable Inscriptos](https://www.correoargentino.com.ar/MiCorreo/public/files/lista-de-precios-PY-MiCorreo.pdf)
[Consumidor Final](https://www.correoargentino.com.ar/MiCorreo/public/files/lista-de-precios-CF-MiCorreo.pdf)


Documentación -> Configuración
[Manual.pdf](https://manca.com.ar/wp-content/uploads/2022/05/Cool-Correo-Argentino-Manual-v1.0.0.pdf)


== Changelog ==
= 1.0 =
First release

= 1.0.3 =
Add Shipping Meta Data "Branch Description"

= 1.0.4 =
Add Default Weight

= 1.0.5 =
Fix field Cod. Área Cellphone

= 1.1.0 =
Add Price by Volume

= 1.1.1 =
Fix error "divisionByZero"
Add error for product dimentions required

== Next Changes ==
* Incorporar la utilización de un API KEY para obtener los costos automáticamente
* Agregar costo empaquetado
* Mejorar Documentación
* Validar que se seleccione la sucursal cuando se elige a sucursales
* En el Export, sanitizar en javascript: Es importante que el sistema que usted utilice para generar el archivo, lo genere con codificación UTF-8.
No son aceptados caracteres como: ñ, acentos y caracteres especiales (Ej: # $ % etc.)
* Cambiar el nombre del export files
* En el Export, mejorar la visualización de la grilla. Marcar en Amarillo los "conflictivos", y en verde los agregados / modificados.
* Cron para actualizar precios y demás