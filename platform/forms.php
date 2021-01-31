<?php
class forms
{
	function input($type,$name,$value,$class,$id)
	{
		?>
		<input type="<?php echo $type; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo $class; ?>" id="<?php echo $id; ?>" /> 
		<?php
	}
	
	function textarea($name,$value,$class,$id)
	{
		?>
        <textarea name="<?php echo $name; ?>" class="<?php echo $class; ?>" id="<?php echo $id; ?>"><?php echo $value; ?></textarea>
		<?php
	}
	
	function select($name)
	{
		
	}
}
?>
