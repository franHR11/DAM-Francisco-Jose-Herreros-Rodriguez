SELECT 
Pedido.FechaPedido,
Pedido.Total,
DetallePedido.Cantidad,
DetallePedido.PrecioUnidad
FROM Pedido
LEFT JOIN DetallePedido 
ON DetallePedido.ID_Pedido = Pedido.ID_Pedido
;