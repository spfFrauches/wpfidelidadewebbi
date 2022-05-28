<h3>
    <?= $resultadoCadastroCliente[0]->nome_completo; ?>
</h3>
 
CPF.: <?=  $cpf;  ?>
    
<br/><br/>
   
<ol class="list-group ">   
    <li class="list-group-item d-flex justify-content-between align-items-start">   
        <div class="ms-2 me-auto">   
            <div class="fw-bold">Total de Pontos disponiveis.: </div>   
        </div>
        <span class="badge bg-primary rounded-pill"> <?= $totalPontos ?></span>   
    </li>   
</ol> 
  
<p class='mt-2 mb-3' style='font-size:21px'>Detalhes</p>
    
<ol class="list-group list-group-numbered">  
       
    <?php foreach ($resutadoMarcacoes as $key1 => $value1) : ?>
        
    <li class="list-group-item d-flex justify-content-between align-items-start">           
        <div class="ms-2 me-auto">  
                      
            <?php if ($value1->tipomarcacao == 'retirada'): ?>   
                Retirada em.:
                <?= date('d/m/Y H:i:s', strtotime($value1->datamarcacao)) ?>          
            <?php endif; ?>
                
            <?php if ($value1->tipomarcacao != 'retirada'): ?>  
                
                <?php if ($value1->data_expiracao < date("Y-m-d")): ?>           
                    <s>Marcado em.:
                        <?= date('d/m/Y H:i:s', strtotime($value1->datamarcacao)) ?> 
                    </s>
                    <b class="text-danger" style="font-size: 10px">Expirado</b>
                    <s>
                    <div style="font-size: 11px">
                        Valor R$.: <?= $value1->valormarcacao ?> 
                        | Percentual.: 
                        <?= $value1->porcentagemPontos ?> 
                        % para conversão em pontos | 
                        
                    </div> 
                    </s>
                    <div style="font-size: 11px">
                        <?php  if ($value1->data_expiracao > '2099-01-01')  : ?>
                            Não exira
                        <?php  else: ?>
                            Expirado em.: <?= date('d/m/Y', strtotime($value1->datamarcacao)) ?> 
                        <?php  endif; ?>                       
                    </div>
                <?php endif; ?>
                
                <?php if ($value1->data_expiracao >= date("Y-m-d")): ?>           
                    Marcado em.:
                    <?= date('d/m/Y H:i:s', strtotime($value1->datamarcacao)) ?> 
                    <div style="font-size: 11px">
                        Valor R$.: <?= $value1->valormarcacao ?> 
                        | Percentual.: 
                        <?= $value1->porcentagemPontos ?> 
                        % para conversão em pontos   
                    </div>
                    <div style="font-size: 11px">
                        <?php  if ($value1->data_expiracao > '2099-01-01')  : ?>
                            Não exira
                        <?php  else: ?>
                            Expira em.: <?= date('d/m/Y', strtotime($value1->data_expiracao)) ?>
                        <?php  endif; ?>                       
                    </div>
                    <div style="font-size: 13px">
                        <?php if (isset($value1->obs_marcacao)): ?>
                        <span class="badge bg-secondary">
                            <?= "Observação.: {$value1->obs_marcacao}" ?>
                        </span>
                        <?php endif; ?>
                       
                    </div>
                <?php endif; ?>                
            <?php endif; ?>
                      
        </div>
        
        <?php if ($value1->tipomarcacao == 'retirada'): ?> 
            
            <?php if ($value1->estorno == 's'): ?>
                <span class="badge <?= ($value1->tipomarcacao == 'retirada') ? "bg-danger" : "bg-success" ?>  rounded-pill">
                Estorno
                <?= $value1->tipomarcacao ?>
                </span>
            <?php else: ?>
                <span class="badge <?= ($value1->tipomarcacao == 'retirada') ? "bg-danger" : "bg-success" ?>  rounded-pill">
                <?= $value1->pontos  * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) ?>
                <?= $value1->tipomarcacao ?>
                </span>         
            <?php  endif ; ?>
        <?php endif ;?>
        
        <?php if ($value1->tipomarcacao != 'retirada'): ?>  
               
            <?php if ($value1->data_expiracao < date("Y-m-d")): ?>  
                    
                <span class="badge <?= ($value1->tipomarcacao == 'retirada') ? "bg-danger" : "bg-success" ?>  rounded-pill">
                    <s>
                    <?= $value1->pontos  * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) ?>
                    Expirado
                    </s>
                </span>
            <?php endif; ?>
              
        
            <?php if ($value1->data_expiracao >= date("Y-m-d")): ?>    
              
                <?php if ($value1->estorno == 's'): ?>
                    <span class="badge bg-danger rounded-pill">
                        Estornado ( <?= $value1->pontos  * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) ?> )                   
                    </span>
                <?php else: ?>
                    <span class="badge <?= ($value1->tipomarcacao == 'retirada') ? "bg-danger" : "bg-success" ?>  rounded-pill">
                        <?= $value1->pontos  * ($resutadoConfiguracaoEmpresa[0]->vlrSimuladorMoedaApp) ?>                   
                    </span>
                <?php endif; ?>
                            
            <?php endif; ?>
        
        <?php endif ;?>
                      
    </li>   
        
    <?php endforeach; ?>
   
</ol>  

<br/><br/>
    
 
 
