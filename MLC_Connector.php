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
      function getData() {

         
         function get_url($request_url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
         }

         
         $request_data  = array(
                              'API_version'    => '1.0',
                              'MLC_debug'      => MLC_DEBUG,
                              'client_key'     => USER_KEY
                           );
         
         if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $request_data  = array_merge( $request_data, $_POST );
         }                              

         $hashkey       = base64_encode(serialize($request_data));

         $request_url   = 'http://api.lucianotonet.com/mav-lc/?hash='.$hashkey;
         $response      = get_url($request_url);

         //$arrayresponse = unserialize(base64_decode($response));
         $arrayresponse = unserialize(base64_decode($response));

         return $arrayresponse;

      }

   }
      


?>