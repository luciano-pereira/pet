<?php
 require_once 'usuario.class.php';
 require_once 'conexao.class.php';
 require_once '../Wideimage/lib/WideImage.php'; //Inclui classe WideImage à página


class UsuarioDAO  {
	
    private $conexao;   

    public function __construct(){
        $db = Conexao::getInstancia();
        $this->conexao = $db->getConexao();
        
    }
    
    
	
	
	

	public function grava(Usuario $usuario){
		try{
			 $sql = "SELECT * FROM login WHERE email = ? ";
		     $stm = $this->conexao->prepare($sql);
			 $stm->bindValue(1, $usuario->email);
			 $stm->execute();
			if($stm->rowCount() > 0){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true" >&times;</span>
							  </button>
                              <div class="container">
							 Ja existe um usuario cadastrado com este email.
                             </div>
							</div>'; 
			}else{
				$sql = 'INSERT INTO login (nome, email, senha, cidade, facebook, instagram, telefone,  bio, foto, nivel)'. 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,?)';
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $usuario->nome);
				$stm->bindValue(2, $usuario->email);
				$stm->bindValue(3, $usuario->senha);
				$stm->bindValue(4, $usuario->cidade);
				$stm->bindValue(5, $usuario->facebook);
				$stm->bindValue(6, $usuario->instagram);
				$stm->bindValue(7, $usuario->telefone);
				$stm->bindValue(8, $usuario->bio);
				$stm->bindValue(9, $usuario->foto);
				$stm->bindValue(10, $usuario->nivel);
				$stm->execute();
				if($stm->rowCount() > 0){
					echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true" >&times;</span>
								  </button>
								  <div class="container">
								 Contra criada.
								 </div>
						 </div>'; 
						 
				}
			}
			
        }catch (Exception $e){
            echo 'Erro: '. $e->getMessage();
        }
    }
    
    
    public function perfil($fk_user) {
		try{
        $sql = "SELECT * FROM login WHERE idl = '$fk_user'";
        //$sql = "SELECT * FROM postagem INNER JOIN login ON  login.idl  = postagem.fk_user  WHERE login.idl = '$fk_user' ";
        
        $stm = $this->conexao->prepare($sql);
        //$stm->bindParam(':idl', $fk_user, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }
    
    
    public function selecionadadouser($id) {
		try{
        $sql = "SELECT * FROM login WHERE idl = '$id'";
        //$sql = "SELECT * FROM postagem INNER JOIN login ON  login.idl  = postagem.fk_user  WHERE login.idl = '$fk_user' ";
        
        $stm = $this->conexao->prepare($sql);
        //$stm->bindParam(':idl', $fk_user, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }
    
    
    
    
    
    
    
    
    
    
    public function update(Usuario $usuario){
		if(!empty($_FILES['img']['name'][0])){
					
		$file 		= $_FILES['img'];
		$numFile	= count(array_filter($usuario->imagem['name']));
		//PASTA
		$folder		= '../fotoperfil/';
		//REQUISITOS
		$permite 	= array('image/jpeg', 'image/png');
		$maxSize	= 1024 * 1024 * 5;
		//MENSAGENS
		$msg		= array();
		$errorMsg	= array(
			1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
			2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
			3 => 'o upload do arquivo foi feito parcialmente',
			4 => 'Não foi feito o upload do arquivo'
		);
		
		if($numFile <= 0){
			/*echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Selecione uma imagem e tente novamente!
					</div>';*/
		}
		else if($numFile >=2){
			echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Você ultrapassou o limite de upload. Selecione apenas uma foto e tente novamente!
					</div>';
		}else{
			for($i = 0; $i < $numFile; $i++){
				$name 	= $usuario->imagem['name'][$i];
				$type	= $usuario->imagem['type'][$i];
				$size	= $usuario->imagem['size'][$i];
				$error	= $usuario->imagem['error'][$i];
				$tmp	= $usuario->imagem['tmp_name'][$i];
				
				$extensao = @end(explode('.', $name));
                $novoNome = md5(rand()).".$extensao";
				
				if($error != 0)
					$msg[] = "<b>$name :</b> ".$errorMsg[$error];
				else if(!in_array($type, $permite))
					$msg[] = "<b>$name :</b> Erro imagem não suportada!";
				else if($size > $maxSize)
					$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
				else{
					
                    $foto = WideImage::load($usuario->imagem['tmp_name'][$i]); //Carrega a imagem utilizando a WideImage

                    $foto = $foto->resize(500, 500, 'outside'); //Redimensiona a imagem para 170 de largura e 180 de altura, mantendo sua proporção no máximo possível
                    $foto = $foto->crop('center', 'center', 500, 500); //Corta a imagem do centro, forçando sua altura e largura

                    $foto->saveToFile($folder.$novoNome); //Salva a imagem
                    
                    if($usuario->imgantes != "perfil.png"){
                    unlink($folder.$usuario->imgantes);
                    }
				
				}
				
				foreach($msg as $pop)
				echo '';
					//echo $pop.'<br>';
			}
		}
						
			}// se o input file n estiver vazio
			else{
				$novoNome = $usuario->imgantes;

				}	

			try{
				$sql = "UPDATE login SET nome = :nome, email = :email, cidade = :cidade, facebook = :facebook, instagram = :instagram, telefone = :telefone,  bio = :bio, foto = :foto WHERE idl = :idl";
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(':idl', $usuario->idl);
				$stm->bindValue(':nome', $usuario->nome);
				$stm->bindValue(':email', $usuario->email);
				$stm->bindValue(':cidade', $usuario->cidade);
				$stm->bindValue(':facebook', $usuario->facebook);
				$stm->bindValue(':instagram', $usuario->instagram);
				$stm->bindValue(':telefone', $usuario->telefone);
				$stm->bindValue(':bio', $usuario->bio);
                $stm->bindValue(':foto', $novoNome);
				$stm->execute();
				if($stm->rowCount() > 0){
					echo '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  atualizado.
					</div>';
				}else{
					echo '<div class="alert alert-danger">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  não atualizou.
					</div>';	
				}			
			}catch(PDOException $e){
				echo $e;
			}
			}
    
    	


	
	public function selectuserlogado(Usuario $usuario) {
			try{
			 $sql = "SELECT * FROM login WHERE email = :emaillogado";
		     $stm = $this->conexao->prepare($sql);
			 $stm->bindValue(':emaillogado', $usuario->emaillogado);
			 $stm->execute();
			 $contar = $stm->rowCount();
			if($contar>0){
				$loop = $stm->fetchAll();
				foreach($loop as $show){
					 $_SESSION['iduser'] = $show['idl'];
					 $_SESSION['nome'] = $show['nome'];
					 $_SESSION['nivel'] = $show['nivel'];
				}
			}			
		}catch(PDOException $e){
			echo 'Erro: '. $e->getMessage();
		}
	}
		

	
	
	
	public function logar(Usuario $usuario) {
			try{
			 $sql = "SELECT * FROM login WHERE BINARY email = :email AND BINARY senha = :senha";
			 $stm = $this->conexao->prepare($sql);
			 $stm->bindValue(':email', $usuario->email);
			 $stm->bindValue(':senha', $usuario->senha);
			 $stm->execute();
			 if($stm->rowCount() > 0){
					$_SESSION['session_email'] = $usuario->email;
					$_SESSION['session_senha'] = $usuario->senha;
					header("location: inicio");
			}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true" >&times;</span>
							  </button>
                              <div class="container">
							 email ou senha invalidos
                             </div>
							</div>'; 
			}
		}catch(PDOException $e){
			echo $e;
		}
	}



	public static function deslogar(){
		session_unset(['session_email']);
		session_unset(['session_senha']);
		session_destroy();
		header('Location: http://localhost/pet/home');
	}
	
}


	
