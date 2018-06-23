function autoweboffice(url, attr){
	var xmlhttp;
	try {
	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
	try {
	  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
	  xmlhttp = false;
	}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	xmlhttp = new XMLHttpRequest();
	}
  
	var url_request = url+'&url='+encodeURIComponent(window.location)+'&reffer='+encodeURIComponent(document.referrer)+'';
	
	for (var key in attr){
		 url_request = url_request + '&'+key+'='+attr[key];
	}
	
	
	xmlhttp.open('GET', url_request, true);
	xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 4) {
		 if(xmlhttp.status == 200) {
		   // alert(xmlhttp.responseText);
		 }
	  }
	};
	xmlhttp.send(null);
}

autoweboffice(url);
