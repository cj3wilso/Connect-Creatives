<!DOCTYPE html>

<html dir="ltr" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset=utf-8 />
<title>Connect Creatives - Where Toronto's Web Professionals Collaborate on Projects</title>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
<link rel=stylesheet href=_css/style.css type=text/css>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js" type="text/javascript"></script>
<!-- LIGHTBOX -->
<script>
	$(function() {
		$( ".dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
		});

		$( "#message" )
			.click(function() {
				$( ".dialog-form" ).dialog( "open" );
			});
	});
	</script>
<!-- LIGHTBOX -->
</head>

<body>
<a href="home.php"><h1>Connect Creatives</h1></a>

<p><a href="home.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="project-new.php">Start a New Project</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="projects-all.php">Find a Project</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="peers-all.php">Find a Peer</a></p>

<p><a href="projects-mine.php">My Projects</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="peers-mine.php">My Peers</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="profile.php">My Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="approve.php">My Approvals</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="logout.php">Logout</a></p>