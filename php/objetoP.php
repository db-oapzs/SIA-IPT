<?php
class usuario{
    public $id_adscripcion;
    public $id_antiguedad;
    public $id_anio;
    public $id_clasif_dependencia;
    public $id_clasificacion;
    public $id_dependencia;
    public $id_desc_clas_dependencia;
    public $id_descpuesto;
    public $id_directivo;
    public $id_edad;
    public $id_escolaridad;
    public $id_hrs;
    public $id_incapemp;
    public $id_nacionalidad;
    public $id_numerohrs;
    public $id_ocupa_mot;
    public $id_puesto;
    public $id_puestotrabajo;
    public $id_pzasasignadas;
    public $id_sexo;
    public $id_spc;
    public $id_tipo_plaza;
    public $id_tpoasignacionplaza;
    public function __construct(
        $id_adscripcion,
        $id_antiguedad,
        $id_anio,
        $id_clasif_dependencia,
        $id_clasificacion,
        $id_dependencia,
        $id_desc_clas_dependencia,
        $id_descpuesto,
        $id_directivo,
        $id_edad,
        $id_escolaridad,
        $id_hrs,
        $id_incapemp,
        $id_nacionalidad,
        $id_numerohrs,
        $id_ocupa_mot,
        $id_puesto,
        $id_puestotrabajo,
        $id_pzasasignadas,
        $id_sexo,
        $id_spc,
        $id_tipo_plaza,
        $id_tpoasignacionplaza
    ){  
        $this->$id_adscripcion = $id_adscripcion;
        $this->$id_antiguedad = $id_antiguedad;
        $this->$id_anio = $id_anio;
        $this->$id_clasif_dependencia = $id_clasif_dependencia;
        $this->$id_clasificacion = $id_clasificacion;
        $this->$id_dependencia = $id_dependencia;
        $this->$id_desc_clas_dependencia = $id_desc_clas_dependencia;
        $this->$id_descpuesto = $id_descpuesto;
        $this->$id_directivo = $id_directivo;
        $this->$id_edad = $id_edad;
        $this->$id_escolaridad = $id_escolaridad;
        $this->$id_hrs = $id_hrs;
        $this->$id_incapemp = $id_incapemp;
        $this->$id_nacionalidad = $id_nacionalidad;
        $this->$id_numerohrs = $id_numerohrs;
        $this->$id_ocupa_mot = $id_ocupa_mot;
        $this->$id_puesto = $id_puesto;
        $this->$id_puestotrabajo = $id_puestotrabajo;
        $this->$id_pzasasignadas = $id_pzasasignadas;
        $this->$id_sexo = $id_sexo;
        $this->$id_spc = $id_spc;
        $this->$id_tipo_plaza = $id_tipo_plaza;
        $this->$id_tpoasignacionplaza = $id_tpoasignacionplaza;
    }
}
?>
