-- ============================================================================
--  Actualizacion del modulo de CONTEO FISICO  (BartioFran)
--  Fecha: 2026-07-04
--  Base de datos: nuevoestablo (MySQL 5.7)
-- ----------------------------------------------------------------------------
--  Este script corrige la formula de la columna calculada `stockf` de la tabla
--  `det_conteofisico` para que represente el CONSUMO del dia de forma coherente
--  con la aplicacion:
--
--      Consumo = (Conteo inicial + Refil) - Conteo final - Averias
--                (tcierreant     + refil) - existenciaF   - aberia
--
--  Antes la columna SUMABA las averias en lugar de restarlas, por lo que no
--  coincidia con el calculo mostrado en pantalla (JavaScript).
--
--  La columna es VIRTUAL (no ocupa almacenamiento), por lo que se puede
--  eliminar y volver a crear sin perdida de datos.
--
--  IMPORTANTE: El modulo NO requiere tablas nuevas. Reutiliza las tablas
--  `conteofisico` (cabecera) y `det_conteofisico` (detalle) ya existentes.
-- ============================================================================

ALTER TABLE `det_conteofisico`
  DROP COLUMN `stockf`,
  ADD COLUMN `stockf` INT(11)
      GENERATED ALWAYS AS (((`tcierreant` + `refil`) - `existenciaF`) - `aberia`) VIRTUAL;

-- Verificacion (opcional):
-- SELECT detConteoID, tcierreant, refil, existenciaF, aberia, stockf
-- FROM det_conteofisico ORDER BY detConteoID DESC LIMIT 10;
