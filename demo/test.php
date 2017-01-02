<?php
	
	$index = 0;
	
	function Back()
	 {
		$index = $index - 1;
		
	 } 
	 
	 function Forward()
	 {
		$index = $index + 1;
		
	 } 
?>

<html>
    <head>
      <meta charset="UTF-8" >
	  <title>user_pokemon</title>
	  <script src="jquery.js"></script>
	  <link rel="stylesheet" href="semantic.css">
	  <link rel="stylesheet" href="semantic.min.css">
	  <script src="semantic.js"></script>
	  <script src="semantic.min.js"></script>
	  </style>
	  <script>
		function modal(){
			$('.ui.modal')
				.modal('show')
				;
		}	
		</script>
		<script>
		var number;
		var test; 
		function start()
		 {
			var button = document.getElementById( "Back" );
			button.addEventListener( "click", Back, false );
			number = document.getElementById( "No" );
			
			var button = document.getElementById( "Forward" );
			button.addEventListener( "click", Forward, false );
			number = document.getElementById( "No" );
		 }
		 function Back()
		 {
			 <?php Back(); ?>
			test = <?php echo $index;?>;
			number.innerHTML = test;
		 } 

		function Forward()
		 {
			<?php Forward(); ?>
			 test = <?php echo $index;?>;
			number.innerHTML = test;
		 } 
		 
		  window.addEventListener( "load", start, false );
		 </script>
	  </head>
	  <body>
	  <img class="ui medium circular image" src="111.jpg">
	  <i class="large book icon" onclick="modal()"></i>
	  
	  <div class="ui modal">
	  <i class="close icon"></i>
	  <div class="header">
		List of Pokémon
	  </div>
	  <div class="image content">
		<div class="ui medium image">
		  <img src="111.jpg">
		</div>
		<div class="description">
		  <div class="ui header" id="No">No.1</div>
		  <p>Name </p>
		</div>
	  </div>
	  <div class="actions">
		<i class="big toggle left icon" id="Back"></i>
		<i class="big toggle right icon" id="Forward"></i>
	  </div>
	  </div>


	</body>
</html>