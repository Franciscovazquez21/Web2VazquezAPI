# Web2VazquezAPI

Esta es la documentación de la API que proporciona información sobre las tablas Repuestos y Categoria.


## Rutas Disponibles

### Repuestos

- **Obtener Lista de Repuestos**
  - Método: `GET`
  - Ruta: `/item`
  - Descripción: Obtener una lista de repuestos con opciones de filtrado y paginación.
  - Parámetros de consulta(*informacion adicional al inicio de la documentación*):
    - `filter`: Filtrar por columna
    - `value`: Valor para la operación de filtro
    - `operation`: Operación de filtro (opcional)
    - `sort`: Ordenar por columna
    - `order`: Orden de clasificación (ASC o DESC)
    - `limit`: Número de elementos por página
    - `offset`: Número de página

    *Ejemplo:*
  - Ruta: `/item/`  (devuelve el listado completo)
  - Ruta: `/item/?filter=precio&value=55100`  (devuelve listado segun parametros)
    ```json
    {
        "idProducto": 60,
        "idCodigoProducto": 5681222,
        "nombreProducto": "disco freno",
        "precio": 55100,
        "marca": "Fiat",
        "imagenProducto": "img/frenos.jpg",
        "IdCategoria": 5,
        "categoria": "frenos"
    }
  ```
  **RESPONSE**

  -`400` : Bad request  (por uso incorrecto de parametros y consultas sin resultados exitosos)


- **Obtener Repuesto por ID**
  - Método: `GET`
  - Ruta: `/item/:Id`
  - Descripción: Obtener un repuesto por su ID.

  *Ejemplo:*
  - Ruta: `/item/57`  (obtendra el registro con ID=57)

  **RESPONSE**

  -`404` : Error Not Found  (si no existe repuesto por ID proporcionado o parametros incorrectos)


- **Insertar Repuesto**
  - Método: `POST`
  - Ruta: `/item`
  - Descripción: Insertar un nuevo repuesto.
  - Cuerpo de la solicitud: Objeto JSON con detalles del repuesto.

  *Ejemplo:*
  - Ruta: `/item/`
  
    ```json
    {
        "idCodigoProducto": 123,
        "nombreProducto": "string",
        "precio": 123,
        "marca": "string",
        "imagenProducto": "string",
        "IdCategoria": 5
    }
  ```
  **RESPONSE**

  -`404` : Error Not found (Campos incompletos, categoria invalida, excepcion en consulta)
  -`201` : Created (item creado exitosamente)

- **Actualizar Repuesto por ID**
  - Método: `PUT`
  - Ruta: `/item/:Id`
  - Descripción: Actualizar un repuesto existente por su ID.
  - Cuerpo de la solicitud: Objeto JSON con detalles actualizados.

    *Ejemplo:*
  - Ruta: `/item/:Id`
  
    ```json
    {
        "idProducto": 79,
        "idCodigoProducto": 321,
        "nombreProducto": "string",
        "precio": 321,
        "marca": "string",
        "imagenProducto": "imagenEjemplo",
        "IdCategoria": 5,
        "categoria": "frenos"
    }
  ```
  **RESPONSE**

  -`200` : Ok (item modificado exitosamente)
  -`404` : Error Not found (Campos incompletos,no se puede moficar categoria invalida, excepcion en consulta)

- **Eliminar Repuesto por ID**
  - Método: `DELETE`
  - Ruta: `/item/:Id`
  - Descripción: Eliminar un repuesto por su ID.
  
  *Ejemplo:*
  - Ruta: `/item/57`  (eliminara el registro con ID=57)

  **RESPONSE**

  -`200` : Ok  (si el repuesto fue eliminado con exito);
  -`404` : Error Not Found  (si no existe repuesto por ID proporcionado o parametros incorrectos);


### Categorías

- **Obtener Lista de Categorías**
  - Método: `GET`
  - Ruta: `/category`
  - Descripción: Obtener una lista de categorías con opciones de filtrado y paginación.
  - Parámetros de consulta(*informacion adicional en el inicio de la documentación*):
    - `filter`: Filtrar por columna
    - `value`: Valor para la operación de filtro
    - `operation`: Operación de filtro (opcional)
    - `sort`: Ordenar por columna
    - `order`: Orden de clasificación (ASC o DESC)
    - `limit`: Número de elementos por página
    - `offset`: Número de página

    *Ejemplo:*
  - Ruta: `/category/`  (devuelve el listado completo)
  - Ruta: `category/?filter=idCategoria&value=33&operation=<`  (devuelve listado segun parametros)
    
    ```json
    {
        "idCategoria": 2,
        "categoria": "Interior",
        "material": "plastico",
        "origen": "China",
        "motor": "no aplica",
        "imagenCategoria": "img/interior.jpg"
    }
    ```
  **RESPONSE**

  -`400` : Bad request  (por uso incorrecto de parametros y consultas sin resultados exitosos);


- **Obtener Categoría por ID**
  - Método: `GET`
  - Ruta: `/category/:Id`
  - Descripción: Obtener una categoría por su ID.
  
   **RESPONSE**

  -`404` : Error Not Found  (si no existe categoria por ID proporcionado o parametros incorrectos);


- **Insertar Categoría**
  - Método: `POST`
  - Ruta: `/category`
  - Descripción: Insertar una nueva categoría.
  - Cuerpo de la solicitud: Objeto JSON con detalles de la categoría.
  *Ejemplo:*
  - Ruta: `/category/`
  
    ```json
    {
        "categoria": "frenos",
        "material": "fundicion",
        "origen": "China",
        "motor": "nafta-diesel",
        "imagenCategoria": "imagen"
    }
  ```
  **RESPONSE**

  -`404` : Error Not found (Campos incompletos, categoria invalida, excepcion en consulta)
  -`201` : Created (item creado exitosamente)


- **Actualizar Categoría por ID**
  - Método: `PUT`
  - Ruta: `/category/:Id`
  - Descripción: Actualizar una categoría existente por su ID.
  - Cuerpo de la solicitud: Objeto JSON con detalles actualizados.
    *Ejemplo:*
  - Ruta: `/category/:Id`
  
    ```json
    {
        "idCategoria": 5,
        "material": "asbesto",
        "origen": "China",
        "motor": "nafta-diesel",
        "imagenCategoria": "imagen"
    }
  ```
  **RESPONSE**

  -`200` : Ok (categoria modificada exitosamente)
  -`404` : Error Not found (Campos incompletos,no se puede moficar categoria invalida, excepcion en consulta)

- **Eliminar Categoría por ID**
  - Método: `DELETE`
  - Ruta: `/category/:Id`
  - Descripción: Eliminar una categoría por su ID.
    
  *Ejemplo:*
  - Ruta: `/category/57`  (eliminara el registro con ID=57)

  **RESPONSE**

  -`200` : Ok  (si la categoria fue eliminada con exito);
  -`404` : Error Not Found  (si no existe categlria por ID proporcionado o parametros incorrectos);

  # Parametros de Consulta

  ### Filtros

- **`filter`**: Permite filtrar los resultados basados en un campo específico.
  
  Ejemplo: `/item/?filter=precio&value=55100`

### Ordenamiento

- **`sort`**: Permite ordenar los resultados según un campo específico.
- **`order`**: Especifica el orden de clasificación, ya sea ascendente (`asc`) o descendente (`desc`).

  Ejemplo: `/item/?sort=nombreProducto&order=asc`

### Paginación

- **`limit`**: Limita la cantidad de resultados devueltos por la API.
- **`offset`**: Especifica el número de resultados a omitir antes de comenzar a devolver datos.

  Ejemplo: `/item/?limit=10&offset=20`

## Ejemplos de Uso

### Obtener el listado completo de items

Ruta: `/item/`

### Filtrar items por precio

Ruta: `/item/?filter=precio&value=55100`

```json
{
    "idProducto": 60,
    "idCodigoProducto": 5681222,
    "nombreProducto": "disco freno",
    "precio": 55100,
    "marca": "Fiat",
    "imagenProducto": "img/frenos.jpg",
    "IdCategoria": 5,
    "categoria": "frenos"
}
