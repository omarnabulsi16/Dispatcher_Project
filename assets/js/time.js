function startTime() {
    var today = new Date();
	var n = today.toDateString();
	n = createDate(n);
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
 	document.getElementById('date').innerHTML = n;
    document.getElementById('time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
function createDate(n){
	var res = n.split(" ");
	for(x = 0; x < res.length;x++){
		if(x==0){
			n = res[x]+", "
		}else if(x==2){
			n += res[x]+", "
		}else{
			n += res[x]+" "
		}
	}
	return n;
}
