<html>
<head>
  <script src="http://code.jquery.com/jquery-latest.js">
  </script>
  <script type="text/javascript">
    setInterval("my_function();",1000); 
    function my_function(){
      $('#refresh').load(location.href + ' #time');
    }
  </script>
</head>
<body>
  <div id="refresh">
  <div id="time">
    <?php echo date('H:i:s');?>
  </div>
  </div>
</body>
</html>
