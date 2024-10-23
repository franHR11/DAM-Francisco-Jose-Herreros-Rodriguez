class Cliente:                                                                  # Creo una clase
    def __init__(self,nuevonombre,nuevosapellidos,nuevoemail,nuevadireccion):   # Creo un constructor con parametros
        self.nombre = nuevonombre                                               # A las propiedades les paso los parametros del constructor
        self.apellidos = nuevosapellidos
        self.email = nuevoemail
        self.direccion = nuevadireccion
