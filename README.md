# Web2VazquezAPI

Esta es la documentación de la API que proporciona información sobre las tablas Repuestos y Categoria.

## Rutas Disponibles

### Repuestos

- **Obtener Lista de Repuestos**
  - Método: `GET`
  - Ruta: `/item`
  - Descripción: Obtener una lista de repuestos con opciones de filtrado y paginación.
  - Parámetros de consulta(*informacion adicional en el pie de la documentación*):
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
  
  ## RESPONSE

  -`400` : Bad request  (por uso incorrecto de parametros y consultas sin resultados exitosos);


- **Obtener Repuesto por ID**
  - Método: `GET`
  - Ruta: `/item/:Id`
  - Descripción: Obtener un repuesto por su ID.

## RESPONSE

  -`404` : Error Not Found  (si no existe repuesto por ID proporcionado o parametros incorrectos);


- **Insertar Repuesto**
  - Método: `POST`
  - Ruta: `/item`
  - Descripción: Insertar un nuevo repuesto.
  - Cuerpo de la solicitud: Objeto JSON con detalles del repuesto.

- **Actualizar Repuesto por ID**
  - Método: `PUT`
  - Ruta: `/item/:Id`
  - Descripción: Actualizar un repuesto existente por su ID.
  - Cuerpo de la solicitud: Objeto JSON con detalles actualizados.

- **Eliminar Repuesto por ID**
  - Método: `DELETE`
  - Ruta: `/item/:Id`
  - Descripción: Eliminar un repuesto por su ID.
  
  *Ejemplo:*
  - Ruta: `/item/57`  (eliminara el registro con ID=57)

  ## RESPONSE

  -`200` : Ok  (si el repuesto fue eliminado con exito);
  -`404` : Error Not Found  (si no existe repuesto por ID proporcionado o parametros incorrectos);


### Categorías

- **Obtener Lista de Categorías**
  - Método: `GET`
  - Ruta: `/category`
  - Descripción: Obtener una lista de categorías con opciones de filtrado y paginación.
  - Parámetros de consulta: (mismos que en repuestos)

- **Obtener Categoría por ID**
  - Método: `GET`
  - Ruta: `/category/:Id`
  - Descripción: Obtener una categoría por su ID.

- **Insertar Categoría**
  - Método: `POST`
  - Ruta: `/category`
  - Descripción: Insertar una nueva categoría.
  - Cuerpo de la solicitud: Objeto JSON con detalles de la categoría.

- **Actualizar Categoría por ID**
  - Método: `PUT`
  - Ruta: `/category/:Id`
  - Descripción: Actualizar una categoría existente por su ID.
  - Cuerpo de la solicitud: Objeto JSON con detalles actualizados.

- **Eliminar Categoría por ID**
  - Método: `DELETE`
  - Ruta: `/category/:Id`
  - Descripción: Eliminar una categoría por su ID.
