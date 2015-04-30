<html>
<body>
	<label for="text">Input button text:</label><br />
	<input type="text" id="text"><br>

	<label for="link">Input button link:</label><br />
	<input type="text" id="link"><br>
	
	<label for="target">Select target window:</label><br />
	<select id="target">
		<option value="_self">Self</option>
		<option value="_blank">New Window</option>
	</select><br>
	
	<label for="bg_color">Set background color ( example #ffffff ):</label><br />
	<input type="text" id="bg_color"><br>
	
	<label for="font_color">Set font color ( example #ffffff ):</label><br />
	<input type="text" id="font_color"><br>
	
	<label for="bg_color_hvr">Set Background Color On Hover ( example #ffffff ):</label><br />
	<input type="text" id="bg_color_hvr"><br>
	
	<label for="font_color_hvr">Set Font Color On Hover ( example #ffffff ):</label><br />
	<input type="text" id="font_color_hvr"><br>	
	
	<input type="button" id="save" value="Save">
	<input type="button" id="close" value="Close">
	<script type="text/javascript">	
		var tinymceparent = parent.tinyMCE;
		window.addEventListener('DOMContentLoaded', function () {
			document.getElementById("save").addEventListener("click", function(){
				var text = document.getElementById('text').value;
				var link = document.getElementById('link').value;
				var target = document.getElementById('target').value;
				var bg_color = document.getElementById('bg_color').value;
				var font_color = document.getElementById('font_color').value;
				var bg_color_hvr = document.getElementById('bg_color_hvr').value;
				var font_color_hvr = document.getElementById('font_color_hvr').value;
				
				tinymceparent.execCommand( 'mceInsertContent', 0, '[couponer_button text="'+text+'" link="'+link+'" target="'+target+'" bg_color="'+bg_color+'" font_color="'+font_color+'" bg_color_hvr="'+bg_color_hvr+'" font_color_hvr="'+font_color_hvr+'"][/couponer_button]' );
				tinymceparent.activeEditor.windowManager.close(window);			
			}, false);
			
			document.getElementById("close").addEventListener("click", function(){
				tinymceparent.activeEditor.windowManager.close(window);
			}, false);
			
		});
	</script>
</body>
</html> 