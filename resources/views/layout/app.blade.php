<!DOCTYPE html>
<html>
<head>
	<title>Code Test</title>
	<link rel="stylesheet" href="/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="/css/bootstrap-responsive.css" type="text/css" media="screen">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<script type="text/javascript">
	jQuery(document).ready(function() {
    		/*$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
    		});*/	
    	});
</script>
	<body>
		<h1 align="center"> Code Test</h1>
		@yield('homeContent')
	</body>

</html>