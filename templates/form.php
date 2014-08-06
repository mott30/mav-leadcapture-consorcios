<!-- FORM TEMPLATE -->
<form action="#mlc_results" method="post">
   <div class="well">
      <div class="row">
         <div class="col-sm-6">
            <div class="col-sm-6">
               
               <label>Seu nome</label>
               <input type="text" class="form-control" name="lead_name">
               <br />
               
               <label>E-mail</label>
               <input type="text" class="form-control" name="lead_email">
               <br />

            </div>
            <div class="col-sm-6">
               
               <label>Seu telefone</label>
               <input type="text" class="form-control" name="lead_phone">
               <br />

               <label>Cidade</label>
               <input type="text" class="form-control" name="lead_city">
               <br />

            </div>
         </div>
         <div class="col-sm-6">
            <div class="col-sm-6">
               
               <label>Tipo de consórcio</label>
                <select class="form-control" name="simulacao_cat">
                 <option value="imoveis">Imóveis</option>
                 <option value="motos">Motos</option>
                 <option value="automoveis">Automóveis / Caminhões</option>
               </select>
               <br />

               <?php
                  $consorcioField = 'credito';
                  if( $consorcioField == 'credito'){
                     $selectedParcela = "";
                     $selectedCredito = "selected";
                  }else{
                     $selectedParcela = "selected";
                     $selectedCredito = "";
                  }
               ?>

               <label>Tipo de simulação</label>
                <select class="form-control" name="simulacao_tipo" id="consorcioField">
                 <option value="parcela" <?php echo $selectedParcela ?> >Parcela</option>
                 <option value="credito" <?php echo $selectedCredito ?> >Crédito</option>
               </select>
               <br />

            </div>
            <div class="col-sm-6">
               
               <div class="consorcioRangeParcelaContainer">
                  <center><strong>Valor da Parcela</strong></center>
                  <?php
   
                     $consorcioRangeMin = "10";       // Valor Mínimo
                     $consorcioRangeMax = "1000";  // Valor Máximo
   
                  ?>
                  <i><small>R$</small> <strong class="consorcioRangeParcelaMin"><?php echo $consorcioRangeMin ?></strong></i>
                  <i style="float:right;"><small>R$</small> <strong class="consorcioRangeParcelaMax"><?php echo $consorcioRangeMax ?></strong></i><br />
                  <input id="consorcioRangeParcela" name="consorcioRangeParcela" type="text" class="inputSlider" value="<?php echo $consorcioRangeMin ?>,<?php echo $consorcioRangeMax ?>" data-slider-min="10" data-slider-max="1000" data-slider-step="10" data-slider-value="[<?php echo $consorcioRangeMin ?>,<?php echo $consorcioRangeMax ?>]"/>
                  <br />
               </div>
               <div class="consorcioRangeCreditoContainer">
                  <center><strong>Valor do Crédito</strong></center>
                  
                  <i><small>R$</small> <strong class="consorcioRangeCreditoMin"><?php echo $consorcioRangeMin ?></strong></i>
                  <i style="float:right;"><small>R$</small> <strong class="consorcioRangeCreditoMax"><?php echo $consorcioRangeMax ?></strong></i><br />
                  <input id="consorcioRangeCredito" name="consorcioRangeCredito" type="text" class="inputSlider" value="<?php echo $consorcioRangeMin ?>,<?php echo $consorcioRangeMax ?>" data-slider-min="10" data-slider-max="1000" data-slider-step="10" data-slider-value="[<?php echo $consorcioRangeMin ?>,<?php echo $consorcioRangeMax ?>]"/>
                  <br />
                 </div>
               
               <label>&nbsp;</label>
               <label>&nbsp;</label>
               <input type="submit" class="btn btn-success btn-lg btn-block formSubmit" value="Simular">
               <br />

            </div>
         </div>
      </div>
   </div>
</form>



<script>
jQuery(document).ready(function($){

    // Info PopOver
    $(".info").popover({ trigger: "hover" });

   // Range Parcela
    $("#consorcioRangeParcela").slider({
      tooltip: "hide"
   }).on("slide", function(e){
      var valueMin = e.value[0];
      var valueMax = e.value[1];
      
      //console.log(value.value[0]);

      $(".consorcioRangeParcelaMin").html(valueMin);
      $(".consorcioRangeParcelaMax").html(valueMax);
   });

   // Range Credito
   $("#consorcioRangeCredito").slider({
      tooltip: "hide"
   }).on("slide", function(e){
      var valueMin = e.value[0];
      var valueMax = e.value[1];
      
      //console.log(value.value[0]);

      $(".consorcioRangeCreditoMin").html(valueMin);
      $(".consorcioRangeCreditoMax").html(valueMax);
   });

   
   
   if( $("#consorcioField") == "parcela"){
      $(".consorcioRangeParcelaContainer").show(0);
   }else{
      $(".consorcioRangeCreditoContainer").show(0);
   }

   $("#consorcioField").on("change", function(){            
      $(".consorcioRangeCreditoContainer, .consorcioRangeParcelaContainer").toggle(0);
   });


});
</script>

<style>
.slider.slider-horizontal {
   width: 97% !important;
   margin: 0 auto;
   display: block;
   height: 18px;
}
.btn.formSubmit{
   display: inline-block;
   margin-bottom: 0;
   font-weight: 400;
   text-align: center;
   vertical-align: middle;
   cursor: pointer;
   background-image: none;
   border: 1px solid transparent;
   white-space: nowrap;
   padding: 6px 12px;
   font-size: 14px;
   line-height: 1.42857143;
   border-radius: 4px;
   -webkit-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
}
.btn-success {
   color: #fff;
   background-color: #5cb85c;
   border-color: #4cae4c;
}

/* INICIAR OCULTO  */
.consorcioRangeParcelaContainer,
.consorcioRangeCreditoContainer,
#wp-consorcio__TaxasParcelaIntegralDefault-wrap,
.consorcio_TaxasMeiaParcelaDefault,
.consorcio_TaxasParcelaIntegralPrazoReduzidoDefault,
.consorcio_TaxasMeiaParcelaPrazoReduzidoDefault
{
   display: none;
}

</style>