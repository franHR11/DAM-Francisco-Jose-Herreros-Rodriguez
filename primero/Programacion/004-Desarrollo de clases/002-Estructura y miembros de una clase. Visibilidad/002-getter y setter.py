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
        self.telefono)
    def getNombre(self):
        return self.nombre 
    def setNombre(self,nuevonombre):
        self.nombre = nuevonombre

cliente1 = Cliente("Francisco","Herreros Rodriguez","fran@gmail.com",45644546)
print (cliente1.getNombre())
cliente1.setNombre("Paco")
print (cliente1.getNombre())

