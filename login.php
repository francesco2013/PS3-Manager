
<?PHP


require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("index.php");
   }
   
}
include("include/class.getip.php");


?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Fazionet.tk</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    
    
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600,700,300'>

        <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      

      html,
body {
  width: 100%;
  height: 100%;
}
body {
  margin: 0 auto;
  display: table;
  text-align: center;
  font-family: 'Open Sans', sans-serif;
  background: #81b5d6;
  max-width: 33em;
}
.wrap {
  margin-top:50px;
}

.flip-container {
  perspective: 1000;
  border-radius: 50%;
  margin: 0 auto 10px auto;
}

.logged-in {
	transform: rotateY(180deg);
}

.flip-container, .front, .back, .back-logo {
	width: 130px;
	height: 130px;
}

.flipper {
	transition-duration: 0.6s;
	transform-style: preserve-3d;
}

.front, 
.back {
	backface-visibility: hidden;
	position: absolute;
	top: 0;
	left: 0;
  background-size: cover;
}

.front {
	background: url(http://s8.postimg.org/y7z5wso29/Flip_Img.png) 0 0 no-repeat;
}

.back {
	transform: rotateY(180deg);
	background: url(http://s8.postimg.org/y7z5wso29/Flip_Img2.png) 0 0 no-repeat;
}

h1 {
  font-size: 15px;
  color: #FFF;
}
h1 span {
  font-weight: 300;
}
input[type=text],
input[type=password] {
  color:#FFF;
  background: #68add8; /* Old browsers */
  background: linear-gradient(45deg,  #68add8 0%,#8cbede 100%); /* W3C */
  width:250px;
  height:40px;
  margin: 0 auto 10px auto;
  font-size:14px;
  padding-left:15px;
  border:none;
  box-shadow: -3px 3px #679acb ;
  -webkit-appearance:none;
  border-radius:0;
  border-top: 1px solid #92c5e2;
  border-right: 1px solid #92c5e2;
}
input::-webkit-input-placeholder { 
  color: #FFF;
}
input:focus {
  outline:none;
}
input[type=submit] {
    color: #fff;
    background-color:#3f88b8;
    font-size: 14px;
    height: 40px;
    border: none;
    margin: 0 auto 0 17px;
    padding: 0 20px 0 20px;
    -webkit-appearance:none;
    border-radius:0;
    cursor: pointer;
}
input[type=submit]:hover {
  background-color:#3f7ba2;
}
a {
  color:#1c70a7;
  font-weight:600;
  font-size:12px;
  text-decoration:none;
}
a:hover {
  color:#3f7ba2;
}

.hint
{
  width:250px;
  dislay:block;
  margin:80px auto 0 auto;
  text-align:left;
}

.hint p
{
  padding: 5px 0 5px 0;
  color:#FFF;
  font-weight:600;
  font-size:20px;
}

.hint p span
{
  font-weight:300;
  font-size:16px;
}

    </style>

<STYLE TYPE="text/css">
.newtext {font-size: 18pt; color: #ff0000; font-family: arial}
#newtext2 {font-size: 20pt; color: #ff00ff; font-family: courier}
</STYLE>

    
        <script src="js/prefixfree.min.js"></script>

    
  </head>

  <body>

    <!--    
        JS Credits to bartveneman
        Comments? Feel free!
 -->



<div class="wrap">
  
<img src='Fazionet_Logo.png'  style="width: 70%; height: 70%">
  
  <h1 class="text" id="welcome">Private. <span>please login.</span></h1>
  
 <!-- Form Code Start -->
<div id='fg_membersite'> 
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>



<input type='hidden' name='submitted' id='submitted' value='1'/>


<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" placeholder='Username' /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <input type='password' name='password' id='password' maxlength="50" placeholder='Password'/><br/>
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Login' />
</div>

</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
</div><!-- /wrap -->


<div class=''>
<p>


<h1 class="text" id="welcome">

<span><?php $now = date("F j, Y, g:i a"); echo $now;?></span><br>
<span>
Your IP address <b><?php $ip_remote = get_ip_address(); 

echo $ip_remote;?></b> will be logged.</span></h1>
 </p>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
