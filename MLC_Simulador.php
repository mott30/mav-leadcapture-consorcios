<?php

   class MLC_Simulador
   {


      /**
       * showForm
       * @param  string $style [description]
       * @return [type]        [description]
       */
      public function showForm($style='')
      {
         
         include(  plugin_dir_path( __FILE__ ) . 'templates/form.php');
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            /**
             *    SIMULAÇÃO REALIZADA
             *    Pegar dados no server...
             */               
            $connector = new MLC_Connector;
            $data      = $connector->getData(); // Recebe os dados

            if( is_array( $data ) ){
               self::showResultsTable( $data ); // Monta os resultados na tabela
            }else{
               echo "Impossíve montar tabela de resultados com estes dados:<br>";
               print_r($data);
            }
         }
      }

         
      /**
       * showResults
       * @return Retorna uam tabela popoulada com os resultados da simulação.
       */
      public function showResultsTable(Array $data)
      {
         
            $output = '<h2><a name="mlc_results">Resultado da simulação</a></h2>';

            if( isset($data) and !empty($data) ){

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

               /**
                *    FazMeRir Format
                *       PHP         
                *  
                *    Fomatação monetária
                *    
                */
               function FazMeRir( $quanto='1.99', $moeda='R$' )
               {
                  $quantoMesmo = number_format( $quanto, 2, ',', '.' );
                  return $moeda . " " . $quantoMesmo;
               }
               
               foreach ($data as $value) {
                  
                  $output .= '<tr>
                                 <td><strong>' . FazMeRir( $value['mlc_credito'] ) . '</strong></td>
                                 <td>'.$value['mlc_prazo1'].' meses</td>
                                 <td><strong>' . FazMeRir( $value['mlc_prazo1_meiaparcela'] ) . '</strong></td>
                                 <td><strong>' . FazMeRir( $value['mlc_prazo1_parcela'] ) . '</strong></td>
                                 <td>'.$value['mlc_prazo2'].' meses</td>
                                 <td><strong>' . FazMeRir( $value['mlc_prazo2_meiaparcela'] ) . '</strong></td>
                                 <td><strong>' . FazMeRir( $value['mlc_prazo2_parcela'] ) . '</strong></td>
                              </tr>';
               }//end foreach

               $output .= '</table>';

               echo $output;
            }
      }


      /**
       * [init description]
       * @return [type] [description]
       */
      public function init()
      {
         self::show();
      }
   }