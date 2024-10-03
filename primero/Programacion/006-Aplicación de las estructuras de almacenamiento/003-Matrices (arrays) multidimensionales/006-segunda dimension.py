agenda = [
        ['Francisco Jose','Herreros','info@pcprogramacion.es','5643656'],
        ['Juan','Lopez','juan@pcprogramacion.com','347437'],
    ]
print(agenda)

for registro in agenda:
    print("####################################")
    print("Tu nombre es:",registro[0])
    print("Tu apellido es:",registro[1])
    print("Tu email es:",registro[2])
    print("Tu telefono es:",registro[3])