<?php 
class clsLivro extends clsBanco
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

	public function MenuCategoria() {
		$banco = $this->conexao->getBanco();
		$comando = "select * from categoria";
		$resultado = $banco->query($comando);
		$texto = "";
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
                $texto .= "<li id='".$row["cd_categoria"]."'><a>" . $row["nm_categoria"] . "</a></li>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
		
	}

    public function selectLivroLast() {
        $banco = $this->conexao->getBanco();
		$comando = "select * from livro order by dt_lancamento desc limit 3";
		$resultado = $banco->query($comando);
		$texto = "";
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
                $texto .= "<span>" . $row["nm_livro"] . "</span>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
    }

	public function insertLivro() {
		$banco = $this->conexao->getBanco();
		$comando = "insert livro produto values 
		(
		'".$this->get_cd_livro()."',
        '".$this->get_cd_autor()."',
		'".$this->get_nm_livro()."',
        '".$this->get_ds_livro()."',
        '".$this->get_dt_lancamento()."',
        '".$this->get_vl_livro()."',
		'".$this->get_cd_img_livro()."'
		)";

		if($banco->query($comando) == true) {
			return "Cadastrado!";
		}
		else {
			return "Erro!";
		}
		$this->conexao->Desconectar();
		
	}

	public function updateLivro($id) {
		$banco = $this->conexao->getBanco();
		$comando = "update livro set ";
		$comando .= "nm_livro = '".$this->get_nm_livro()."', ";
        $comando .= "ds_livro = '".$this->get_ds_livro()."', ";
		$comando .= "dt_lancamento = '".$this->get_dt_lancamento()."', ";
        $comando .= "vl_livro = '".$this->get_vl_livro()."', ";
		$comando .= "cd_img_livro = '".$this->get_cd_img_livro()."', ";
		$comando .= "where cd_livro = '".$id."'";

		if($banco->query($comando) == true) {
			// header("location:index.php");
		}
		else {
			return "erro";
		}
	}

	public function deleteLivro($id) {
		$banco = $this->conexao->getBanco();
		$comando = "delete from livro where ";
		$comando .= "cd_livro = '".$id."'";
		if($banco->query($comando) == true) {
			header("location:index.php");
		}
	}
}

?>