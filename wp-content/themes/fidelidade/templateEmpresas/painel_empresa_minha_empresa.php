<?php 

/* Template Name: Painel Empresa - Minha Empresa */
$_SESSION['url_referencia'] = '';
get_header('painel'); 
    
include( get_template_directory() . '/models/model_empresa.php' );
$checkImg = 'none';
/* REFATORAR ISSO E COLOCAR DENTRO DE UM MODEL / FUNCAO */
if(!empty($_FILES['logoempresa'])){  
    
    $id = $_POST['codempresa'];
    $targetDir = "./wp-content/themes/fidelidade/uploadfidelidade/empresas_logos/";
    
    /* Renomeando o arquivo com base na data e hora */
    $datahr = date("Y-m-d h:i:s");
    $datahr  = str_replace(" ", "", $datahr);
    $datahr  = str_replace("-", "", $datahr);
    $datahr  = str_replace(":", "", $datahr); 
    $extension = explode(".", $_FILES["logoempresa"]["name"]);
    $renomearArquivo = $datahr.".".$extension[1];
        
    $dir = get_bloginfo('template_url')."/uploadfidelidade/empresas_logos/".basename($_FILES["logoempresa"].$renomearArquivo);
    $target_file = $targetDir . basename($_FILES["logoempresa"].$renomearArquivo); 
    
    /* Uma simples camada de proteção para envio de imagens...*/
    $filename = $_FILES['logoempresa']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);    
    $allowed =  array('gif','png' ,'jpg', 'jpeg');
    
    /*
    Trabalhar em função para redimencionar imagens grandes
    echo "<pre>";
    var_dump($_FILES['logoempresa']);
    echo "</pre>";
    
    echo "<pre>";
    echo "tamanho em bytes.: ";
    var_dump($_FILES['logoempresa']['size']);
    echo "</pre>";
    
    echo "<pre>";
    echo "Tamanho em kb.: ";
    var_dump($_FILES['logoempresa']['size'] / 1024);
    echo "</pre>";
    
    list($width, $height) = getimagesize($filename);
    */
       
    if(!in_array($ext, $allowed) ) :
        $checkImg = 'invalido';
    else:
        $checkImg = 'valido';
        if(move_uploaded_file($_FILES['logoempresa']['tmp_name'], $target_file)){         
            global $wpdb; 
            $wpdb->update('empresas', array('logoempsrc'=>$dir ,'logopath'=>$target_file), array('id'=>$id));
            $msgPosUpload = "Dados atualizados com sucesso!";  
        } else {
            $msgPosUpload = "Erro ao processar arquivo!";
        }
    endif;
    

}

$caminhoImgDefault = get_bloginfo('template_url')."/img/uploadYourLogo.png";  
$dadosEmpresa = buscarEmpresa($_SESSION['dados_empresa'][0]->cnpj);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
    
    <div class="row">            
        <div class="col-lg-12">
            <div class="d-flex justify-content-between flex-wrap flex-lg-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2 class="h2">Minha Empresa <small> dados cadastrais</small></h2>
            </div>      
        </div>
    </div>
    
    <?php if ($checkImg == 'invalido'): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $checkImg ?>
        <strong>Ops! Imagem invalida</strong> <br/>
        A logo enviada parece não ter um formato valido de imagem, envie apenas nos formatos .jpg | .png | .jpeg | .gif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif;?>

    <form class="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
        <br/>     
        <div class="row mt-3">
            <div class="col-lg-3">          
                <img id="previewImg" class="img-thumbnail" width="150" src="<?= ($dadosEmpresa[0]->logoempsrc != null ? $dadosEmpresa[0]->logoempsrc : $caminhoImgDefault )  ?>" alt="Logomarca de sua empresa">
                <script>
                    function previewFile(input){
                        var file = $("input[type=file]").get(0).files[0];
                        if(file){
                            var reader = new FileReader();
                            reader.onload = function(){
                                $("#previewImg").attr("src", reader.result);
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                </script>             
            </div>
            <div class="col-lg-9">
                <label for="formFileSm" class="form-label" style="font-size: 17px">Insira a logo de sua empresa</label>
                <br/>
                <input class="form-control form-control-sm" id="formFileSm"  type="file" name="logoempresa"  onchange="previewFile(this);"  accept="image/*" required>
            </div>
        </div>   
            
        <div class="row mt-5">
            <div class="col-lg-4 mb-3">
                <label>Cód. Emp</label>
                <input type="text" class="form-control" name="codempresa" value="<?= $_SESSION['dados_empresa'][0]->id ?>" readonly>
            </div>
            <div class="col-lg-8 mb-3">
                <label >Razão Social</label>
                <input type="text" class="form-control" value="<?= $_SESSION['dados_empresa'][0]->razao_social ?>" readonly>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-4 mb-3">
                <label>Nome Fantasia</label>
                <input type="text" class="form-control"  value="<?= $_SESSION['dados_empresa'][0]->nome_fantasia ?>"  readonly>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>            
            <div class="col-lg-4 mb-3">
                <label>CNPJ</label>
                <input type="text" class="form-control" value="<?= $_SESSION['dados_empresa'][0]->cnpj ?>" readonly>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <label>Telefone</label>
                <input type="text" class="form-control" readonly value="<?= $_SESSION['dados_empresa'][0]->telefone ?>">
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>            
        </div>

        <br/>
        <div class="row"> 
            <div class="col-lg-4 mb-3">
                <label>Whatsapp / Telegram</label>
                <input type="text" class="form-control"  readonly value="<?= $_SESSION['dados_empresa'][0]->whatsapptelegram ?>">
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <label>Facebook</label>
                <input type="text" class="form-control" readonly value="<?= $_SESSION['dados_empresa'][0]->facebook ?>">
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>          
            <div class="col-lg-4 mb-3">
                <label>Instagram</label>
                <input type="text" class="form-control"  readonly value="<?= $_SESSION['dados_empresa'][0]->instagram ?>">
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>           
        </div>
        
        <hr/>
        <h3><small>Endereço</small></h3>
        <hr/>
        
        <div class="row">
            <div class="col-lg-4 mb-3">
                <label>CEP</label>
                <input type="text" class="form-control" name="cep" value="<?= $_SESSION['dados_empresa'][0]->cep ?>" required readonly="">
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div> 
            <div class="col-lg-4 mb-3">                       
                <div class="form-group">
                    <label>UF</label>
                    <select class="form-control" id="uf" name="uf" required readonly>
                        <option></option>
                        <option value="AC" <?= $_SESSION['dados_empresa'][0]->uf == "AC" ? "selected" : "" ?>>Acre</option>
                        <option value="AL" <?= $_SESSION['dados_empresa'][0]->uf == "AL" ? "selected" : "" ?>>Alagoas</option>
                        <option value="AP" <?= $_SESSION['dados_empresa'][0]->uf == "AP" ? "selected" : "" ?>>Amapá</option>
                        <option value="AM" <?= $_SESSION['dados_empresa'][0]->uf == "AM" ? "selected" : "" ?>>Amazonas</option>
                        <option value="BA" <?= $_SESSION['dados_empresa'][0]->uf == "BA" ? "selected" : "" ?>>Bahia</option>
                        <option value="CE" <?= $_SESSION['dados_empresa'][0]->uf == "CE" ? "selected" : "" ?>>Ceará</option>
                        <option value="DF" <?= $_SESSION['dados_empresa'][0]->uf == "DF" ? "selected" : "" ?>>Distrito Federal</option>
                        <option value="ES" <?= $_SESSION['dados_empresa'][0]->uf == "ES" ? "selected" : "" ?>>Espírito Santo</option>
                        <option value="GO" <?= $_SESSION['dados_empresa'][0]->uf == "GO" ? "selected" : "" ?>>Goiás</option>
                        <option value="MA" <?= $_SESSION['dados_empresa'][0]->uf == "MA" ? "selected" : "" ?>>Maranhão</option>
                        <option value="MT" <?= $_SESSION['dados_empresa'][0]->uf == "MT" ? "selected" : "" ?>>Mato Grosso</option>
                        <option value="MS" <?= $_SESSION['dados_empresa'][0]->uf == "MS" ? "selected" : "" ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?= $_SESSION['dados_empresa'][0]->uf == "MG" ? "selected" : "" ?>>Minas Gerais</option>
                        <option value="PA" <?= $_SESSION['dados_empresa'][0]->uf == "PA" ? "selected" : "" ?>>Pará</option>
                        <option value="PB" <?= $_SESSION['dados_empresa'][0]->uf == "PB" ? "selected" : "" ?>>Paraíba</option>
                        <option value="PR" <?= $_SESSION['dados_empresa'][0]->uf == "PR" ? "selected" : "" ?>>Paraná</option>
                        <option value="PE" <?= $_SESSION['dados_empresa'][0]->uf == "PE" ? "selected" : "" ?>>Pernambuco</option>
                        <option value="PI" <?= $_SESSION['dados_empresa'][0]->uf == "PI" ? "selected" : "" ?>>Piauí</option>
                        <option value="RJ" <?= $_SESSION['dados_empresa'][0]->uf == "RJ" ? "selected" : "" ?>>Rio de Janeiro</option>
                        <option value="RN" <?= $_SESSION['dados_empresa'][0]->uf == "RN" ? "selected" : "" ?>>Rio Grande do Norte</option>
                        <option value="RS" <?= $_SESSION['dados_empresa'][0]->uf == "RS" ? "selected" : "" ?>>Rio Grande do Sul</option>
                        <option value="RO" <?= $_SESSION['dados_empresa'][0]->uf == "RO" ? "selected" : "" ?>>Rondônia</option>
                        <option value="RR" <?= $_SESSION['dados_empresa'][0]->uf == "RR" ? "selected" : "" ?>>Roraima</option>
                        <option value="SC" <?= $_SESSION['dados_empresa'][0]->uf == "SC" ? "selected" : "" ?>>Santa Catarina</option>
                        <option value="SP" <?= $_SESSION['dados_empresa'][0]->uf == "SP" ? "selected" : "" ?>>São Paulo</option>
                        <option value="SE" <?= $_SESSION['dados_empresa'][0]->uf == "SE" ? "selected" : "" ?>>Sergipe</option>
                        <option value="TO" <?= $_SESSION['dados_empresa'][0]->uf == "TO" ? "selected" : "" ?>>Tocantins</option>
                    </select>
                </div>                        
            </div> 
            <div class="col-lg-4 mb-3">
                <label>Cidade</label>
                <input type="text" class="form-control" name="cidade" value="<?= $_SESSION['dados_empresa'][0]->cidade ?>"  required readonly="">
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div>      
        </div>
        
        <div class="row">
                  
            <div class="col-lg-4 mb-3">
                <label>Endereço</label>
                <input type="text" class="form-control" name="endereco" value="<?= $_SESSION['dados_empresa'][0]->endereco ?>"  required readonly="">
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div> 
            <div class="col-lg-4 mb-3">
                <label>Bairro</label>
                <input type="text" class="form-control" value="<?= $_SESSION['dados_empresa'][0]->bairro ?>"  readonly>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div> 
            <div class="col-lg-4 mb-3">
                <label>Número</label>
                <input type="text" class="form-control" value="<?= $_SESSION['dados_empresa'][0]->numero ?>"  readonly>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div> 
        </div>
        
        <div class="row">
            
            <div class="col-lg-12">
                <label>Complemento</label>
                <input type="text" class="form-control"  value="<?= $_SESSION['dados_empresa'][0]->complemento ?>"  readonly>
                <div class="invalid-feedback">
                    Este campo é obrigatório.
                </div>
            </div> 
           
        </div>
              
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btnSalvarMinhaEmpresa" type="submit" >Salvar</button>
                </div>
            </div>
        </div>     
        
    </form>
    <br/>
    
</main>

    
<?php get_footer('painel'); ?>

