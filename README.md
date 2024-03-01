## Sobre esta API

Esta es un API REST escrita en PHP Laravel, que accede a la API de Giphy.com para hacer búsquedas acotadas y sencillas de archivos GIF.

## Despliegue y ejecución

Esta API se ha dockerizado y se ha generado el respectivo archivo docker en el proyecto mediante 'Sail' para Laravel. Para correrla localmente se necesita:
1. Clonar el repositorio.
2. Instalar las dependencias Composer: `composer install`
3. Instalar Docker Desktop.
3. _En PC Windows_: Correr WSL (Windows Subsytem for Linux).
4. Levantar los contenedores con `./vendor/bin/sail up`. _De aquí en adelante, diré sólo 'sail'._
5. Ejecutar las migraciones de base de datos con `sail artisan migrate`.
6. Instalar Passport con `sail artisan passport:install`. Esto genera las claves de cliente de Passport para autenticación.
7. Generar el archivo `.env` y agregar los datos de usuario de GIPHY, con las constantes `GIPHY_URL` y `GIPHY_APIKEY`. Ver el archivo `.env.example`.
8. La API estará ya disponible en `http://localhost/`.
9. La batería de pruebas se corre con `sail artisan test`.

## Endpoints

- `/api/users/login`: Devuelve un token de autorización mediante datos de usuario registrado.
- `/api/getById`: Devuelve 1 (un) GIF por identificador.
- `/api/getByQuery`: Devuelve una lista de GIFs por palabra clave.
- `/api/save`: Guarda en base de datos el identificador de un GIF para el usuario que consulta (favoritos).

Puedes acceder e importar al archivo JSON de Postman con la lista de endpoints y requests con datos de ejemplo, en este mismo repositorio, en la ubicación `/_docs/Laravel-API-REST.postman_collection`. El request de 'login' almacena el token del response en una variable y será usado con los otros requests de la colección.

**Nota:** Las migraciones generan un usuario de prueba `Prex User`. `email = prexuser@prex.com.ar` - `password = 12345654321`.

## Documentación

**Diagrama de Casos de Uso**<br>
![Casos de Uso](/_docs/DiagramaCasosUso.png "Casos de uso")<br>
**Diagrama de Secuencia**<br>
![Secuencia](/_docs/DiagramaSecuencia.png "Secuencia")<br>
**Diagrama de Entidad Relación**<br>
![Entidad Relación](/_docs/DiagramaEntidadRelacion.png "Entidad Relación")
