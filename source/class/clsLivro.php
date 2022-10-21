<?php 
class clsLivro extends clsBanco
{
	private $conexao;
	private $cd_livro;
    private $cd_autor;
	private $cd_categoria;
	private $nm_livro;
	private $ds_livro;
	private $dt_lancamento;
	private $vl_livro;
	private $cd_img_livro;

	public function get_cd_livro() {
		return $this->cd_livro;
	}
	
    public function set_cd_livro($cd_livro) {
		$this->cd_livro = $cd_livro;
	}

    public function get_cd_autor() {
		return $this->cd_autor;
	}
	
    public function set_cd_autor($cd_autor) {
		$this->cd_autor = $cd_autor;
	}

	public function get_cd_categoria() {
		return $this->cd_categoria;
	}
	
    public function set_cd_categoria($cd_categoria) {
		$this->cd_categoria = $cd_categoria;
	}

    public function get_nm_livro() {
		return $this->nm_livro;
	}
	
    public function set_nm_livro($nm_livro) {
		$this->nm_livro = $nm_livro;
	}

    public function get_ds_livro() {
		return $this->ds_livro;
	}
	
    public function set_ds_livro($ds_livro) {
		$this->ds_livro = $ds_livro;
	}

    public function get_dt_lancamento() {
		return $this->dt_lancamento;
	}
	
    public function set_dt_lancamento($dt_lancamento) {
		$this->dt_lancamento = $dt_lancamento;
	}

    public function get_vl_livro() {
		return $this->vl_livro;
	}
	
    public function set_vl_livro($vl_livro) {
		$this->vl_livro = $vl_livro;
	}

	public function get_cd_img_livro() {
		return $this->cd_img_livro;
	}
	
    public function set_cd_img_livro($cd_img_livro) {
		$this->cd_img_livro = $cd_img_livro;
	}

	public function __construct($conexao)
	{
		$this->conexao = $conexao;
	}

	public function selectLivro() {
		$banco = $this->conexao->getBanco();
		$comando = "select * from livro";
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

    public function selectLivroLast() {
        $banco = $this->conexao->getBanco();
		$comando = "select nm_autor,cd_livro,cd_img_livro,nm_livro,dt_lancamento ";
		$comando .= "from livro join autor on livro.cd_autor = autor.cd_autor ";
		$comando .= "order by dt_lancamento desc limit 4;";
		$resultado = $banco->query($comando);
		$texto = "";
		
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
				$caminhoImg = "../assets/images/" . $row["cd_img_livro"];
                $texto .= "<div class='livro'>";
				$texto .= "<a href='../layout/pages/livro.php?id=".$row["cd_livro"]."'>";
				$texto.= "<img src='".$caminhoImg."' class='class-item-img' alt='capa do livro ".$row["nm_livro"]."'>";
				$texto .= "</a>";
				$texto .= "<div class='tituloLivro'><span>"; 
				$texto .= "<a href='../layout/pages/livro.php?id=".$row["cd_livro"]."'>".$row["nm_livro"]."</a>";
				$texto .= "</span></div>";
				$texto .= "<div class='autorLivro'><span>"; 
				$texto .= "<a href='#'>".$row["nm_autor"]."</a>";
				$texto .= "</span></div></div>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
    }

	public function selectLivroByBusca($busca) {
        $banco = $this->conexao->getBanco();
		$comando = "SELECT nm_autor,cd_livro,cd_img_livro,nm_livro,dt_lancamento FROM ";
		$comando .= "livro join autor on livro.cd_autor = autor.cd_autor where ";
		$comando .= "nm_autor like '%$busca%' or nm_livro like '%$busca%';";
		$resultado = $banco->query($comando);
		$texto = "";
		
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
				$caminhoImg = "../../assets/images/" . $row["cd_img_livro"];
                $texto .= "<div class='livro'>";
				$texto .= "<a href='livro.php?id=".$row["cd_livro"]."'>";
				$texto.= "<img src='".$caminhoImg."' class='class-item-img' alt='capa do livro ".$row["nm_livro"]."'>";
				$texto .= "</a>";
				$texto .= "<div class='tituloLivro'><span>"; 
				$texto .= "<a href='#'>".$row["nm_livro"]."</a>";
				$texto .= "</span></div>";
				$texto .= "<div class='autorLivro'><span>"; 
				$texto .= "<a href='#'>".$row["nm_autor"]."</a>";
				$texto .= "</span></div></div>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
    }

	public function selectLivroByAutor($id) {
        $banco = $this->conexao->getBanco();
		$comando = "SELECT * from livro ";
		$comando .= "WHERE cd_autor = '".$id."'";
		$comando .= "order by dt_lancamento desc";
		$resultado = $banco->query($comando);
		$texto = "";
		
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
				$caminhoImg = "../../assets/images/" . $row["cd_img_livro"];
                $texto .= "<div class='livro'>";
				$texto.= "<img src='".$caminhoImg."' class='class-item-img' alt='capa do livro ".$row["nm_livro"]."'>";
				$texto .= "<div class='tituloLivro'><span>"; 
				$texto .= "<a href='#'>".$row["nm_livro"]."</a>";
				$texto .= "</span></div>";
				$texto .= "<div class='editarLivro'><span>"; 
				$texto .= "<a href='editarLivro.php?id=".$row["cd_livro"]."' class='ed'><i class='fa-solid fa-pen-to-square'></i>Editar</a>";
				$texto .= "</span>";
				$texto .= "<span>"; 
				$texto .= "<a href='excluir.php?id=".$row["cd_livro"]."' class='ex'><i class='fa-solid fa-trash'></i>Excluir</a>";
				$texto .= "</span></div>";
				$texto .= "</div>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
    }

	public function selectLivroById($id) {
        $banco = $this->conexao->getBanco();
		$comando = "SELECT nm_autor,cd_livro,cd_categoria,cd_img_livro,nm_livro,ds_livro,dt_lancamento ";
		$comando .= "FROM livro JOIN autor ON livro.cd_autor = autor.cd_autor ";
		$comando .= "WHERE cd_livro = '".$id."'";
		$resultado = $banco->query($comando);
		$texto = "";
		
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
				$caminhoImg = "../../assets/images/" . $row["cd_img_livro"];
				$texto .= "<div class='info-livro'>";
				$texto.= "<img src='".$caminhoImg."' alt='capa do livro ".$row["nm_livro"]."'>";
				$texto .= "</div>";
				$texto .= "<div class='info-livro'>";
				$texto .= "<h1>".$row["nm_livro"]."</h1>";
				$texto .= "<h2>".$row["nm_autor"]."</h2>";
				$texto .= "<p>".$row["ds_livro"]."</p>";
				$texto .= "</div>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
    }

	public function insertLivro() {
		$banco = $this->conexao->getBanco();
		$comando = "INSERT INTO livro(cd_livro,cd_categoria,cd_autor,nm_livro,ds_livro,dt_lancamento,cd_img_livro) values 
		(
		'".$this->get_cd_livro()."',
		'".$this->get_cd_categoria()."',
		'".$this->get_cd_autor()."',
		'".$this->get_nm_livro()."',
        '".$this->get_ds_livro()."',
        '".$this->get_dt_lancamento()."',
		'".$this->get_cd_img_livro()."'
		)";

		if($banco->query($comando) == true) {
			header("location: homeAutor.php");
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
		$comando .= "cd_categoria = ".$this->get_cd_categoria().", ";
        $comando .= "ds_livro = '".$this->get_ds_livro()."', ";
		$comando .= "dt_lancamento = '".$this->get_dt_lancamento()."', ";
		$comando .= "cd_img_livro = '".$this->get_cd_img_livro()."' ";
		$comando .= "where cd_livro = ".$id."";

		if($banco->query($comando) == true) {
			header("location:homeAutor.php");
		}
		else {
			return mysqli_error($banco) . "<br>" . $comando;
		}
	}

	public function deleteLivro($id) {
		$banco = $this->conexao->getBanco();
		$comando = "delete from livro where ";
		$comando .= "cd_livro = '".$id."'";
		if($banco->query($comando) == true) {
			header("location:homeAutor.php");
		}
	}
}

?>