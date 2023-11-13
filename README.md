# web2-TPE-API

# API de Motos

API para gestionar motos y sus distintos modelos.

**Autores:**
- Ignacio Murgolo
- Email: ignaciomurgolo@gmail.com
- Santiago Landi
- Email: slandi1992@gmail.com


## Endpoints

### Listar Motos ordenadas

**Descripción:**
La API `/api/motos` se utiliza para obtener una lista ordenada de motos, permitiendo especificar el campo por el cual se ordena (`sort`) y el tipo de ordenamiento (`order`).

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `sort`: campo por el cual se ordena (puede ser marca, modelo, anio o	precio).
- `order`: tipo de orden (asc o desc)
  
**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene la lista de motos ordenadas según el campo.

---

### Obtener Moto por ID

**Descripción:**
La API `/api/motos/:ID` permite obtener información detallada de una moto específica mediante su `id`.

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `id`: Identificador único de la moto.

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene los datos de la moto correspondiente.

---
### Obtener detalle de Moto por ID

**Descripción:**
La API `/api/motos/:ID/:subrecurso` permite obtener información detallada de un valor específico de una moto mediante su `id`.

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `id`: Identificador único de la moto.
- `subrecurso`: Valor por el que se quiere ver información (puede ser marca, modelo, anio o precio).

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene los datos específicos de un valor de la moto correspondiente.

---

### Filtrar Moto por campo

**Descripción:**
La API `/api/motos/filtrar` permite obtener un listado filtrado de motos mediante algún campo.

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `filtrar`: Nombre usado para usar el filtrado.
- `campo = valor`: Campo por el que se quiere filtrar (puede ser marca, modelo, anio o	precio).

Ejemplo:
http://localhost/web2/PRACTICOS/TPE-API/api/motos/filtrar?marca=honda

**Filtra motos que tengan marca = honda.**

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene el listado de motos filtradas por el campo correspondiente.

---

### Actualizar Moto por ID

**Descripción:**
La API `/api/motos/:ID` posibilita la actualización de una moto mediante su `id`. Se deben proporcionar los nuevos datos en el cuerpo de la solicitud. Primero debe obtener el token de autenticación.

**Método HTTP:** `PUT`

**Parámetros de la Ruta:**
- `id`: Identificador único de la moto.

**Respuestas:**
- `200 OK`: La solicitud de actualización fue exitosa, y la respuesta contiene un listado con las motos actualizado.

---

### Crear una Moto

**Descripción:**
La API `/api/motos` permite crear nuevas motos. Se deben proporcionar los datos en el cuerpo de la solicitud. Primero debe obtener el token de autenticación.

**Método HTTP:** `POST`

**Respuestas:**
- `201 Created`: La solicitud de creación fue exitosa, y la respuesta contiene el listado con las motos actualizado.

---

### Listar Modelos

**Descripción:**
La API `/api/modelos` se utiliza para obtener una lista de modelos, permitiendo especificar el campo por el cual se ordena (`sort`) y el tipo de ordenamiento (`order`).

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `sort`: campo por el cual se ordena (puede ser cilindrada, velocidad, tipo, capacidad).
- `order`: tipo de orden (asc o desc)
  
**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene la lista de modelos ordenados.

---

### Obtener Modelo por modelo

**Descripción:**
La API `/api/modelos/:modelo` permite obtener información detallada de un modelo específico mediante su `modelo`.

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `modelo`: Identificador único del modelo de moto.

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene los datos del modelo correspondiente.

---

### Actualizar Modelo por modelo

**Descripción:**
La API `/api/modelos/:modelo` posibilita la actualización de los datos de un modelo mediante su `modelo`. Se deben proporcionar todos los campos actualizados en el cuerpo de la solicitud.  Primero debe obtener el token de autenticación.

**Método HTTP:** `PUT`

**Parámetros de la Ruta:**
- `modelo`: Identificador único del modelo.

**Respuestas:**
- `200 OK`: La solicitud de actualización fue exitosa, y la respuesta contiene los modelos actualizados.

---

### Crear un Modelo

**Descripción:**
La API `/api/modelo` permite crear nuevos modelos. Se deben proporcionar los datos del modelo en el cuerpo de la solicitud. Primero debe obtener el token de autenticación.

**Método HTTP:** `POST`

**Respuestas:**
- `201 Created`: La solicitud de creación fue exitosa, y la respuesta contiene los modelos actualizados.

---

### Obtener Token de Autenticación

**Descripción:**
La API `/api/auth/token` se utiliza para obtener un token de autenticación. Se deben enviar las credenciales de usuario y contraseña a través de la autorización básica.

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `username`: Nombre de usuario para autenticación básica (webadmin).
- `password`: Contraseña para autenticación básica (admin).

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene el token de autenticación.
  ```json
  {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
