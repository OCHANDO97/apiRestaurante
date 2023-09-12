API REST de Restaurante
Esta es una API REST diseñada para gestionar los datos de un restaurante, incluyendo información sobre platos, facturas,mesas. 


Características principales
basicamente es una apiRest que tiene autenficacion, que para que se use para movil, ya que dispone para los camareros puedan obtener informacion de las mesas, con sus respectivo plato, facturas de pago, la cantidad de mesas disponibles etc


Instalación
Clona este repositorio en tu máquina local.
Configura las variables de entorno en el archivo .env con la información de tu base de datos y otros detalles de configuración.

A continuación se detallan los endpoints principales de la API:

Usuarios:
POST localhost/apiRestaurante/public/api/register
POST localhost/apiRestaurante/public/api/login
GET localhost/apiRestaurante/public/api/logout

Productos:
GET localhost/apiRestaurante/public/api/listarProductoCategorias/{id}

Categorias:
GET localhost/apiRestaurante/public/api/showCategorias

Mesas:
GET localhost/apiRestaurante/public/api/showMesas
GET localhost/apiRestaurante/public/api/showDisponibilidad
PUT localhost/apiRestaurante/public/api/editaDisponibilidad/{id}

Facturas:
GET localhost/apiRestaurante/public/api/showFacturas
GET localhost/apiRestaurante/public/api/buscarFactura/{id}
POST localhost/apiRestaurante/public/api/addFacturaMesa
POST localhost/apiRestaurante/public/api/addProductoMesa

Contribuciones
Las contribuciones son bienvenidas. Si encuentras algún problema o tienes alguna sugerencia de mejora, puedes abrir un issue en este repositorio.



