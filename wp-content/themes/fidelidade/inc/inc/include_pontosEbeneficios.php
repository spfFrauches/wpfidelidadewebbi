<div class="row">
    <div class="col-lg-12">
        
        <?php
            /*
            echo "<pre>";
            var_dump($beneficio[0]) ;
            echo "</pre>";
            */        
        ?>
        
    </div>   
</div>


<div class="row mt-2 mb-5 loadSalvar">
    
    <div class="alert alert-success" role="alert">
        <div class="col-lg-12">  
            <div class="d-flex justify-content-center"> 
                <p>Salvando</p>
            </div>    
        </div>
        <div class="col-lg-12">       
            <div class="d-flex justify-content-center">  
                <br/>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
       
</div>

<div class="row">
    <div class="col-lg-12">
           
        <div class="row formDetalheBeneficio">
            <div class="col-lg-3">
                <img id="previewImg" class="img-thumbnail" width="150" src="<?= $beneficio[0]->imgsrcbeneficio ?>" alt="imagem ilustrativa do beneficio">       
            </div>
            <div class="col-lg-9">
                <label for="formFileSm" class="form-label" style="font-size: 17px">Imagem ilustrativa do brinde / beneficio</label>
                <br/>
                <input class="form-control form-control-sm" id="formFileSm"  type="file" name="imgbeneficio"  onchange="previewFile(this);"  accept="image/*" >
            </div>
        </div>

        <input type="hidden" class="form-control" name="cnpjemp" value="<?= $_SESSION['dados_empresa'][0]->cnpj ?>">

        <input type="hidden" class="form-control idBeneficio"  value="<?= $beneficio[0]->id ?>">
            
        <div class="row mt-5 formDetalheBeneficio">
            <div class="col-lg-6 mt-3">
                <label class="form-label">Descrição do Beneficio</label>
                <input type="text" class="form-control" name="descricaobeneficio" value="<?= $beneficio[0]->descricao ?>" required>
            </div>
            <div class="col-lg-6 mt-3">
                <label class="form-label">Valor em Pontos</label>
                <input type="text" class="form-control dinheiro vlrPontos" name="valorpontos" value="<?= $beneficio[0]->qtdpontos ?>"  required>
            </div>
            <div class="col-lg-6 mt-3">
                <label class="form-label">Data de Validade</label>
                <input type="date" class="form-control" name="dtvalidade" value="<?= $beneficio[0]->dtvalidade ?>" >
            </div>
            <div class="col-lg-6 mt-3">
                <label class="form-label">Status</label>
                <select class="form-select" aria-label=".form-select-sm example" name="status">
                    <option value="ativo" selected>Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>
        </div>

        <div class="row mt-3 formDetalheBeneficio">
            <div class="col-sm-12">
                <label class="form-label">Observação adicional do Beneficio</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="obsadicional" rows="3" required ><?= $beneficio[0]->obsadicional ?></textarea>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-nav-forload updateBeneficio btn-nav-forload" type="submit">Salvar</button>
                </div>
            </div>
        </div>
        
    </div>   
</div>

<script>
    
    $('.dinheiro').mask('#.##0,00', {reverse: true});
    
    $(".loadSalvar").hide();
    
    $(".formDetalheBeneficio").show();
    

    $(".updateBeneficio").on("click", function () { 
        $(".loadSalvar").show();
        $(".formDetalheBeneficio").hide();
        setTimeout(function(){
            $.ajax({ 
            method: "POST",
            url: "../../wp-content/themes/fidelidade/ajax/ajax_update_beneficios.php",
            data: { vlrPts: $(".vlrPontos").val(),  idBeneficio: $('.idBeneficio').val() }
            }).done(function( result ) {
                console.log(result);
                $(".formDetalheBeneficio").show();
                if (result == 'updated'){
                    document.location.reload(true);
                } else {
                   $(".loadSalvar").hide(); 
                   (".formDetalheBeneficio").show();
                }
            });              
        }, 1000);
        
         
    });

</script>


