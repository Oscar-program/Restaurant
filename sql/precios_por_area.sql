-- =====================================================================
--  ESTRUCTURA SUGERIDA PARA ALMACENAR LOS PRECIOS POR AREA
--  Base de datos: nuevoestablo
-- =====================================================================
--
--  POR QUE UNA TABLA "LARGA" Y NO COLUMNAS FISICAS (precio_bar, precio_restaurant...)
--  --------------------------------------------------------------------
--  Las areas viven en la tabla `areasestablecimiento` y el usuario las crea
--  y las elimina desde el modulo de configuracion.  Si los precios se
--  guardaran como columnas (precio_bar, precio_restaurant, precio_comedor)
--  habria que ejecutar un ALTER TABLE cada vez que se agrega un area y
--  todos los modelos/vistas quedarian amarrados a nombres fijos.
--
--  La solucion es guardar UNA FILA POR (producto, area) y dejar que la
--  vista de precios "pivotee" esas filas en columnas dinamicas leyendo
--  `areasestablecimiento`.  Asi:
--     * agregar un area nueva = 0 cambios de esquema, la columna aparece sola
--     * el precio del producto se resuelve con un solo LEFT JOIN por el
--       areaEstablecimientoID de la mesa
--     * se conserva la tabla `precioproducto` como PRECIO BASE / respaldo
--       (si el producto no tiene precio en el area, se usa el precio base)
--
-- =====================================================================

CREATE TABLE IF NOT EXISTS `precioproductoarea` (
  `precioAreaID`          INT(11)       NOT NULL AUTO_INCREMENT,
  `productoID`            INT(11)       NOT NULL,
  `areaEstablecimientoID` INT(11)       NOT NULL,
  `precioventa`           DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `proddisponible`        TINYINT(1)    NOT NULL DEFAULT 1  COMMENT '1 = se vende en esta area',
  `fechactualizado`       DATETIME      NULL DEFAULT NULL,
  `usuarioID`             INT(11)       NULL DEFAULT NULL,
  `precioAreaStatus`      TINYINT(1)    NOT NULL DEFAULT 1  COMMENT '1 = activo, 0 = eliminado logico',
  PRIMARY KEY (`precioAreaID`),
  UNIQUE  KEY `uq_precioproductoarea` (`productoID`,`areaEstablecimientoID`),
  KEY `idx_ppa_area`     (`areaEstablecimientoID`),
  KEY `idx_ppa_producto` (`productoID`),
  CONSTRAINT `fk_ppa_producto`
      FOREIGN KEY (`productoID`)            REFERENCES `producto` (`productoID`),
  CONSTRAINT `fk_ppa_area`
      FOREIGN KEY (`areaEstablecimientoID`) REFERENCES `areasestablecimiento` (`areaEstablecimientoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ---------------------------------------------------------------------
--  CARGA INICIAL (opcional)
--  Copia el precio base de `precioproducto` hacia todas las areas activas
--  para que ningun producto quede en 0.00 el primer dia.
-- ---------------------------------------------------------------------
INSERT INTO `precioproductoarea`
       (`productoID`, `areaEstablecimientoID`, `precioventa`, `proddisponible`, `fechactualizado`)
SELECT  pp.productoID,
        ae.areaEstablecimientoID,
        pp.precioventa,
        COALESCE(pp.proddisponible,1),
        NOW()
  FROM  `precioproducto` pp
  INNER JOIN `producto` p
          ON p.productoID = pp.productoID AND p.prodStatus = 1
  CROSS JOIN `areasestablecimiento` ae
  WHERE ae.estado = 1
ON DUPLICATE KEY UPDATE `precioventa` = VALUES(`precioventa`);


-- ---------------------------------------------------------------------
--  CONSULTA DE REFERENCIA: precio de un producto segun el area de la mesa
-- ---------------------------------------------------------------------
-- SELECT  p.productoID,
--         p.prodDescripcion,
--         COALESCE(ppa.precioventa, pp.precioventa) AS precioventa
--   FROM  mesa m
--   INNER JOIN producto      p   ON p.prodStatus = 1
--   INNER JOIN precioproducto pp ON pp.productoID = p.productoID
--   LEFT  JOIN precioproductoarea ppa
--          ON  ppa.productoID            = p.productoID
--          AND ppa.areaEstablecimientoID = m.areaEstablecimientoID
--          AND ppa.precioAreaStatus      = 1
--   WHERE m.mesaID = 1;
