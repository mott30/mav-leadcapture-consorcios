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
         echo include(  plugin_dir_path( __FILE__ ) . 'templates/form.php');

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               
               /**
                *    SIMULAÇÃO REALIZADA
                *    Pegar dados no server...
                */               
               $simulador = new MLC_Connector;
               $data      = $simulador->getData();

               self::showResultsTable($data);
            }
      }

         
      /**
       * showResults
       * @return Retorna uam tabela popoulada com os resultados da simulação.
       */
      public function showResultsTable(Array $data)
      {
         
         // JUST DEBUG THIS         
         // $debugger = new MLC_Debugger;
         // $debugger->debugThis( $data );
         
            $output = '<h2><a name="mlc_results">Resultado da simulação</a></h2>';

            if( isset($data) and !empty($data)){

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

               setlocale(LC_MONETARY,"pt_BR");
               
               foreach ($data as $value) {

                  $output .= '<tr>
                                 <td><strong>'.'R$ ' . number_format( $value['mlc_credito'], 2, ',', '.' ).'</strong></td>
                                 <td>'.$value['mlc_prazo1'].' meses</td>
                                 <td><strong>'.'R$ ' . number_format( $value['mlc_prazo1_parcela'], 2, ',', '.' ).'</strong></td>
                                 <td><strong>'.'R$ ' . number_format( $value['mlc_prazo1_meiaparcela'], 2, ',', '.' ).'</strong></td>
                                 <td>'.$value['mlc_prazo2'].' meses</td>
                                 <td><strong>'.'R$ ' . number_format( $value['mlc_prazo2_parcela'], 2, ',', '.' ).'</strong></td>
                                 <td><strong>'.'R$ ' . number_format( $value['mlc_prazo2_meiaparcela'], 2, ',', '.' ).'</strong></td>
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