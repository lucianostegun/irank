<?php
	$isLogged = true;
	
	if( MyTools::isAuthenticated() )
		include_partial('home/component/resume');
	else
		include_partial('home/component/welcome');
?>
<div style="display: none">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" id="homeResumeDiv" class="<?php echo ($isLogged?'':'welcome_bg') ?>">
    
		<?php
			
		?>
		    
    </td>
  </tr>
  <tr>
    <td height="22" align="left" valign="top">
    
    
    
    
    
    
    
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 20px">
              <tr>
                <td width="13" align="left" valign="top" class="gray_border">
                <img src="/images/frontend/layout/spacer.gif" alt="" width="13" height="1" /></td>
                <td width="353" align="left" valign="top" style="padding-right:12px">
	                <table width="100%" border="0" cellspacing="0" cellpadding="0">
	                  <tr>
	                    <td align="left" valign="top">
	                    	<img src="/images/frontend/layout/bullet2.png" alt="" width="38" height="25" />
	                    	<img src="/images/frontend/layout/mainFeatures.gif" alt="" width="272" height="25" /></td>
	
	                  </tr>
	                  <tr>
	                    <td height="15" align="left" valign="top"></td>
	                  </tr>
	                  <tr>
	                    <td align="left" valign="top">
		                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		                      <tr>
		                        <td width="122" height="105" align="left" valign="top">
		                        <img src="/images/frontend/layout/stats.jpg" alt="" width="111" height="86" /></td>
		                        <td align="left" valign="top"><p style="font-weight: bold">Estatísticas</p>
		
		                          <p>Após as realizações de seus jogos é possível obter um relatório com o total gasto, total ganho, balanço e desempenho dos jogadores</p>
		                          </td>
		                      </tr>
		                      <tr>
		                        <td width="122" align="left" valign="top">
		                        <img src="/images/frontend/layout/event.jpg" alt="" width="111" height="96" /></td>
		                        <td align="left" valign="top"><p style="font-weight: bold">Notificação/Alerta de eventos</p>
		
		                          <p>Notificação instantânea da criação/edição dos eventos a todos os jogadores do ranking e lembrete dos jogos agendados.</p>
		                          </td>
		                      </tr>
			                  <tr>
			                    <td height="15" align="left" valign="top"></td>
			                  </tr>
		                    </table>
	                    </td>
	                  </tr>
	                </table>
                </td>
                <td width="289" align="left" valign="top" style="padding-left:16px;" class="gray_border">
	                <table width="100%" border="0" cellspacing="0" cellpadding="0">
	                  <tr>
	                    <td align="left" valign="top"><img src="/images/frontend/layout/bullet2.png" alt="" width="38" height="25" />
	                    <img src="/images/frontend/layout/news.gif" alt="" height="25" /></td>
	                  </tr>
	                  <tr>
	                    <td height="15" align="left" valign="top"></td>
	                  </tr>
	                  <tr>
	                    <td width="254" align="left" valign="top" >
		                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		                      <tr>
		                        <td width="121" align="left" valign="top" class="">
	
	
	
		                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		                      <!-- Begin 
		                      <tr>
		                        <td width="122" height="105" align="left" valign="top">
		                        <img src="/images/frontend/news/multiClassify.jpg" alt="" width="111" height="86" style="border: 1px solid #999999" /></td>
		                        <td align="left" valign="top"><p style="font-weight: bold">Critérios de desempate</p>
		
		                          <p>Agora além da classificação principal é possível definir os critérios de desempate entre os jogadores com os resultados empatados.</p>
		                          </td>
		                      </tr>
		                      -->
		                      
		                      <tr>
		                        <td width="122" height="105" align="left" valign="top">
		                        <img src="/images/frontend/news/photo.png" alt="" width="111" height="86" /></td>
		                        <td align="left" valign="top"><p style="font-weight: bold"><?php echo link_to('Mural de fotos', '/photoWall') ?></p>
		
		                          <p>Agora você pode compartilhar os melhores momentos dos eventos postando suas fotos em nosso mural.</p>
		                          </td>
		                      </tr>
		                      
		                      <tr>
		                        <td width="122" height="105" align="left" valign="top">
		                        <img src="/images/frontend/layout/rankingHistory.jpg" alt="" width="111" height="96" /></td>
		                        <td align="left" valign="top"><p style="font-weight: bold">Histórico de classificação</p>
		
		                          <p>Histórico de posições, total gasto, total de prêmios, eventos, balanço e todas as informações em todas as datas que houveram eventos.</p>
		                          </td>
		                      </tr>
		                    </table>	                        
		                        
		                        
		                        
		                        </td>
		                      </tr>
		                    </table>
	                    </td>
	                  </tr>
	                </table>
	             </td>
              </tr>
            </table>
    
    
    
    
    
    
    </td>
  </tr>
</table>
</div>