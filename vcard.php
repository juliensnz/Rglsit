<?php

function type($line)
{
	
	$size = strlen($line);
	$cpt = 0;
	while(($car = $line[$cpt]) != ":" && $cpt < $size)
	{
		$type .= $car;
		$cpt++;
	}
	if($cpt != $size)
	{
		return utf8_decode($type);
	}
	else
	{
		return NULL;
	}
}

function primaryType($line)
{
	$size = strlen($line);
	$cpt = 0;
	
	while(($car = $line[$cpt]) != ":" && $car != ";" && $cpt < $size)
	{
		if($car == ".")
		{
			$type = "";	
		}
		else
		{
			$type .= $car;
		}
		$cpt++;
	}
	if($cpt != $size)
	{
		return utf8_decode($type);
	}
	else
	{
		return NULL;
	}
}

function getNextValue($line)
{
	$size = strlen($line);
	$cpt = 0;
	while(($car = $line[$cpt]) != ";" && $cpt < $size)
	{
		$value .= $car;
		$cpt++;
	}
	$value = trim($value);
	//echo "Value : \"".$value."\"";
	if($value != "" && $value != NULL && $value != EOL)
	{
		return utf8_decode($value);
	}
	else
	{
		return NULL;
	}
}

function getNom($line)
{
	//N:Sanchez;Julien;;;
	$position = 0;
	$size = strlen($line);
	
	while($position < $size)
	{
		$value = getNextValue(substr($line,$position));
		$position += strlen($value)+1;
		if($value != NULL)
		{
			$values[] = $value;
		}
	}
	$result = array (
    'familyname' => $values[0],
    'firstname' => $values[1]);
	return $result;
}

function getTitre($line)
{
	//FN:Julien Sanchez
	$result = array (
    'name' => trim($line)
    );
	return $result;
}

function getOrg($line)
{
	//ORG:Reglisse;
	$line = trim($line);
	$position = 0;
	$size = strlen($line);
	
	while($position < $size)
	{
		$value = getNextValue(substr($line,$position));
		if($value != NULL)
		{
			$result = array (
			    'org' => substr(trim($line),$position,$size-1)
			);
			return $result;
		}
		$position += strlen($value)+1;
	}
	return NULL;
}

function getMail($line)
{
	
	$size = strlen($type);
	
	$type = type($line);
	
	$position = strlen($type);
	
	$mail = getNextValue(substr($line,$position+1));
	
	
	
	$position = 0;
	$size = strlen($type);
	
	while($position < $size)
	{
		$value = getNextValue(substr($type,$position));
		$position += strlen($value)+1;
		
		if($value != NULL)
		{
			if($value == "type=WORK")
			{
				$mailType = "WORK";	
			}
			else if($value == "type=HOME")
			{
				$mailType = "HOME";	
			}
			
			if(!isset($mailType))
			{
				$mailType = "OTHER";	
			}
		}
	}
	
	$result = array (
    'type' => $mailType,
    'mail' => $mail);
	
	return $result;
}

function getUrl($line)
{
	//item5.URL;type=pref:http\://erambert.me
	
	$size = strlen($line);
	
	$type = type($line);
	$position = strlen($type);
	
	$url = getNextValue(substr($line,$position+1));
	
	return $url;
}

function getTel($line)
{
	//TEL;type=CELL;type=pref:06 22 71 23 15
	$size = strlen($line);
	
	$type = type($line);
	
	$position = strlen($type);
	
	$tel = getNextValue(substr($line,$position+1));
	
	
	$position = 0;
	$size = strlen($type);
	
	while($position < $size)
	{
		$value = getNextValue(substr($type,$position));
		$position += strlen($value)+1;
		//echo primaryType($value);
		if($value != NULL)
		{
			if($value == "type=WORK")
			{
				$telType = "WORK";	
			}
			else if($value == "type=HOME")
			{
				$telType = "HOME";	
			}
			else if($value == "type=CELL")
			{
				$telType = "CELL";	
			}
			
			if(!isset($telType))
			{
				$telType = "OTHER";	
			}
		}
	}
	
	$result = array (
    'type' => $telType,
    'tel' => $tel);
	
	return $result;
}

function getAdr($line)
{
	$size = strlen($line);
	
	$type = type($line);
	$position = strlen($type)+1;
	
	while($position < $size)
	{
		$value = getNextValue(substr($line,$position));
		$position += strlen($value)+1;
		if($value != NULL)
		{
			$adr .= $value." ";
		}
	}
	
	$position = 0;
	$size = strlen($type);
	
	while($position < $size)
	{
		$value = getNextValue(substr($type,$position));
		$position += strlen($value)+1;
		
		if($value != NULL)
		{
			if($value == "type=WORK")
			{
				$adrType = "WORK";	
			}
			else if($value == "type=HOME")
			{
				$adrType = "HOME";	
			}
			
			if(!isset($adrType))
			{
				$adrType = "OTHER";	
			}
		}
	}
	
	$result = array (
    'type' => $adrType,
    'adr' => $adr);
	
	return $result;
}


function getImg($file)
{
	$img = "";
	while(primaryType($data = fgets($file)) == NULL)
	{
		$img .= trim($data);
	}
	return $img;
}

function displayImg($img)
{
	echo '<img class="photo" src="data:image/gif;base64,' . $img .'" />';
}

function displayArray($array)
{
	
		foreach($array as $cle => $value)
		{
			if(getType($value) != "array")
			{
				echo $value." ";
			}
			else
			{
				displayArray($value);	
			}
		}

	echo "<br/>";
}


function parseVCard($path)
{
	if($vcard = fopen($path, 'r'))
	{
		if(($data =  trim(fgets($vcard))) == "BEGIN:VCARD" || $data == "begin:vcard")
		{
		//	fgets($vcard);
			
			while(!feof($vcard))
			{
				$data =  fgets($vcard);
				switch (primaryType($data))
				{
					case "N":
						$name = getNom(substr($data,2));
						//displayArray($name);
						break;
					case "FN":
						$title = getTitre(substr($data,3));
						//displayArray($title);
						break;
					case "NICKNAME":
						$nickname = getTitre(substr($data,9));
						//displayArray($title);
						break;
					case "ORG":
						$org = getOrg(substr($data,4));
						//displayArray($org);
						break;
					case "URL":
						$url[] = getUrl(substr($data,0));
						//displayArray($url);
						break;
					case "EMAIL":
						$mail[] = getMail(substr($data,6));
						//displayArray($mail);
						break;
					case "TEL":
						$tel[] = getTel(substr($data,4));
						//displayArray($tel);
						break;
					case "ADR":
						$adr[] = getAdr($data);
						//displayArray($adr[0]);
						break;
					case "PHOTO":
						$photo = getImg($vcard);
						//displayImg($photo);
						break;
					case "n":
						$name = getNom(substr($data,2));
						//displayArray($name);
						break;
					case "fn":
						$title = getTitre(substr($data,3));
						//displayArray($title);
						break;
					case "nickname":
						$nickname = getTitre(substr($data,9));
						//displayArray($title);
						break;
					case "org":
						$org = getOrg(substr($data,4));
						//displayArray($org);
						break;
					case "url":
						$url[] = getUrl(substr($data,0));
						//displayArray($url);
						break;
					case "email":
						$mail[] = getMail(substr($data,6));
						//displayArray($mail);
						break;
					case "tel":
						$tel[] = getTel(substr($data,4));
						//displayArray($tel);
						break;
					case "adr":
						$adr[] = getAdr($data);
						//displayArray($adr[0]);
						break;
					case "photo":
						$photo = getImg($vcard);
						//displayImg($photo);
						break;
					default:
						break;	
				}
			}
			?>
			<table class="vcard">
				<tr class="resume">
					<td class="avatar"><?php displayImg($photo); ?></td>
					<td class="infos">
						<span class="fn"><?php echo $name['firstname'];?> <?php echo $name['familyname']; ?></span><br/>
						<?php echo $org['org']; ?><br/>
						<?php
						foreach($url as $element)
						{
							echo '<a href="'.stripslashes($element).'">'.stripslashes($element)."</a><br/>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					
					<?php
					foreach($adr as $element)
					{
						echo '<span class="label">Adresse : </span><span class="adr" type="home">'.stripslashes($element['adr'])."</span><br/>";
					}
					?>
					</td>
				</tr>
				
				<tr rowspan="2">
					<td class="tel">
					
					<?php
					foreach($tel as $element)
					{
						if($element['type'] == "WORK")
						{
							echo '<span class="label">Travail : ';
						}
						else if($element['type'] == 'HOME')
						{
							echo '<span class="label">Domicile : ';
						}
						else if($element['type'] == 'CELL')
						{
							echo '<span class="label">Portable : ';
						}
						else if($element['type'] == 'OTHER')
						{
							echo '<span class="label">Tel : ';
						}
						
						echo "</span>".$element['tel']."<br/>";
					}
					?>
					</td>
					<td>
					
					<?php
					foreach($mail as $element)
					{
						if($element['type'] == "WORK")
						{
							echo '<span class="label">Travail : ';
						}
						else if($element['type'] == "HOME")
						{
							echo '<span class="label">Perso : ';
						}
						else if($element['type'] == "OTHER")
						{
							echo '<span class="label">Mail : ';
						}
						
						echo '</span><span class="email">'.$element['mail']."</span><br/>";
					}
					?>
					</td>
				</tr>
			</table>
			
			<?php
		}
	}
}



$url = (isset($_GET['url']) && $_GET['url'] != "") ? $_GET['url'] : ((isset($_POST['url']) && $_POST['url'] != "") ? $_POST['url'] : NULL);

parseVCard("./files/".$url);



?>
