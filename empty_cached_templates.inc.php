<?php

function emptyDir($dir) {
	
	if (is_dir($dir)) {
		
		$handle = opendir($dir);
		
		while ($file = readdir($handle)) {		
			if ($file != "." && $file != ".." && $file != ".svn") {
				unlink ("".$dir."/".$file."");
			}
		}
		
		closedir($handle);
		
	}
	
} // # END emptyDir


emptyDir("presentation/templates/cached");
emptyDir("presentation/templates/cached/admin");

?>