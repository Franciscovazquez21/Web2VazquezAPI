# Web2VazquezAPI

Esta es la documentación de la API que proporciona información sobre los repuestos y categorías.

## Rutas Disponibles

### Repuestos

- **Obtener Lista de Repuestos**
  - Método: `GET`
  - Ruta: `/item`
  - Descripción: Obtener una lista de repuestos con opciones de filtrado y paginación.
  - Parámetros de consulta:
    - `filter`: Filtrar por columna
    - `value`: Valor para la operación de filtro
    - `operation`: Operación de filtro (opcional)
    - `sort`: Ordenar por columna
    - `order`: Orden de clasificación (ASC o DESC)
    - `limit`: Número de elementos por página
    - `offset`: Número de página

- **Obtener Repuesto por ID**
  - Método: `GET`
  - Ruta: `/item/:Id`
  - Descripción: Obtener un repuesto por su ID.

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
