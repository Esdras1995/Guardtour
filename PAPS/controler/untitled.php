<!DOCTYPE html>
<html>
<head>
	<title>Test select js</title>
	<script src="vendor/jquery/dist/jquery.min.js"></script>
</head>
<body>
	<select id="limit">
		<option></option>	
		<option>test 11111111111111111111111111</option>		
		<option>test 2</option>
		<option>test 3</option>
		<option>test 4</option>
		<option>test 5</option>
		<option>test 6</option>
	</select>
</body>
<script type="text/javascript">
	$('#limit').on('change', function(){
		alert($(this).val());
	});
</script>
</html>