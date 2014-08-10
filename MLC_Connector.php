<?php

   /**
   *     Class MLC_Connector
   * 
   *       Responsável pela conexão com o servidor em
   * 
   *       http://api.lucianotonet.com/mav-lc
   *      
   */
   class MLC_Connector
   {
      
      /**
       * [baztag_func description]
       * @param  [type] $atts    [description]
       * @param  string $content [description]
       * @return [type]          [description]
       */
      public function getData() {

         $request_data  = array(
                              'API_KEY'        => MLC_USERKEY,
                              'sandbox'        => MLC_SANDBOX
                           );
         
         if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $request_data  = array_merge( $request_data, $_POST );
         }                              

         $hashkey       = base64_encode( serialize($request_data) ) . '&sandbox=' . MLC_SANDBOX;
         $request_url   = 'http://lucianotonet.com/api/mav-lc/?hash='.$hashkey;   
         
         // Retorno codificado
         $response      = self::get_url( $request_url );

         if( MLC_SANDBOX ){       
            // Com sandbox ativo o retorno não vem criptografado
            // basta exibi-los  
            MLC_Debugger::debugThis( $response );
         }else{
            // Decodifica o retorno
            $arrayresponse = unserialize( base64_decode($response) );
            return $arrayresponse;
         }

      }


      /**
       * [get_url description]
       * @param  [type] $request_url [description]
       * @return [type]              [description]
       */
      public function get_url($request_url) {
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $request_url);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         $response = curl_exec($ch);
         curl_close($ch);

         return $response;
      }

   }