
function awesomeClick(){
	var barcode = document.getElementById("exampleInputCode").value;
	if(barcode=="0011223344"){
		alert("Book found !");
		window.location.href = "lending-done.html";
	}
	else if(barcode=="0011223345"){
		alert("This book is reserved by others!");
	}
	else if(barcode=="0011223346"){
		alert("Cannot find this book! Please re-enter the bar code again.");
	}
}