<?php
class dateof
{
	function month_d_Y_h_m_A ($unix_timestamp,$offset)
	{
		$time_offset = $offset*60*60;
		$time_format = "F d Y, g:i A";
		return gmdate($time_format,($unix_timestamp+$time_offset));
	}
}
?>