<?php
function smarty_modifier_intToTime($inttime)
{
	if ($inttime < 0)
	{
		return "--";
	}
	else
	{
    	return strftime("%m/%d/%Y %H:%M:%S", $inttime);
    }
}
?>
