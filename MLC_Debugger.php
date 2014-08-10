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
            echo 'Sandbox debug local<br><br>POST:<br>';
            print_r($_POST);
            echo '</code></pre>';
            echo '<pre><code>';
            print_r($source);
            echo '</code></pre>';
         }else{
            echo '<pre><code>';
            echo 'DebugThis chamado com parâmetro vazio:<br />';
            var_dump($source);
            echo 'GET:<br />';
            var_dump($_GET);
            echo '<br />';
            echo 'POST:<br />';
            var_dump($_POST);
            echo '</code></pre>';
         }

      }
   }

}    