import pandas as pd
import pymysql

datos = pd.read_csv("DatosDFLE.csv")

conexion = pymysql.connect(host='localhost', user='root', password='', db='interfaz_dfle')

cursor = conexion.cursor()
contadorParaVariablesInexistentes = 1
for fila in datos.iterrows():

    unidadAcademica = fila[1]["SELECCIONE DE LA LISTA LA UNIDAD ACADÉMICA"] #
    nombreUsuario = fila[1]["RESPONSABLE DE LA INFORMACIÓN"]  #
    cargoResponsable = fila[1]["CARGO RESP INFO"]  #
    telefonoResponsable = fila[1]["TELEFÓNO RESP INFO"]  #
    correoResponsable = fila[1]["CORREO RESP INFO"] #
    
    cursor.execute("SELECT ID_NombreUsuario FROM Nombre_Usuarios WHERE Desc_Nombre_Usuario = %s", (nombreUsuario))
    id_NombreUsuario = cursor.fetchone()[0]

    id_ContrasenaHash = contadorParaVariablesInexistentes

    id_PalabraAleatoria = contadorParaVariablesInexistentes

    id_EstatusBloqueado = 1

    id_EstatusDeshabilitado = 1

    cursor.execute("SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = %s", (correoResponsable))
    id_CorreoElectronico = cursor.fetchone()[0]
    
    cursor.execute("SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = %s", (unidadAcademica))
    id_UnidadAcademica = cursor.fetchone()[0]

    cursor.execute("SELECT ID_Cargo FROM Cargos WHERE Desc_Cargo = %s", (cargoResponsable))
    id_Cargo = cursor.fetchone()[0]

    cursor.execute("SELECT ID_NumeroTelefono FROM Numero_Telefono WHERE Desc_Numero_Telefono = %s", (telefonoResponsable))
    id_NumeroTelefono = cursor.fetchone()[0]

    id_Rol = 2

    cursor.execute("""INSERT INTO Usuarios_General (id_NombreUsuario, id_ContrasenaHash, id_PalabraAleatoria, id_EstatusBloqueo, id_EstatusDeshabilitado, id_CorreoElectronico, id_UnidadAcademica, id_Cargo, id_NumeroTelefono, id_Rol)
                      VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""",
                   (id_NombreUsuario, id_ContrasenaHash, id_PalabraAleatoria, id_EstatusBloqueado, id_EstatusDeshabilitado, id_CorreoElectronico, id_UnidadAcademica, id_Cargo, id_NumeroTelefono, id_Rol))
    contadorParaVariablesInexistentes += 1

    nombreTitular = fila[1]["TITULAR DE LA UNIDAD RESPONSABLE"]
    cargotitular = fila[1]["CARGO TITULAR CENLEX O CELE"]
    telefonoTitular = fila[1]["TELEFÓNO TITULAR UA"]
    correoTitular = fila[1]["CORREO TITULAR INFO"]

    cursor.execute("SELECT ID_NombreTitular FROM Nombres_Titulares WHERE Desc_Nombre_Titular = %s", (nombreTitular))
    id_NombreTitular = cursor.fetchone()[0]

    id_Cargo = cursor.execute("SELECT ID_Cargo FROM Cargos WHERE Desc_Cargo = %s", (cargotitular))
    id_Cargo = cursor.fetchone()[0]

    cursor.execute("SELECT ID_NumeroTelefono FROM Numero_Telefono WHERE Desc_Numero_Telefono = %s", (telefonoTitular))
    id_NumeroTelefono = cursor.fetchone()[0]

    cursor.execute("SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = %s", (correoTitular))
    id_CorreoElectronico = cursor.fetchone()[0]

    cursor.execute("SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = %s", (unidadAcademica))
    id_UnidadAcademica = cursor.fetchone()[0]

    cursor.execute("""INSERT INTO Titular_Unidad (id_NombreTitular, id_Cargo, id_NumeroTelefono, id_CorreoElectronico, id_UnidadAcademica)
                      VALUES (%s, %s, %s, %s, %s)""",
                   (id_NombreTitular, id_Cargo, id_NumeroTelefono, id_CorreoElectronico, id_UnidadAcademica))

conexion.commit()
conexion.close()

print("Finalizo el programa")
