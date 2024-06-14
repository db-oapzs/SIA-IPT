<?php
class datosTemp{
	public $MediaSuperior_H;
	public $MediaSuperior_M;
	public $idioma;

	public function __construct(
		$MediaSuperior_H,
		$MediaSuperior_M,
		$idioma
	) {

		$this->MediaSuperior_H = $MediaSuperior_H;
		$this->MediaSuperior_M = $MediaSuperior_M;
		$this->idioma = $idioma;
	}
}

?>