<?php

class Request
{
	function __construct() { $this -> bootstrapSelf(); }

	private function bootstrapSelf()
	{
		foreach($_SERVER as $key => $value)
		{
			$this -> $key = $value;
		}
	}

	public function getBody()
	{
			$body = array();
			
			if($_POST) 
			{
				foreach($_POST as $key => $value)
				{
					$body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
				}
			}
			else 
			{
				$req = fopen('php://input', 'r');
				$reqData = '';
				while($data = fread($req, 1024))
					$reqData .= $data;
				fclose($req);
				
				$formated = explode("&", $reqData);
				foreach($formated as $f)
				{
					$split = explode("=", $f);
					$body[$split[0]] = $split[1];
				}
			}
      return $body;
	}
}

?>