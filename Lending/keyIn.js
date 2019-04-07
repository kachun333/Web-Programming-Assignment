function awesomeClick(){
	var username = document.getElementById("username").value;
	username = username.toLowerCase()
	if(username=="see see ting"){
		window.location.href = "lending-scanBarcode.html";
	}
	else if(username=="clement"){
		alert("This is a blaclisted user!");
	}
	else if(username=="ali"){
		alert("This user had borrowed 5 books!");
	}
	else{
		alert("This username does not exist!");
	}
}