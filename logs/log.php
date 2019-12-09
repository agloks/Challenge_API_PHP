<?php

function log_gen($text) {
  $data = getdate();
  $hours = ((int)$data["hours"]) - 3;
  $dataFormated = "{$data["mon"]}/{$data["mday"]}/{$data["year"]},  {$hours}:{$data["minutes"]}:{$data["seconds"]}";
  $nameFile = "log-{$data["mon"]}-{$data["mday"]}-{$data["year"]}.txt";

  try {
    if( !($file = fopen("./logs/$nameFile", "r")) )
    {
      $file = fopen("./logs/$nameFile", "a+");
      $FIXED = 
      "
      ------------------------------------------------------------------------------------------------
            $dataFormated \n
      ";
      
      fwrite($file, $FIXED."\n");
      fclose($file);
    }
    $file = fopen("./logs/$nameFile", "a+");
    fwrite($file, 
    "
      at $dataFormated ->
    "
    );

    fwrite($file, $text."\n");
    fclose($file);
  } catch(Exception $err) { fclose($file); }
};

?>