SELECT id_exposicion,sum(expoPoint) FROM (
    SELECT id_exposicion, count(*) AS expoPoint FROM favoritosusuarios GROUP BY id_exposicion 
    UNION ALL 
    SELECT id_exposicion, count(*) AS xd FROM comentarios GROUP BY id_exposicion
    ) 
    expoPoints GROUP BY id_exposicion ASC;


-------------------------------------------------
-- TABLA QUE INDICA LA CANTIDAD DE COMENTARIOS--
-------------------------------------------------
SELECT id_exposicion, count(*) AS xd FROM comentarios GROUP BY id_exposicion

---------------------------------------------------------
-- TABLA QUE INDICA LA CANTIDAD DE AÑADIDOS AL FAVORITO--
---------------------------------------------------------
SELECT id_exposicion, count(*) AS xd FROM comentarios GROUP BY id_exposicion

----------------------------------------------------------------------------------
-- UNION DE LOS DATOS EN UNA SOLA COLUMNA PERO DIVIDIDOS POR EL ID DE EXPOSICION--
----------------------------------------------------------------------------------
    SELECT id_exposicion, count(*) AS expoPoint FROM favoritosusuarios GROUP BY id_exposicion 
    UNION ALL 
    SELECT id_exposicion, count(*) AS xd FROM comentarios GROUP BY id_exposicion

-----------------------------------------------------------------------------------------------------------------------------------------
-- LA SUMA DE LOS DATOS ExpoPoints DEPENDIENDO SU ID_EXPOSICION Y DIVIDIRLOS EN DIFERENRES FILAS ORDENADAS DE MAYOR A MENOR Y SOLO 3 --
----------------------------------------------------------------------------------------------------------------------------------------
SELECT id_exposicion,sum(expoPoint) FROM (
    SELECT id_exposicion, count(*) AS expoPoint FROM favoritosusuarios GROUP BY id_exposicion 
    UNION ALL 
    SELECT id_exposicion, count(*) AS xd FROM comentarios GROUP BY id_exposicion
    ) 
expoPoints GROUP BY id_exposicion ORDER BY sum(expoPoint) DESC LIMIT 3;