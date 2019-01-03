<?php
 require_once 'comentario.class.php';
 require_once 'conexao.class.php';
$comentariodao = new ComentarioDAO();

class ComentarioDAO  {
	
    private $conexao;   

    public function __construct(){
        $db = Conexao::getInstancia();
        $this->conexao = $db->getConexao();
        
    }
    
    
    public function listalert($fk_user) {
		try{
        $sql = "SELECT * FROM comentario WHERE  lido >0 AND dono = '$fk_user'   ";
        //$sql = "SELECT * FROM postagem INNER JOIN comentario ON  comentario.fk_post  = postagem.id  WHERE comentario.fk_user = '$fk_user' AND lido = '1' OR lido= '2' ";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        if($stm->rowCount() > 0){
            foreach($stm as $value){
                            echo '<a class="dropdown-item" href="ver-postagem/'.$value['fk_post'].'"> 
                            
                            <div class="media mb-2" style="width:350px;">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                    <div class="media-body">
                                    <h5 class="mt-0">'.$value['nome'].'</h5>
                                    '.mb_strimwidth($value["comentario"],0, 40 , "...").' <br>              
                                    </div>
                             </div>
                            </a>';
                
                

            }
            

                
        }
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }
    


    

    
    
    public function listarcoment($idurl) {
		try{
        $sql = "SELECT * FROM comentario WHERE resposta = 0 AND fk_post = ? ORDER BY idc DESC";
        $stm = $this->conexao->prepare($sql);
        $stm->bindValue(1, $idurl);
        $stm->execute();
            if($stm->rowCount() > 0){
            foreach($stm as $value){
                $coment = $value['idc'];
                $dono = $value['fk_user'];
                $lido = '2';
            echo '<div class="media mb-4" style="margin-top:10px;">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">'.$value['nome'].'</h5>
              '.$value['comentario'].' <br>
              <a class="resp" style="color:#007bff; cursor:pointer;">responder</a>
              
                <div class="form-group respinput" style="display:none;">
                    <form class="formresp"  method="post">
                    <input type="text" class="form-control" autocomplete="off"  id="respondercoment" name="respondercoment" >
                    <input type="hidden" class="form-control"  id="idc" name="idc" value="'.$coment.'" >
                    <input type="hidden" class="form-control"  id="lido" name="lido" value="'.$lido.'" >
                    <input type="hidden" class="form-control"  id="dono" name="dono" value="'.$dono.'" >
                    <button type="submit">go</button>
                    </form>
                  </div>
            </div>
             </div>';
                 $this->listarrespost($coment, $idurl);
            }}
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }
    
        public  function listarrespost($coment, $idurl) {
		try{
        $sql = "SELECT * FROM comentario WHERE resposta = ?  AND fk_post = ?  ORDER BY idc DESC";
        $stm = $this->conexao->prepare($sql);
        $stm->bindValue(1, $coment);
        $stm->bindValue(2, $idurl);
        $stm->execute();
            if($stm->rowCount() > 0){
            foreach($stm as $value){
            echo '
                <div class="media mt-4" style="margin-left:50px;">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">'.$value['nome'].'</h5>
                  '.$value['comentario'].'
                </div>
              </div>';
            }}
        }catch(Exception $e){
            echo 'Erro: '. $e->getMessage();
            return null;  
		}
    }
    
    
    

	
	public function grava(Comentario $comentario) {
			try{
			 $sql = "INSERT INTO comentario (comentario, nome, fk_user, fk_post, resposta, lido, dono) VALUES (?, ?, ?, ?, ?, ?, ?) ";
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $comentario->comentario);
				$stm->bindValue(2, $comentario->nome);
				$stm->bindValue(3, $comentario->fk_user);
				$stm->bindValue(4, $comentario->fk_post);
				$stm->bindValue(5, $comentario->resposta);
				$stm->bindValue(6, $comentario->lido);
				$stm->bindValue(7, $comentario->dono);
				$stm->execute();
		}catch(PDOException $e){
			echo 'Erro: '. $e->getMessage();
		}
	}
		
	


    
	
    
    
    
	
}


	
