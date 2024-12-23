# Checador de Horas para Becarios

Este proyecto es una aplicación web para registrar y gestionar las horas de entrada y salida de los becarios. Utiliza PHP para la lógica del servidor y MySQL para la base de datos.

## Estructura del Proyecto

- `conexion.php`: Archivo de conexión a la base de datos.
- `editar_registro.php`: Script para editar registros existentes.
- `index.html`: Página principal para registrar las horas de entrada y salida.
- `insertar_registro.php`: Script para insertar nuevos registros de horas.
- `obtener_registros.php`: Script para obtener los registros de horas.
- `registros.php`: Página para visualizar y editar los registros de horas.
- `resumen_becarios.php`: Script para obtener el resumen de horas por becario.

## Requisitos

- XAMPP o cualquier servidor web con soporte para PHP y MySQL.
- Navegador web moderno.

## Instalación

1. Clona este repositorio en el directorio raíz de tu servidor web (por ejemplo, `htdocs` en XAMPP).
2. Crea una base de datos en MySQL llamada `horas_becarios`.
3. Importa el archivo `schema.sql` (si existe) en la base de datos para crear las tablas necesarias.
4. Asegúrate de que las credenciales de la base de datos en `conexion.php` sean correctas.

## Uso

1. Abre `index.html` en tu navegador para registrar las horas de entrada y salida de los becarios.
2. Abre `registros.php` para visualizar y editar los registros de horas.

## Archivos

### [index.html](index.html)

Página principal para registrar las horas de entrada y salida de los becarios.

### [obtener_registros.php](obtener_registros.php)

Script para obtener los registros de horas desde la base de datos.

### [editar_registro.php](editar_registro.php)

Script para editar registros existentes en la base de datos.

### [registros.php](registros.php)

Página para visualizar y editar los registros de horas.

### [conexion.php](conexion.php)

Archivo de conexión a la base de datos.

### [insertar_registro.php](insertar_registro.php)

Script para insertar nuevos registros de horas en la base de datos.

### [resumen_becarios.php](resumen_becarios.php)

Script para obtener el resumen de horas por becario.

## Créditos

Este proyecto fue desarrollado para gestionar y registrar las horas de entrada y salida de los becarios.