<?php
   
   class MLC_Simulador
   {

      public function __construct(){
         
         add_shortcode( 'simulador', array( $this, 'init'));

      }



      public function init($value='')
      {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {         
            /**
             *    POST == SIMULAÇÃO REALIZADA
             *    Pegar dados no server...
             */               
            $data = MLC_Connector::getData(); // Recebe os dados

            if( is_array( $data ) ){
               return self::showResults( $data, RESULTS_STYLE ); // Monta os resultados na tabela   
            }else{
               MLC_Debugger::debugThis( $data );
            }
         }else{
            return self::showForm(); 
         }
      }
         

      /**
       * showForm
       * @param  string $style [description]
       * @return [type]        [description]
       */
      public function showForm($style='')
      {
         // SHOW THE FORM
         $styleForm = ( $style == '1' )? 'form.php' : 'form.php';
         include(  plugin_dir_path( __FILE__ ) . 'templates/'.$styleForm );       
      }

         
      /**
       * showResults
       * @return Retorna uam tabela popoulada com os resultados da simulação.
       */
      public function showResults(Array $data, $style = '1')
      {
         if( isset($data) and !empty($data) ){
            $output = '<h2><a name="mlc_results">Resultado da simulação</a></h2>';

            switch ($style) {
               case '1':
                  $output .= '<div class="table-responsive">';
                     $output .= '<table class="table table-striped table-hover">
                                  <tr>
                                      <th>
                                          Crédito
                                      </th>
                                      <th>
                                          Prazo
                                      </th>
                                      <th>
                                          ¹/² Parcela
                                      </th>
                                      <th>
                                          Parcela Integral
                                      </th>
                                      <th>
                                          Prazo Reduzido
                                      </th>
                                      <th>
                                          ¹/² Parcela
                                      </th>
                                      <th>
                                          Parcela Integral
                                      </th>
                                  </tr>';

                        MLC_Debugger::debugThis( $_POST );


                        if( @$_POST['simulacao_tipo'] == 'credito' ){
                           $simulacaoRange   = explode(',',$_POST['consorcioRangeCredito']);                           
                        }else{
                           $simulacaoRange   = explode(',',$_POST['consorcioRangeParcela']);
                        }
                        $simulacaoMin       = $simulacaoRange[0];
                        $simulacaoMax       = $simulacaoRange[1];


                     foreach ($data as $value) {

                        // Formatação condicional
                        if( $value['mlc_credito'] >= $simulacaoMin AND $value['mlc_credito'] <= $simulacaoMax ){
                           $value['class_mlc_credito'] = 'success';
                        }
                        if( $value['mlc_prazo1_meiaparcela'] >= $simulacaoMin AND $value['mlc_prazo1_meiaparcela'] <= $simulacaoMax ){
                           $value['class_mlc_prazo1_meiaparcela'] = 'success';
                        }
                        if( $value['mlc_prazo1_parcela'] >= $simulacaoMin AND $value['mlc_prazo1_parcela'] <= $simulacaoMax ){
                           $value['class_mlc_prazo1_parcela'] = 'success';
                        }
                        if( $value['mlc_prazo2_meiaparcela'] >= $simulacaoMin AND $value['mlc_prazo2_meiaparcela'] <= $simulacaoMax ){
                           $value['class_mlc_prazo2_meiaparcela'] = 'success';
                        }
                        if( $value['mlc_prazo2_parcela'] >= $simulacaoMin AND $value['mlc_prazo2_parcela'] <= $simulacaoMax ){
                           $value['class_mlc_prazo2_parcela'] = 'success';
                        }
                        
                              $output .= '<tr>
                                 <td class="'.@$value['class_mlc_credito'].'"><strong>' . fazmerir( $value['mlc_credito'] ) . '</strong></td>
                                 <td class="'.@$value['class_mlc_prazo1'].'">'.$value['mlc_prazo1'].' meses</td>
                                 <td class="'.@$value['class_mlc_prazo1_meiaparcela'].'"><strong>' . fazmerir( $value['mlc_prazo1_meiaparcela'] ) . '</strong></td>
                                 <td class="'.@$value['class_mlc_prazo1_parcela'].'"><strong>' . fazmerir( $value['mlc_prazo1_parcela'] ) . '</strong></td>
                                 <td class="'.@$value['class_mlc_prazo2'].'">'.$value['mlc_prazo2'].' meses</td>
                                 <td class="'.@$value['class_mlc_prazo2_meiaparcela'].'"><strong>' . fazmerir( $value['mlc_prazo2_meiaparcela'] ) . '</strong></td>
                                 <td class="'.@$value['class_mlc_prazo2_parcela'].'"><strong>' . fazmerir( $value['mlc_prazo2_parcela'] ) . '</strong></td>
                              </tr>';
                     }//end foreach

                     $output .= '</table>';
                  $output .= '</div>';
                     
                  
                  break;
               
               default:
                  # code...
                  break;
            }
         }
         
         $output .= self::showForm(); 

         return $output;


      }

   }