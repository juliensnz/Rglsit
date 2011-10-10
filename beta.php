<?php
function getWebloc($path)
{
	if($webloc = fopen($path, 'r'))
	{
		while(!feof($webloc))
		{
			$data =  trim(fgets($webloc));
			
			
			if(($begin = strpos($data,"<string>")) == "0" && ($end = strpos($data,"</string>")))
			{
				$len = strlen($data) - 9;
				return substr($data,$begin+8,$len);
			}
			
		}
	}
	return 0;
}



?>