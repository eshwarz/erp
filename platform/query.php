<?php
require_once('../conn.php');
class query
{
	function insert ($table_name,$fields,$values)
	{
		$sql = "INSERT INTO ".$table_name." (".$fields.") VALUES (".$values.")";
		$result = mysqli_query($con, $sql);
		if (!$result)
		{
			die("Error in ( ".$sql." ): ".mysqli_connect_error());
		}
	}
	
	function delete ($table_name,$where)
	{
		$sql = "DELETE FROM ".$table_name." WHERE ".$where;
		$result = mysqli_query($con, $sql);
		if (!$result)
		{
			die("Error in ( ".$sql." ): ".mysqli_connect_error());
		}
	}
	
	function update ($table_name,$fields,$values,$where)
	{
		$exploded_fields = explode(",",$fields);
		$exploded_values = explode(",",$values);
		
		$field_count = count($exploded_fields);
		
		//forming partial update statement.
		$set_values = " SET ";
		for ($m = 0; $m < $field_count; $m++)
		{
			if ($m != $field_count-1)
				$set_values = $set_values.$exploded_fields[$m]."=".$exploded_values[$m].",";
			else if ($m == $field_count-1)
				$set_values = $set_values.$exploded_fields[$m]."=".$exploded_values[$m];
		}
		$sql = "UPDATE ".$table_name.$set_values." WHERE ".$where;
		$result = mysqli_query($con, $sql);
		if (!$result)
		{
			die("Error in ( ".$sql." ): ".mysqli_connect_error());
		}
		
	}
	
	function select ($fields,$table_name,$where = null,$order_by = null,$desc = null,$limit_start = null,$limit_count = null)
	{
		$exploded_array;
		if ($fields == '*')
		{
			$get_table = 'DESCRIBE '.$table_name;
			$get_table_result = mysqli_query($con, $get_table);
			while ($get_table_row = mysqli_fetch_array($get_table_result, MYSQLI_ASSOC))
			{
				$exploded_array[] = $get_table_row['Field'];
			}
		}
		else
		{
			$exploded_array = explode(",",$fields);
		}
		$record_array;
		if (empty($order_by) && empty($where))
		{
			$sql = "SELECT ".$fields." FROM ".$table_name;
		}
		else if (!empty($order_by) && empty($where))
		{
			//deciding order by desc or asc
			if ($desc == 0)
			{
				$sql = "SELECT ".$fields." FROM ".$table_name." ORDER BY ".$order_by." LIMIT ".$limit_start.",".$limit_count
				;
			}
			else if ($desc == 1)
			{
				$sql = "SELECT ".$fields." FROM ".$table_name." ORDER BY ".$order_by." DESC LIMIT ".$limit_start.",".$limit_count
				;
			}
		}
		else if (empty($order_by) && !empty($where))
		{
			$sql = "SELECT ".$fields." FROM ".$table_name." WHERE ".$where;
		}
		else if (!empty($order_by) && !empty($where))
		{
			//deciding order by desc or asc
			if ($desc == 0)
			{
				$sql = "SELECT ".$fields." FROM ".$table_name." WHERE ".$where." ORDER BY ".$order_by." LIMIT ".$limit_start.",".$limit_count
				;
			}
			else if ($desc == 1)
			{
				$sql = "SELECT ".$fields." FROM ".$table_name." WHERE ".$where." ORDER BY ".$order_by." DESC LIMIT ".$limit_start.",".$limit_count
				;
			}
		}
		
		$result = mysqli_query($con, $sql);
		if (!$result)
		{
			die("Error in ( ".$sql." ): ".mysqli_connect_error());
		}
		$i = 0;
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			for ($m = 0; $m < count($exploded_array); $m++)
			{
				$record_array[$i][$exploded_array[$m]] = $row[$exploded_array[$m]];
			}
			$i++;
		}
		return $record_array;
	}

	function unique_rows($field, $table)
	{
		$sql = "SELECT distinct({$field}) FROM {$table}";
		$result = mysqli_query($con, $sql);
		$i = 0;
		$record_array;
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$record_array[] = $row;
		}
		return $record_array;
	}

}
?>