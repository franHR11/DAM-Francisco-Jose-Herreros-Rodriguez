-- Siempre es un SELECT
SELECT 
-- Le indico las columnas que necesito ver en pantalla
Cliente.NombreCliente,
Cliente.Correo,
Pedido.FechaPedido,
Pedido.Total,
DetallePedido.Cantidad,
DetallePedido.PrecioUnidad,
Producto.Nombre,
Proveedor.NombreProveedor,
Proveedor.Correo
-- Esta es la tabla inicial (teoricamente la que está más a la derecha)
FROM Pedido
-- A continuación indico los cruces de tabla de derecha a izquierda, atención a las cuerdas en el diseñador
LEFT JOIN DetallePedido 
ON DetallePedido.ID_Pedido = Pedido.ID_Pedido

LEFT JOIN Producto
ON Producto.ID_Producto = DetallePedido.ID_Producto

LEFT JOIN Proveedor
ON Proveedor.ID_Proveedor = Producto.ID_Proveedor

LEFT JOIN Cliente
ON Cliente.ID_Cliente = Pedido.ID_Cliente
-- Adicionalmente indico condiciones como por ejemplo filtrado de pedidos
WHERE Pedido.ID_Pedido = 1
;