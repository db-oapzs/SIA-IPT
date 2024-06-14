import pandas as pd
import pymysql

datos = pd.read_csv("DatosNumericos.csv")

conexion = pymysql.connect(host='localhost', user='root', password='', db='interfaz_dfle')

cursor = conexion.cursor()
iteracion = 0

for fila in datos.iterrows():
    Desc_Hombres = fila[1]['HOMBRE ']
    Desc_Mujeres = fila[1]['MUJER']
    UnidadAcademica = fila[1]['UNIDAD ACADEMICA ']
    Competencia = fila[1]['COMPETENCIA']
    Idioma = fila[1]['IDIOMA']
    TipoPoblacion = fila[1]['POBLACION']
    NivelEducativo = fila[1]['NIVEL']

    cursor.execute("SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = %s", (UnidadAcademica))
    id_UnidadAcademica = cursor.fetchone()[0]

    cursor.execute("SELECT ID_Competencia FROM Niveles_Competencia WHERE Desc_Nivel_De_Competencia = %s", (Competencia))
    id_Competencia = cursor.fetchone()[0]

    cursor.execute("SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = %s", (Idioma))
    id_Idioma = cursor.fetchone()[0]

    cursor.execute("SELECT ID_TipoPoblacion FROM Tipo_Poblacion WHERE Desc_TipoPoblacion = %s", (TipoPoblacion))
    id_TipoPoblacion = cursor.fetchone()[0]

    cursor.execute("SELECT ID_NivelEducativo FROM Nivel_Educativo WHERE Desc_NivelEducativo = %s", (NivelEducativo))
    id_NivelEducativo = cursor.fetchone()[0]

    cursor.execute("""INSERT INTO Cantidades_Alumnos (Desc_Hombres, Desc_Mujeres, id_UnidadAcademica, id_Competencia, id_Idioma, id_TipoPoblacion, id_NivelEducativo)
                      VALUES (%s, %s, %s, %s, %s, %s, %s)""",
                   (Desc_Hombres, Desc_Mujeres, id_UnidadAcademica, id_Competencia, id_Idioma, id_TipoPoblacion, id_NivelEducativo))
    print(f"Finalizo la iteracion: {iteracion}")
    iteracion += 1

conexion.commit()
print("Commit ejecutado")
conexion.close()

print("Finalizo el programa")