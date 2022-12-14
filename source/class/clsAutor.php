<?php 
class clsAutor extends clsBanco
{
	private $conexao;
	private $cd_autor;
	private $cd_tipo_usuario;
    private $nm_autor;
    private $ds_autor;
    private $nm_senha_autor;
    private $nm_email_autor;
    private $cd_img_autor;

	public function get_cd_autor() {
		return $this->cd_autor;
	}
	
    public function set_cd_autor($cd_autor) {
		$this->cd_autor = $cd_autor;
	}

    public function get_cd_tipo_usuario() {
		return $this->cd_tipo_usuario;
	}
	
    public function set_cd_tipo_usuario($cd_tipo_usuario) {
		$this->cd_tipo_usuario = $cd_tipo_usuario;
	}

    public function get_nm_autor() {
		return $this->nm_autor;
	}
	
    public function set_nm_autor($nm_autor) {
		$this->nm_autor = $nm_autor;
	}

    public function get_ds_autor() {
		return $this->ds_autor;
	}
	
    public function set_ds_autor($ds_autor) {
		$this->ds_autor = $ds_autor;
	}

    public function get_nm_senha_autor() {
		return $this->nm_senha_autor;
	}
	
    public function set_nm_senha_autor($nm_senha_autor) {
		$this->nm_senha_autor = $nm_senha_autor;
	}

    public function get_nm_email_autor() {
		return $this->nm_email_autor;
	}
	
    public function set_nm_email_autor($nm_email_autor) {
		$this->nm_email_autor = $nm_email_autor;
	}

    public function get_cd_img_autor() {
		return $this->cd_img_autor;
	}
	
    public function set_cd_img_autor($cd_img_autor) {
		$this->cd_img_autor = $cd_img_autor;
	}

    public function __construct($conexao)
	{
		$this->conexao = $conexao;
	}

    public function login($email, $senha) {

        $banco = $this->conexao->getBanco();
        
        
		$comando = "SELECT cd_autor,nm_email_autor,nm_senha_autor FROM autor WHERE ";
        $comando .= "nm_email_autor = '".$email."' and ";
        $comando .= "nm_senha_autor = md5('".$senha."') ";

		if(empty($email)) {
            echo "Digite seu email";
        }
        else if(empty($senha)) {
	 		echo "Digite sua senha";
	 	}
	 	else {
		    $resultado = $banco->query($comando);		
		    if($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
			    $_SESSION["cd_autor"] = $row["cd_autor"];
                echo "login realizado!";
				header("location:homeAutor.php");
		    } else {
            echo "<span>login invalido</span>";
		    }
            $this->conexao->Desconectar();
		}
    }

    public function isLogged($sessao) {
        if($sessao == null) {
            header("location:loginAutor.php");
        }
    }

	public function menuLateral($id) {
		$banco = $this->conexao->getBanco();
		$comando = "SELECT nm_autor,cd_img_autor ";
		$comando .= "FROM autor ";
		$comando .= "WHERE cd_autor = '".$id."'"; 
		$resultado = $banco->query($comando);
		$texto = "";
		if($resultado->num_rows > 0) {
			$row = $resultado->fetch_assoc();
			$caminhoImg = "../../assets/images/" . $row["cd_img_autor"];
			$texto .= '<div class="menuLateral">';
            $texto .= '<div class="topo">';
			$texto .= "<img src='".$caminhoImg."' alt='foto do(a) ".$row["nm_autor"]."'>";
            $texto .= "<div class='nomeAutor'>".$row["nm_autor"]."</div>";
            $texto .= "</div>";
            $texto .= "<div class='listaMenu'>";
            $texto .= "<ul>";
            $texto .= "<li>";
            $texto .= "<a href='homeAutor.php'><i class='fa-solid fa-book'></i>Meus livros</a>";
            $texto .="</li>";
        	$texto .= "<li>";
            $texto .= "<a href='#'><i class='fa-solid fa-user'></i>Minha conta</a>";
            $texto .= "</li>";
        	$texto .= "</ul>";
            $texto .= "</div>";
            $texto .= "<div class='sairLateral'><a href='sair.php'><i class='fa-solid fa-right-from-bracket'></i>Sair</a></div>";
        	$texto .= "</div>";
			return $texto;
		}
		$this->conexao->Desconectar();
	}

	public function selectAutorById($id) {
        $banco = $this->conexao->getBanco();
		$comando = "SELECT nm_autor, ds_autor ";
		$comando .= "FROM autor ";
		$comando .= "WHERE cd_autor = '".$id."'";
		$resultado = $banco->query($comando);
		$texto = "";
		
		if($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
				$caminhoImg = "../../assets/images/" . $row["cd_img_autor"];
				$texto .= "<div class='info-livro'>";
				$texto.= "<img src='".$caminhoImg."' alt='capa do livro ".$row["nm_livro"]."'>";
				$texto .= "</div>";
				$texto .= "<div class='info-livro'>";
				$texto .= "<h1>".$row["nm_autor"]."</h1>";
				$texto .= "<p>".$row["ds_autor"]."</p>";
				$texto .= "</div>";
			}
			return $texto;
		}
		$this->conexao->Desconectar();
    }
}

?>