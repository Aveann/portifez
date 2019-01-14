/*Script sublime qui cache containerImg si on désactive
l'illustration du blog. */
var rad = document.getElementById('input_bool').getElementsByTagName('input');
var prev = null;
for(var i = 0; i < rad.length; i++) {
	rad[i].addEventListener('change', function() {
		(prev)? console.log(prev.value):null;
		if(this !== prev) {
			prev = this;
		}
		console.log(this.value)
		if(this.value == 0){
			document.getElementById('containerImg').style.display = "none";
		} else {
			document.getElementById('containerImg').style.display = "block";
		}
	});
}
