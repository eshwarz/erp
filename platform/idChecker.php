<?php
function idChecker($error_page)
{
	$count = func_num_args();
	$ids = func_get_args();
	
	for ($m = 0; $m < $count-1; $m++)
	{
		$id = $ids[$m];
		if (empty($_REQUEST[$id]))
		{
			header("Location:".$error_page);
		}
	}
}
?>