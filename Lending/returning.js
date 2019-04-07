var username = document.getElementById('exampleFormControlInput1');
var b = document.getElementById('button');
if(username=="case 1"){
	b.addEventListener('click',function(){
		window.location.href = "returning-loanList.html";
	});
} 
else if(username=="case 2"){
	b.addEventListener('click',function(){
		alert("Cannot find this name!");
	});
}
else if(username=="case 3"){
	b.addEventListener('click',function(){
		alert("This borrower did not lend any book!");
	});
}