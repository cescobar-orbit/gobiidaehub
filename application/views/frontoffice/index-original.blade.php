<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>STRI Physical Monitoring System</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
	{{ Asset::container('bootstrapper')->styles() }}
    {{ Asset::container('bootstrapper')->scripts() }}
</head>
<body>
	<div class="wrapper">
		<header>
		
			<h2>STRI Physical Monitoring System</h2>

			<p class="intro-text" style="margin-top: 45px;">
			</p>
		</header>
		<div role="main" class="main">
			<div class="home">
			   <p>FRONT OFFICE </p>
			   <br/><br/><br/>
				<ul class="out-links">
					<li>{{  HTML::link('backoffice/index','Backoffice') }}</li>
					<li><a href="http://forums.laravel.com">Laravel Forums</a></li>
					<li><a href="http://github.com/laravel/laravel">GitHub Repository</a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
