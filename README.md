# Digimon Proxy API

## Descripción

Este proyecto de Laravel sirve como un proxy API para Digimons, proporcionando un punto de acceso autenticado a una API pública de Digimons. Utiliza un middleware personalizado para verificar tokens de Firebase, permitiendo solo a usuarios autenticados acceder a los datos. La API cuenta con dos endpoints principales:

- `/digimons`: Retorna un listado de todos los Digimons disponibles.
- `/digimons/{id}`: Retorna información detallada de un Digimon específico por su ID.

Antes de enviar la respuesta al cliente, la información recibida de la API pública se procesa en Data Transfer Objects (DTO).

## Tecnologías

- **PHP**: 8.2.12
- **Laravel**: 10.30.1
- **Firebase**: Autenticación basada en tokens

## Requisitos Previos

Para correr este proyecto necesitas tener instalado:

- PHP (versión 8.2.12 o superior)
- Composer - Gestor de dependencias de PHP
- Laravel en su versión 10.30.1

## Instalación

Para empezar, clona el repositorio en tu máquina local:

```
git clone https://github.com/Javiervinus/digimon-blubear-api
```
Después, instala las dependencias con Composer:
```
composer install
```
Configura las variables de entorno necesarias en el archivo .env, especialmente aquellas relacionadas con Firebase y otras configuraciones de tu entorno de desarrollo.

## Ejecución

Para iniciar el servidor de desarrollo de Laravel, ejecuta:

```
php artisan serve
```
Esto pondrá en marcha un servidor local en http://localhost:8000.


## Uso
La API puede ser consumida en producción utilizando la siguiente URL base:

```
https://digimon-blubear-api-cch2afulrq-uc.a.run.app
```
## Autenticacion
Esta API utiliza un middleware que verifica los tokens de Firebase. Deberás incluir un Bearer Token válido en la cabecera Authorization de tu solicitud para interactuar con los endpoints.

## Licencia
Este proyecto está bajo la [licencia MIT](https://opensource.org/licenses/MIT).






