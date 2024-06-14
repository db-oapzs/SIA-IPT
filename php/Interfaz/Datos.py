import pandas as pd
import pymysql

datos = pd.read_csv("DatosDFLE.csv")
idiomas = pd.read_csv("Idiomas.csv")

conexion = pymysql.connect(host='localhost', user='root', password='', db='interfaz_dfle')

cursor = conexion.cursor()

cursor.execute("""INSERT INTO Rol_Dentro_Del_Sistema (Desc_Rol) VALUES (%s)""", 'Rol1')
cursor.execute("""INSERT INTO Rol_Dentro_Del_Sistema (Desc_Rol) VALUES (%s)""", 'Rol2')
cursor.execute("""INSERT INTO Estatus_Bloqueado (Desc_Estatus_Bloqueo) VALUES (%s)""", (1))
cursor.execute("""INSERT INTO Estatus_Bloqueado (Desc_Estatus_Bloqueo) VALUES (%s)""", (0))
cursor.execute("""INSERT INTO Estatus_Deshabilitado (Desc_Estatus_Deshabilitado) VALUES (%s)""", (0))
cursor.execute("""INSERT INTO Estatus_Deshabilitado (Desc_Estatus_Deshabilitado) VALUES (%s)""", (1))

for idioma in idiomas.iterrows():
    cursor.execute("""INSERT INTO Idiomas (Desc_Idioma) VALUES (%s)""", (idioma[1]["Idioma"]))

cursor.execute("""INSERT INTO Niveles_Competencia (Desc_Nivel_De_Competencia) VALUES ('BASICO')""")
cursor.execute("""INSERT INTO Niveles_Competencia (Desc_Nivel_De_Competencia) VALUES ('INTERMEDIO')""")
cursor.execute("""INSERT INTO Niveles_Competencia (Desc_Nivel_De_Competencia) VALUES ('AVANZADO')""")
cursor.execute("""INSERT INTO Niveles_Competencia (Desc_Nivel_De_Competencia) VALUES ('SUPERIOR')""")

cursor.execute("""INSERT INTO Tipo_Poblacion (Desc_TipoPoblacion) VALUES ('Población IPN')""")
cursor.execute("""INSERT INTO Tipo_Poblacion (Desc_TipoPoblacion) VALUES ('Población General')""")

cursor.execute("""INSERT INTO Nivel_Educativo (Desc_NivelEducativo) VALUES ('MEDIO SUPERIOR')""")
cursor.execute("""INSERT INTO Nivel_Educativo (Desc_NivelEducativo) VALUES ('SUPERIOR')""")
cursor.execute("""INSERT INTO Nivel_Educativo (Desc_NivelEducativo) VALUES ('EMPLEADOS')""")
cursor.execute("""INSERT INTO Nivel_Educativo (Desc_NivelEducativo) VALUES ('No aplica')""")
cursor.execute("""INSERT INTO Nivel_Educativo (Desc_NivelEducativo) VALUES ('EGRESADOS')""")
cursor.execute("""INSERT INTO Nivel_Educativo (Desc_NivelEducativo) VALUES ('POSGRADO')""")

for fila in datos.iterrows():
    unidadAcademica = fila[1]["SELECCIONE DE LA LISTA LA UNIDAD ACADÉMICA"] #
    responsableDeLaInformacion = fila[1]["RESPONSABLE DE LA INFORMACIÓN"]  #
    cargoResponsable = fila[1]["CARGO RESP INFO"]  #
    telefonoResponsable = fila[1]["TELEFÓNO RESP INFO"]  #
    correoResponsable = fila[1]["CORREO RESP INFO"] #
    titularUnidad = fila[1]["TITULAR DE LA UNIDAD RESPONSABLE"]
    cargotitular = fila[1]["CARGO TITULAR CENLEX O CELE"]
    telefonoTitular = fila[1]["TELEFÓNO TITULAR UA"]
    correoTitular = fila[1]["CORREO TITULAR INFO"]
    
    cursor.execute("SELECT 1 FROM Cargos WHERE Desc_Cargo = %s", (cargotitular))
    if not cursor.fetchone():  
        cursor.execute("""INSERT INTO Cargos (Desc_Cargo) VALUES (%s)""", (cargotitular))

    cursor.execute("SELECT 1 FROM Cargos WHERE Desc_Cargo = %s", (cargoResponsable))
    if not cursor.fetchone(): 
        cursor.execute("""INSERT INTO Cargos (Desc_Cargo) VALUES (%s)""", (cargoResponsable))
    
    cursor.execute("""INSERT INTO Nombre_Usuarios (Desc_Nombre_Usuario) VALUES (%s)""", (responsableDeLaInformacion))
    cursor.execute("""INSERT INTO Contrasena_Hash (Desc_Contrasena_Hash) VALUES (%s)""", 'AAaa11@@')
    cursor.execute("""INSERT INTO Palabra_Aleatoria (Desc_Palabra_Aleatoria) VALUES (%s)""", 'PalabraAleatoria')
    cursor.execute("""INSERT INTO Correo_Electronico (Desc_Correo_Electronico) VALUES (%s)""", (correoResponsable))
    cursor.execute("""INSERT INTO Unidades_Academicas (Desc_Nombre_Unidad_Academica) VALUES (%s)""", (unidadAcademica))
    cursor.execute("""INSERT INTO Numero_Telefono (Desc_Numero_Telefono) VALUES (%s)""", (telefonoResponsable))
    cursor.execute("""INSERT INTO Nombres_Titulares (Desc_Nombre_Titular) VALUES (%s);""", (titularUnidad))
    cursor.execute("""INSERT INTO Numero_Telefono (Desc_Numero_Telefono) VALUES (%s)""", (telefonoTitular))
    cursor.execute("""INSERT INTO Correo_Electronico (Desc_Correo_Electronico) VALUES (%s)""", (correoTitular))

conexion.commit()    
conexion.close()