<?php
   // Author: Tracy Ta
   // Email : tracy.ta@gmail.com
	
   $filesize = 64000;
	$filename = "p022_names.txt";
	$file = fopen("p022_names.txt","r");
	$str = "";
	$name = array();	//"fname" => "", "score" => 0);
	
	if (!$file)
		print ("Can not open file " . $filename . "\n");
	else
	{
		while (!feof($file))
		{
			$str = fgets($file,$filesize);
		}
		fclose($file);
		if (strlen($str) == 0)
			print ("File " . $filename . "is empty\n");
		else
		{
			$str = $str . ",";
			//extract first names into array $name
			$i = 0; $j = 0; $k = 0;
			while (($j = strpos($str,",",$i)) !== false)
			{
				$fname = substr($str, $i, $j-$i);
				$fname = substr($fname,1,strlen($fname)-2);
				array_push($name, array("fname" => $fname, "score" => 0));
				$i = $j + 1;
				$k++;
			}

			//sorting the array $name
			arsort($name);

			//calculate scores
			$total=0;
			$count = count($name) . "\n";
			for ($i=0; $i<$count; $i++)
			{
				$tmp = array_pop($name);
				$tmp['score'] = ($i+1) * cal_score($tmp['fname']);
				echo $i+1 . ": " . $tmp['fname'] . ": " . $tmp['score'] . "\n";
				$total = $total + $tmp['score'];
			}		
			echo "Total score of all names is : " . $total . "\n";
		}
	}
	return;

	function cal_score($str)
	{
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$val = 0;
		for ($i=0; $i<strlen($str); $i++)
		{
			$val = $val + strpos($alphabet,$str[$i]) + 1;
		}
		return $val;
	}
?>
