<?php
function content ($label,$content)
{
	?>
	<div class="cbo" style="margin-bottom:7px;">
		<label for="<?php echo $id; ?>" class="fl tr pt5 fb" style="width:180px;"><?php echo $label; ?></label>
		<div style="margin-left:200px;">
			<?php echo $content; ?>
		</div>
	</div>
	<?php
}

function tf ($label,$name,$class,$id,$value)
{
	?>
	<div class="cbo" style="margin-bottom:7px;">
		<label for="<?php echo $id; ?>" class="fl tr pt5 fb" style="width:180px;"><?php echo $label; ?></label>
		<div style="margin-left:200px;">
			<input type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo $class; ?>" />
		</div>
	</div>
	<?php
}

function tf_disable ($label,$name,$class,$id,$value)
{
	?>
	<div class="cbo" style="margin-bottom:7px;">
		<label for="<?php echo $id; ?>" class="fl tr pt5 fb" style="width:180px;"><?php echo $label; ?></label>
		<div style="margin-left:200px;">
			<input type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo $class; ?>" disabled="disabled" style="border:1px solid #FFF;" />
		</div>
	</div>
	<?php
}

function select_box ($label,$name,$class,$id,$default,$options,$values)
{
	?>
	<div class="cbo" style="margin-bottom:7px;">
		<label for="<?php echo $id; ?>" class="fl tr pt5 fb w180" style="width:180px;"><?php echo $label; ?></label>
		<div class="" style="margin-left:200px;">
			<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
				<?php
				if ($default)
				{
					$default = explode(',', $default);
					?>
					<option value="<?php echo $default[0]; ?>"><?php echo $default[1]; ?></option>
					<?php
				}
				// compatibilty of options to strings and arrays
				if (gettype($options) != 'array')
					$explodedOpts = explode(",",$options);
				else
					$explodedOpts = $options;
				
				if (gettype($values) != 'array')
					$explodedVals = explode(",",$values);
				else
					$explodedVals = $values;

				for ($p=0;$p<count($explodedOpts);$p++)
				{
					?>
					<option value="<?php echo $explodedVals[$p]; ?>"><?php echo $explodedOpts[$p]; ?></option>
					<?php
				}
				?>
			</select>
		</div>
	</div>
	<?php
}

function select_element ($name,$class,$id,$default,$options,$values)
{
	?>
	<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
		<?php
		if ($default)
		{
			$default = explode(',', $default);
			?>
			<option value="<?php echo $default[0]; ?>"><?php echo $default[1]; ?></option>
			<?php
		}
		// compatibilty of options to strings and arrays
		if (gettype($options) != 'array')
			$explodedOpts = explode(",",$options);
		else
			$explodedOpts = $options;
		
		if (gettype($values) != 'array')
			$explodedVals = explode(",",$values);
		else
			$explodedVals = $values;

		for ($p=0;$p<count($explodedOpts);$p++)
		{
			?>
			<option value="<?php echo $explodedVals[$p]; ?>"><?php echo $explodedOpts[$p]; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}

function radio ($label,$name,$class,$id,$value,$checked)
{
	?>
	<div class="cbo sl pb5" style="line-height:20px;">
		<div class="">
			<input type="radio" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo $class; ?>" <?php if ($checked == 1) { echo "checked='checked'" ;}?> />
			<label for="<?php echo $id; ?>" class="ml10 fl tl pt5 fb w180"><?php echo $label; ?></label>
			<div class="cbo"></div>
		</div>
	</div>
	<?php
}

function submit($name,$class,$id,$value)
{
	?>
	<div class="pb20" style="margin-left:200px;">
		<input type="submit" class="<?php echo $class; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>" name="<?php echo $name; ?>" />
	</div>
	<?php
}
?>