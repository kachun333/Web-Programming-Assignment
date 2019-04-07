function awesomeClick(){
	var username = document.getElementById("exampleInputName").value;
	if (username=="see see ting") {
		alert("The user has existed!");
	}
	else if(username==null || username==""){
		alert("Please fill up your detail! ");
	}
	else{
			alert("Welcome, new friend!");
			window.location.href = "lending.html";
	}
}