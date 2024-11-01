SELECT 

Pedido.FechaPedido,
Pedido.Total,
DetallePedido.Cantidad,
DetallePedido.PrecioUnidad,
Producto.Nombre

FROM Pedido

LEFT JOIN DetallePedido 
ON DetallePedido.ID_Pedido = Pedido.ID_Pedido

LEFT JOIN Producto
ON Producto.ID_Producto = DetallePedido.ID_Producto
;