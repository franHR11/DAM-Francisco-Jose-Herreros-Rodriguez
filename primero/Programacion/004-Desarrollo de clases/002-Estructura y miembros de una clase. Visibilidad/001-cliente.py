class Cliente:
    def __init__(self,nuevonombre,nuevoapellido,nuevoemail,nuevotelefono):
        self.nombre = nuevonombre
        self.apellidos = nuevoapellido
        self.email = nuevoemail
        self.telefono = nuevotelefono

    def dameDatos(self):
        print(
        "- Nombre:",
        self.nombre,
        "- Apellidos:",
        self.apellidos,
        "- Email:",
        self.email,
        "- Telefono",
        self.telefono,
    )

cliente1 = Cliente("Francisco","Herreros Rodriguez","fran@gmail.com",45644546)
print (cliente1.nombre)
cliente1.nombre = "Francisco Jose"
print (cliente1.nombre)
