<?php 
class clsCategoria extends clsBanco
{
	private $conexao;
	private $cd_categoria;
	private $nm_categoria;

	public function get_cd_categoria() {
		return $this->cd_categoria;
	}
	
    public function set_cd_categoria($cd_categoria) {
		$this->cd_categoria = $cd_categoria;
	}

	public function get_nm_categoria() {
		return $this->nm_categoria;
	}
	
    public function set_nm_categoria($nm_categoria) {
		$this->nm_categoria = $nm_categoria;
	}

    public function __construct($conexao)
	{
		$this->conexao = $conexao;
	}

	public function menuCategoria() {
		$banco = $this->conexao->getBanco();
		$comando = "select * from categoria";
		$resultado = $banco->query($comando);
		$texto = "";
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
                $texto .= "<li id='".$row["cd_categoria"]."'><a href='#'>" . $row["nm_categoria"] . "</a></li>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
		
	}

	public function selectCategoria() {
		$banco = $this->conexao->getBanco();
		$comando = "SELECT * FROM categoria";
		$resultado = $banco->query($comando);
		if($resultado->num_rows > 0) {
			$texto = "<select>";
			while($row = $resultado->fetch_assoc()) {
				$texto .= "<option value=".$row["cd_categoria"].">". $row["nm_categoria"] ."</option>";
			}
			$texto.= "</select>";
            return $texto;
		}
		$this->conexao->Desconectar();
	}

}

?>