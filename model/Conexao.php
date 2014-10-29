<?php
class Conexao{
	private $instance;

	function __construct(){

	}

	public function getInstance(){
		if (!(isset($this->instance))){
			$this->instance = new PDO("mysql:host=localhost;dbname=carrinho", "root", "");	
		}
		return $this->instance;
	}
}

?>