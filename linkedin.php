<html>
<head>
<title>Login/Registration Example</title>
 
<script type="text/javascript" src="http://platform.linkedin.com/in.js">
  api_key: o1yf9WMdgd8dp_OGkmtXESCOJFostN8N1jI1AFKY2i0kJ1QFNMOs3a6R5qUoBIqF
  authorize: true
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link media="all" type="text/css" href="http://developer.linkedinlabs.com/tutorials/css/jqueryui.css" rel="stylesheet"/>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.5b1.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>
 
</head>
<body class="yui3-skin-sam  yui-skin-sam">
<script type="IN/Login">
<form action="index.php">
<p>Your Name: <input type="text" name="name" value="<?js= firstName ?> <?js= lastName ?>" /></p>
<p>Your Password: <input type="password" name="password" /></p>
<input type="hidden" name="linkedin-id" value="<?js= id ?>" />
<input type="submit" name="submit" value="Sign Up"/>
</form>
</script>
</body>
</html>