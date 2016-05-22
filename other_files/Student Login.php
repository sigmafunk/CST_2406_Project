Student_login.php

<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<title>Login </title> 
<link rel="stylesheet" href="Style.css" 
type="text/css"/> <script type="text/javascript"> 
function validate() 
{ 
if(document.form1.st_id.value=="") 
{ 
alert("Enter your login Id."); 
document.form1.st_id.focus(); 
return false; 
} 
if(document.form1.st_pass.value=="") 
{ 
alert("Enter your password."); 
document.form1.st_pass.focus(); 
return false; 
} 
} 
</script> 
</head> 
<body onLoad="javascript:document.form1.st_id.focus()"> 
<form name="form1" method="post" action="Student_login_handler.php" 
onSubmit="return validate();"> 
<table width="100%" height="100%" > 
<tr> 
<td height="15%"><?php include 'Header.php';?></td> 
</tr> 
<tr>
<td width="100%" height="80%" align="center" valign="baseline"><table 
width="90%" > 
<tr> 
<td width="8%"><a href="index.php" class="stylelink" 
style="text-decoration:none; font-family: &quot;Times New 
Roman&quot;, Times, serif;">Home</a></td> 
<td width="35%" align="center">&nbsp;</td> 
<td width="27%">&nbsp;</td> 
<td width="30%" align="right"><a 
href="Student_Registration.php" class="stylelink" style="text- 
decoration:none ; font-weight: bold;">New Student Click Here</a></td> 
</tr> 
<tr> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
</tr> 
<tr> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
</tr> 
<?php if($_GET['flag'] == "success") { ?> 
<tr> 
<td class="stylegreen" colspan="4" 
align="center">Congratulations! You Are successfully registered. You can use 
your Login Id and Password to login to your account.</td> 
</tr> 
<?php 
} 
else if($_GET['flag'] == "exists") { ?>
58. <tr> 
<td class="stylered" colspan="4" align="center">This 
Login Id( <?=$_GET['student_id']?>) already exists.Please, try again with 
another Login Id</td> 
</tr> 
<?php 
}else if($_GET['flag'] == "error") { 
?> 
<tr> 
<td class="stylered" colspan="4" align="center">Error 
while inserting data. Please, try again.</td> 
</tr> 
<?php 
} 
?> 
<tr> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
</tr> 
<tr> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
<td>&nbsp;</td> 
</tr> 
<tr> 
<td colspan="4"><table width="30%" border="1" align="center" 
cellpadding="3" cellspacing="0" bordercolor="#CCCCCC" 
bgcolor="#CCCCCC"> 
<tr align="center" bgcolor="#999999"> 
<td colspan="2" class="stylebig">Student Login Here</td> 
</tr>
<tr bgcolor="#E1E1E1" class="stylesmall"> 
<td width="35%" align="left" class="style7">Login Id : </td> 
<td width="65%" align="left"><input name="st_id" type="text" 
id="st_id"></td> 
</tr> 
<tr bgcolor="#E1E1E1" class="stylesmall"> <td 
align="left" class="style7">Password:</td> 
<td align="left"><input name="st_pass" type="password" 
id="st_pass"></td> 
</tr> 
<tr bgcolor="#E1E1E1"> 
<td colspan="2" align="center">&nbsp; 
<?php if($_GET['flag'] == "invalid") { ?> 
<span class="stylered">Invalid Login Id or Password</span> 
<?php }?> 
</td> 
</tr> 
<tr bgcolor="#E1E1E1"> 
<td colspan="2" align="center"><input name="login" class="style10" 
type="submit" id="login" value="Login"> 
<input name="close" type="button" id="close" class="style10" 
value="Close" onClick="self.location='index.php'"> </td> 
</tr> 
</table></td> 
</tr> 
</table></td> 
</tr> 
<tr> 
<td height="5%" align="center"><?php include 'Footer.php';?></td> 
</tr> 
</table> 
</form> 
</body>
</html>