<?php

 require_once 'conexao.class.php';
 require_once 'postagem.class.php';
 require_once '../Wideimage/lib/WideImage.php'; //Inclui classe WideImage à página

class PostagemDAO  {
	
    private $conexao;  
	
    public function __construct(){
        $db = Conexao::getInstancia();
        $this->conexao = $db->getConexao();
        
    }
	
				


		
		
	public function gravar(Postagem $postagem){

		$file 		= $_FILES['img'];
		$numFile	= count(array_filter($postagem->imagem['name']));
		//PASTA
		$folder		= '../upload/';
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
		
		if($numFile <= 0)
			echo 'Selecione uma Imagem!';
		else{
			for($i = 0; $i < $numFile; $i++){
				$name 	= $postagem->imagem['name'][$i];
				$type	= $postagem->imagem['type'][$i];
				$size	= $postagem->imagem['size'][$i];
				$error	= $postagem->imagem['error'][$i];
				$tmp	= $postagem->imagem['tmp_name'][$i];
				
				$extensao = @end(explode('.', $name));
                $novoNome = md5(rand()).".$extensao";
				
			if($error != 0)
					$msg[] = "<b>$name :</b> ".$errorMsg[$error];
			else if(!in_array($type, $permite))
					$msg[] = "<b>$name :</b> Erro imagem não suportada!";
			else if($size > $maxSize)
					$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
			else{
                
                
            $foto = WideImage::load($postagem->imagem['tmp_name'][$i]); //Carrega a imagem utilizando a WideImage

            $foto = $foto->resize(750, 400, 'outside'); //Redimensiona a imagem para 170 de largura e 180 de altura, mantendo sua proporção no máximo possível
            $foto = $foto->crop('center', 'center', 750, 400); //Corta a imagem do centro, forçando sua altura e largura

            $foto->saveToFile($folder.$novoNome); //Salva a imagem
                
                
                
				try{
				$sql = "INSERT INTO postagem (titulo, data, descricao, imagem, autor, fk_user)	VALUES (?, ?, ?, ?, ?, ?)";
				$stm = $this->conexao->prepare($sql);
				$stm
				
				->bindValue(1, $postagem->titulo);
				$stm->bindValue(2, $postagem->data);
				$stm->bindValue(3, $postagem->descricao);
				$stm->bindValue(4, $novoNome);
				$stm->bindValue(5, $postagem->autor);
				$stm->bindValue(6, $postagem->fk_user);
				$stm->execute();
				$contar = $stm->rowCount();
				if($contar>0){
				}else{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true" >&times;</span>
							  </button>
							  <div class="container">
							 <strong>nao cadastrou!!!</strong> sua postagem nao cadastrou.
							 </div>
							</div>'; 
				}
			}catch(PDOException $e){
				echo $e;
			}
				
			}
				
			foreach($msg as $pop){
				echo $pop.'<br>';
			}
			}
		}
	}	

    public function findAll($start, $limit) {
		try{
        $sql = "SELECT * FROM postagem ORDER BY id DESC LIMIT ".$start.", ".$limit." ";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();

            foreach($stm as $value){


                
            echo '
            

        <div class="col-lg-4 col-sm-6 col-12 " style="margin-bottom:30px;">
             <img class="card-img-top" src="upload/'.$value["imagem"].'" "  alt="Card image cap">
            <div class="card">
              <div class="card-body" style="height: 300px;">
                <h5 class="card-title">'.mb_strimwidth($value["titulo"],0, 35 , '...' ).'</h5>
                <p class="card-text text-justify">'.mb_strimwidth($value["descricao"],0, 138 , "...").'</p>
                    <div class="card-footer text-muted" style="bottom: 0px;
    position: absolute;
    left: 0; width:100%;">
                      Postado na data '.$value["data"] .' por
                      <a href="perfil/'.$value["fk_user"] .'/'.$value["autor"].'">'.$value["autor"] .'</a>
                      <a style="float:right;" href="ver-postagem/'.$value["id"] .'">ler mais</a>
                    </div>
              </div>
            </div>
          </div>
        
        

            
            ';
            

        }
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
		}
    }
    

    
    public function busca($busca, $start, $limit) {
		try{
        //$sql = "SELECT * FROM postagem WHERE titulo LIKE  '%$busca%'";
        $sql = "SELECT * FROM postagem WHERE titulo LIKE '%$busca%' OR descricao LIKE '%$busca%' ORDER BY id DESC LIMIT ".$start.", ".$limit."";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        if($stm->rowCount() > 0){
            foreach($stm as $value){

            echo '
            
        <div class="col-lg-4 col-sm-6 col-12 " style="margin-bottom:30px;">
             <img class="card-img-top" src="upload/'.$value["imagem"].'" "  alt="Card image cap">
            <div class="card">
              <div class="card-body" style="height: 300px;">
                <h5 class="card-title">'.mb_strimwidth($value["titulo"],0, 35 , '...' ).'</h5>
                <p class="card-text text-justify">'.mb_strimwidth($value["descricao"],0, 138 , "...").'</p>
                    <div class="card-footer text-muted" style="bottom: 0px;
    position: absolute;
    left: 0; width:100%;">
                      Postado na data '.$value["data"] .' por
                      <a href="perfil/'.$value["fk_user"] .'/'.$value["autor"].'">'.$value["autor"] .'</a>
                      <a style="float:right;" href="ver-postagem/'.$value["id"] .'">ler mais</a>
                    </div>
              </div>
            </div>
          </div>
        
        

            
            ';
            }

        }
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }
    
	

	
	public function perfil($fk_user) {
		try{
        //$sql = "SELECT * FROM postagem INNER JOIN login ON  login.idl  = postagem.fk_user  WHERE postagem.fk_user = '$fk_user' ORDER BY postagem.id DESC ";
        $sql = "SELECT * FROM postagem WHERE fk_user = '$fk_user'";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }
	
	
	
	

	
	
	public function idurl($idurl) {
		try{
        $sql = "SELECT * FROM postagem WHERE id = '$idurl' ";
        $stm = $this->conexao->prepare($sql);
		$stm->bindParam(':idurl', $idurl, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }



	
    
	

	public function idpost($idpost) {
		try{
        $sql = "SELECT * FROM postagem WHERE id = '$idpost'";
        $stm = $this->conexao->prepare($sql);
        $stm->bindParam(':idpost', $idpost, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
		}catch(PDOException $e){
			echo 'Erro: '. $e->getMessage();
		}
	}



    public function update(Postagem $postagem){
		if(!empty($_FILES['img']['name'][0])){
					
		$file 		= $_FILES['img'];
		$numFile	= count(array_filter($postagem->imagem['name']));
		//PASTA
		$folder		= '../upload/';
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
				$name 	= $postagem->imagem['name'][$i];
				$type	= $postagem->imagem['type'][$i];
				$size	= $postagem->imagem['size'][$i];
				$error	= $postagem->imagem['error'][$i];
				$tmp	= $postagem->imagem['tmp_name'][$i];
				
				$extensao = @end(explode('.', $name));
                $novoNome = md5(rand()).".$extensao";
				
				if($error != 0)
					$msg[] = "<b>$name :</b> ".$errorMsg[$error];
				else if(!in_array($type, $permite))
					$msg[] = "<b>$name :</b> Erro imagem não suportada!";
				else if($size > $maxSize)
					$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
				else{
					
                    $foto = WideImage::load($postagem->imagem['tmp_name'][$i]); //Carrega a imagem utilizando a WideImage

                    $foto = $foto->resize(750, 400, 'outside'); //Redimensiona a imagem para 170 de largura e 180 de altura, mantendo sua proporção no máximo possível
                    $foto = $foto->crop('center', 'center', 750, 400); //Corta a imagem do centro, forçando sua altura e largura

                    $foto->saveToFile($folder.$novoNome); //Salva a imagem
                    
                    unlink($folder.$postagem->imgantes);
				
				}
				
				foreach($msg as $pop)
				echo '';
					//echo $pop.'<br>';
			}
		}
						
			}// se o input file n estiver vazio
			else{
				$novoNome = $postagem->imgantes;

				}	

			try{
				$sql = "UPDATE postagem SET titulo = :titulo, imagem = :imagem,  descricao = :descricao WHERE id = :idpost";
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(':idpost', $postagem->idpost);
				$stm->bindValue(':titulo', $postagem->titulo);
				$stm->bindValue(':imagem', $novoNome);
				$stm->bindValue(':descricao', $postagem->descricao);
				$stm->execute();
				if($stm->rowCount() > 0){
					echo '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  Atualizado.
					</div>';
				}else{
					echo '<div class="alert alert-danger">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  Não atualizou.
					</div>';	
				}					
			}catch(PDOException $e){
				echo $e;
			}
			}
			
			
		public function excluir($id_delete){
		
		try{
        $sql = "SELECT * FROM postagem WHERE id = '$id_delete'";
        $stm = $this->conexao->prepare($sql);
		$stm->bindParam(':id_delete', $id_delete, PDO::PARAM_INT);
        $stm->execute();
		if($stm->rowCount() > 0){
			
			foreach($stm as $exibir){
				}
			

			//exclui resgistro $sql = "DELETE FROM postagem WHERE id = '$id_delete'";
				try{
					$sql = "DELETE FROM postagem WHERE id = '$id_delete'";
					$stm = $this->conexao->prepare($sql);
					$stm->bindParam(':id_delete', $id_delete, PDO::PARAM_INT);
					$stm->execute();
					if($stm->rowCount() > 0){
						
						
						//exclui imagem da pasta
						$foto = $exibir['imagem'];
						$arquivo = "../upload/" .$foto;
						unlink($arquivo);
						echo '<div class="alert alert-success"  role="alert">
							  <button type="button" class="close" class="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
                              <div class="container">
							<strong>sucesso!</strong> a postagem foi excluida.
                            </div>
							</div>';
					}else{
						echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true" >&times;</span>
							  </button>
                              <div class="container">
							 <strong>Erro!</strong> nao foi possivel excluir.
                             </div>
							</div>';
					}
				}catch(Exception $e){
					echo 'Erro: '. $e->getMessage();
				}
			}
			}catch(Exception $e){
				echo 'Erro: '. $e->getMessage();
			}		
			
		
			}
			
			
			
			
			
			public function gravargif(Postagem $postagem){
			try{
				$sql = 'INSERT INTO gifs (iframe, fk_user) VALUES ( ?, ?)';
				$stm = $this->conexao->prepare($sql);
				//$stm->bindValue(1, $postagem->titulo);
				$stm->bindValue(1, $postagem->iframe);
				$stm->bindValue(2, $postagem->fk_user);
				$stm->execute();
                if($stm->rowCount() > 0){
header("location:gifs");
				}
			}catch (Exception $e){
            echo 'Erro: '. $e->getMessage();
			}
			}
			
public function listargif($pagina, $inicio, $qnt_pagina){
				
				try{
				$sql = "SELECT * FROM gifs ORDER BY id DESC LIMIT $inicio , $qnt_pagina";
				$stm = $this->conexao->prepare($sql);
				$stm->execute();
				if($stm->rowCount() > 0){
					while($mostra = $stm->fetch( PDO::FETCH_ASSOC )){
					//echo "<h2>".$mostra['titulo']."</h2>";
					echo "<div class='embed-responsive embed-responsive-1by0 col-lg-8 col-md-12'>";
					
					echo $mostra['iframe'];
					echo "</div>";
					echo "<br>";
					}	
				}
					
			try{
			$sql = "SELECT COUNT(id) AS num_result FROM gifs";
			$stm = $this->conexao->prepare($sql);
			$stm->execute();
			if($stm->rowCount() > 0){
			$row_pg = $stm->fetch( PDO::FETCH_ASSOC);
			$quantidade_pg = ceil($row_pg['num_result'] / $qnt_pagina );
			$max_links = 2;
			echo " <nav aria-label='Page navigation example'>
				  <ul class='pagination justify-content-center'>
					<li><a class='page-link' href='gifs/pagina/1'>primeira</a> </li>";
			
			for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant ++ ){
				if($pag_ant >= 1){
				echo "<li class='page-item'><a class='page-link' href='gifs/pagina/$pag_ant'>$pag_ant</a></li>";
				}else{
					
				}
			}
			
			echo "<li class='page-item active'>
				  <a class='page-link' href='gifs/pagina/$pagina' >$pagina <span class='sr-only'>(current)</span></a>
				</li>";
				

			
			
			
			
			for($pag_dep = $pagina + 1; $pag_dep <=  $pagina + $max_links; $pag_dep++ ){
				if($pag_dep <= $quantidade_pg ){
				echo "<li class='page-item'><a class='page-link'  href='gifs/pagina/$pag_dep'>$pag_dep</a></li> ";
				}
			}
			
			echo "<li class='page-item'><a class='page-link'  href='gifs/pagina/$quantidade_pg'>ultima</a> </li> </ul></nav>";
		}
		}catch(PDOException $e){
			echo $e;
		}
				}catch(Exception $e){
					echo 'Erro: '. $e->getMessage(); 
				}
			}
			
			
			
			

		

		
	}









	
