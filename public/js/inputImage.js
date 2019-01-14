/* Magnifique script permettant d'avoir un aperçu de l'image avant 
qu'elle se charge
*/
document.getElementById("input_image").onchange = function() {loadFile(event)};

var loadFile = function(event) {
	var reader = new FileReader();
	reader.onload = function(){
	  var output = document.getElementById('output_image');
	  output.src = reader.result;
	};
	reader.readAsDataURL(event.target.files[0]);
};