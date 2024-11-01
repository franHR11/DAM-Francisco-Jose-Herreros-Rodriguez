SELECT *
FROM Pedido
LEFT JOIN DetallePedido 
ON DetallePedido.ID_Pedido = Pedido.ID_Pedido
;