function stringCheck(val) {
  return val.toLowerCase() != val.toUpperCase();
}

function checkEveryChar(val) {
	for (var i = 0; i < val.length; i++) {
		if (stringCheck(val[i])==true || val[i]=='.' || val[i]=='-' || val[i]==' ') {
			continue;
		}else{
			return false;
		}
	}
	return true;
}

function emailBreakdown(email) {
		if (email.indexOf("@") == -1) {
	        return false;
	    }
	    var div = email.split("@");
	    var dot = div[1].indexOf(".");
	    var countdot = div[1].split(".").length-1;
	   // document.getElementById('dump').innerHTML = div[1].split(".");
	    if (dot == -1 || countdot > 2) {
	        return false;
	    }
	    return true;
	}