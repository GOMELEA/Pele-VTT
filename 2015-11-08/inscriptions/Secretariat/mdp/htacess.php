<?php
function regUser($user,$mdp) 
{
	$filename = '../gwd.php';
	$data = $user.":".htpasswd($mdp)."\n";
	if (is_writable($filename)) 
	{
		if (!$handle = fopen($filename, 'a')) 
		{
			echo "Cannot open file ($filename)";
			exit;
		}
		if (fwrite($handle, $data) === FALSE) 
		{
			echo "Cannot write to file ($filename)";
			exit;
		}
		//echo "Success, wrote ($data) to file ($filename)";
		fclose($handle);
	 } 
	 else 
	 {
		echo "The file $filename is not writable";
	  }
}
function regUser_admin($user,$mdp) 
{
	$filename = 'gwd.php';
	$data = $user.":".htpasswd($mdp)."\n";
	if (is_writable($filename)) 
	{
		if (!$handle = fopen($filename, 'a')) 
		{
			echo "Cannot open file ($filename)";
			exit;
		}
		if (fwrite($handle, $data) === FALSE) 
		{
			echo "Cannot write to file ($filename)";
			exit;
		}
		//echo "Success, wrote ($data) to file ($filename)";
		fclose($handle);
	 } 
	 else 
	 {
		echo "The file $filename is not writable";
	  }
}

// function to show all users and passwords ( encrypted )
function showUser()
{
     $file = file('members/password/.htpasswd');
     $array = array();
     $count = count($file);
     for ($i = 0; $i < $count; $i++)
     {
		list($username, $password) = explode(':', $file[$i]);
		$array[] = array("username" => $username, "password" => $password);
      }
     return $array;
}
function delUser($username) 
{
   $fileName = file('../gwd.php');
   $pattern = "/". $username."/";
   foreach ($fileName as $key => $value) 
   {
	   if(preg_match($pattern, $value)) { $line = $key;  }
   }
   unset($fileName[$line]);
   if (!$fp = fopen('../gwd.php', 'w+'))
      {
        print "Cannot open file ($fileName)";
        exit;
      }
   if($fp)
      {
        foreach($fileName as $line) { fwrite($fp,$line); }
        fclose($fp);
      }
}
function delUser_admin($username) 
{
   $fileName = file('gwd.php');
   $pattern = "/". $username."/";
   foreach ($fileName as $key => $value) 
   {
	   if(preg_match($pattern, $value)) { $line = $key;  }
   }
   unset($fileName[$line]);
   if (!$fp = fopen('gwd.php', 'w+'))
      {
        print "Cannot open file ($fileName)";
        exit;
      }
   if($fp)
      {
        foreach($fileName as $line) { fwrite($fp,$line); }
        fclose($fp);
      }
}
// function for encrypting password   
function htpasswd($pass)
{
     $pass = crypt(trim($pass),base64_encode(CRYPT_STD_DES));
     return $pass;
}
?>