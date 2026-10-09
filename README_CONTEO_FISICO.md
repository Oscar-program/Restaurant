# Módulo de Conteo Físico / Inventario — BartioFran

**Sistema:** CodeIgniter 3 · PHP 8.0/8.2 · MySQL (base `nuevoestablo`)
**Fecha:** 2026-07-04
**Carpeta de trabajo:** `C:\BartioFran` (copia del respaldo `C:\BartioFranBK`)

Este documento describe cómo se **completó** el módulo de inventario por conteo
físico. Se mantuvo la misma semántica y forma de programar del sistema original
(controladores con `$_POST/$_REQUEST`, modelos con Query Builder, respuestas
`json_encode`, vistas con jQuery/AJAX, AdminLTE).

---

## 1. Qué hace el módulo

Registra, por **fecha + turno + bodega**, el conteo físico de cada producto con
cuatro cantidades y una calculada:

| Campo             | Columna BD    | Significado                                            |
|-------------------|---------------|--------------------------------------------------------|
| Conteo inicial    | `tcierreant`  | Existencia al inicio (cierre del turno anterior)       |
| Reabastecimiento  | `refil`       | Entradas / refil durante el turno                      |
| Conteo físico final | `existenciaF` | Lo que realmente hay al cierre (existencia actual)   |
| Averías / mermas  | `aberia`      | Unidades dañadas o perdidas                            |
| **Consumo del día** | `stockf`    | **Calculado** (columna generada, ver fórmula abajo)    |

### Fórmula del "inventario actual"

La petición era: *"la diferencia del conteo físico inicial con el conteo físico
final se tomará como inventario actual"*. Se implementó de forma completa y
coherente para un restaurante:

```
Consumo del día  = (Conteo inicial + Refil) - Conteo físico final - Averías
                 = (tcierreant     + refil) -  existenciaF        - aberia   -> columna stockf

Existencia actual = Conteo físico final (existenciaF)
                    -> lo que queda y pasa a ser el conteo inicial del próximo turno
```

Se muestran **ambos** valores: el **consumo** (la diferencia solicitada) y la
**existencia actual** (lo que físicamente queda).

---

## 2. Decisiones tomadas (supuestos)

Como las preguntas de aclaración quedaron sin responder, se usaron estos
criterios (recomendados) y aquí quedan documentados para ajustarlos si se desea:

1. **Base:** se completó el módulo **ConteoFisico existente** (tablas
   `conteofisico` + `det_conteofisico`), no la tabla plana `inventariodiario`.
   Se conserva el historial ya cargado.
2. **Fórmula:** "inventario actual" = **consumo** `(inicial+refil) − final − averías`
   **y** se guarda/muestra la **existencia final**.
3. **Conteo inicial:** **arrastre automático** del último conteo final del mismo
   producto/bodega (campo "cierre anterior"), con posibilidad de **editarlo a mano**.
4. **Stock del sistema:** el módulo es **independiente**; solo registra y reporta.
   **No** modifica `kardexproducto` ni `inventarioproducto` (sin riesgo para el
   stock existente). Si más adelante se quiere generar el ajuste automático, se
   puede agregar sin cambiar la estructura.

---

## 3. Cambio en la base de datos (OBLIGATORIO)

Ejecutar una sola vez el script:

```
C:\BartioFran\sql\actualizacion_conteofisico.sql
```

Corrige la columna calculada `stockf` de `det_conteofisico` para que reste las
averías (antes las sumaba, y no coincidía con el cálculo de pantalla). La columna
es VIRTUAL, así que no hay pérdida de datos. **No se crean tablas nuevas.**

Desde consola:

```bash
mysql -u USUARIO -p nuevoestablo < C:\BartioFran\sql\actualizacion_conteofisico.sql
```

---

## 4. Cómo se usa

1. Menú lateral → **Inventario → Conteo Físico** (entrada nueva y activa).
2. **Pestaña "Ingreso Conteo":** elegir fecha, turno, bodega y producto.
   - Al elegir producto+bodega, el **conteo inicial se autocompleta** con el
     último cierre; se puede editar.
   - Capturar refil, conteo físico final y averías. El **consumo** se calcula solo.
   - Botón **Agregar / Guardar** añade el producto al conteo (crea la cabecera la
     primera vez y va agregando líneas). Botón **Nuevo** inicia otro conteo.
   - En la tabla derecha se puede **editar** (lápiz) o **eliminar** (papelera) cada línea.
3. **Pestaña "Búsqueda de Conteos":** filtra por rango de fechas; permite
   **cargar** un conteo para seguir editándolo o **anular** un conteo completo.
4. **Pestaña "Inventario Actual":** resumen por producto en un rango de fechas
   (inicial, refil, final, averías, **consumo** y **existencia actual**).

---

## 5. Correcciones realizadas al módulo original

- Botón "Guardar Conteo" estaba **deshabilitado** y llamaba a una función
  inexistente (`saveCompraproducto`). Ahora hay un botón funcional
  (`procesarConteoFisico`) que agrega o actualiza según corresponda.
- Bug al guardar la cabecera: la clave `'fecha '` tenía un **espacio** (no
  guardaba la fecha). Corregido a `'fecha'`.
- **Fórmula inconsistente** entre el JavaScript (restaba averías) y la columna
  generada en BD (las sumaba). Unificada y corregida (ver script SQL).
- Las listas ocultaban filas cuando el cálculo era `<= 0`
  (`if($row->stockf > 0)`); ahora se muestran todas las filas.
- La actualización de un detalle solo guardaba algunos campos; ahora guarda
  `tcierreant`, `refil`, `existenciaF` y `aberia`.
- Validación de turno/bodega en servidor (antes el turno podía guardarse como
  texto "Apertura").
- Mensajes heredados de compras ("Compra procesada") reemplazados por textos
  de conteo.
- Se agregó **arrastre de cierre anterior**, **anulación** de conteos y
  **resumen de inventario actual**.
- El acceso de menú estaba **comentado**; se agregó una entrada activa
  **Inventario → Conteo Físico**.

---

## 6. Archivos

### Reescritos / modificados
- `application/controllers/ConteoFisico_Controller.php`  *(reescrito)*
- `application/models/ConteoFisico_Model.php`  *(reescrito)*
- `application/views/conteofisico/conteoFisico.php`  *(reescrito)*
- `application/views/conteofisico/detConteoFisico.php`  *(reescrito)*
- `application/views/conteofisico/detListaConteo.php`  *(reescrito)*
- `js/conteoFisico.js`  *(reescrito)*
- `application/views/principal.php`  *(se agregó la entrada de menú)*

### Nuevos
- `application/views/conteofisico/resumenInventario.php`  *(reporte de inventario actual)*
- `sql/actualizacion_conteofisico.sql`  *(corrección de la columna `stockf`)*
- `README_CONTEO_FISICO.md`  *(este documento)*

### Tablas de BD reutilizadas (sin crear nuevas)
- `conteofisico` (cabecera) · `det_conteofisico` (detalle)
- Consultadas: `producto`, `bodegaproducto`, `turnooperacion`

---

## 7. Endpoints del controlador

| Método | URL (index.php/ConteoFisico_Controller/…) | Uso |
|---|---|---|
| `capturaConteo` | `/capturaConteo` | Carga la vista principal |
| `insertar_conteo` | `/insertar_conteo` | Guarda cabecera + detalle (POST) |
| `updateDetConteoFisico` | `/updateDetConteoFisico` | Actualiza una línea (POST) |
| `get_listaDetConteo` | `/get_listaDetConteo/{conteoID}` | Detalle de un conteo |
| `get_listaConteo` | `/get_listaConteo` | Búsqueda por fechas (POST) |
| `get_cierreAnterior` | `/get_cierreAnterior` | Último cierre para arrastre (POST) |
| `edit_DetConteoID` | `/edit_DetConteoID/{detConteoID}` | Datos de una línea (JSON) |
| `detDetalleConteoFisico` | `/detDetalleConteoFisico/{detConteoID}` | Elimina una línea |
| `anular_conteo` | `/anular_conteo/{conteoID}` | Anula un conteo completo |
| `resumenInventario` | `/resumenInventario` | Resumen inventario actual (POST) |
