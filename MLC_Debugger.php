<?php

    class MLC_Debugger
    {
     
      /**
      * [debug description]
      * @param  string $source [description]
      * @return [type]         [description]
      */
       public function debugThis($source = '')
       {
          if( MLC_DEBUG ){
            if($source){
               echo '<pre><code>';
               print_r($source);
               echo '</code></pre>';
            }else{
               echo '<pre><code>';
               echo '<h3>GET:</h3>';
               print_r($_GET);
               echo '<br />';
               echo '<h3>POST:</h3>';
               print_r($_POST);
               echo '</code></pre>';
            }
             
          }
       }

    }    