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

cliente1 = Cliente("Jose Vicente","Ferrary","ferrary@gmail.com",45644546)
cliente2 = Cliente("Fernando","Morente","Morente@gmail.com",645644546)
cliente1.dameDatos()
cliente2.dameDatos()
