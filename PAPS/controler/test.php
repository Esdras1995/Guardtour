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

    <?php echo intval(strtotime("00:03:00")-strtotime("00:00:00"));?>
  </div>
  </div>
</body>
</html>
