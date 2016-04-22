var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject() {
	var xmlHttp;

	if (window.ActiveXObject) { //this determines if it's IE or not.
		try{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			xmlHttp = false;
		} 
		} else { //for any other browser
			try{
			xmlHttp = new XMLHttpRequest();
		} catch(e) {
			xmlHttp = false;
		}
		}
	

	if (!xmlHttp)  //if everything goes wrong, as it is wont to do
		alert('Someting went wrong. readyState = ' + xmlHttp.readyState + ', Status = ' + xmlHttp.status);
	 else 
		return xmlHttp;
	
}

function process() {
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
		food = encodeURIComponent(document.getElementById("userInput").value);
		xmlHttp.open("GET", "preferences.php?food=" + food, true);
		xmlHttp.onreadystatechange = handleServerResponse;
		xmlHttp.send(null);
	} else {
		setTimeout('process()', 500);
	}
}

function handleServerResponse() {
	if (xmlHttp.readyState ==4) {
		if (xmlHttp.status == 200) {
			xmlResponse = xmlHttp.responseXML;
			xmlDocumentElement = xmlResponse.documentElement;
			message = xmlDocumentElement.firstChild.data;
			food = food.toLowerCase();
			food = food.replace(/\s+/g, '');
			if (food == "music") {
				document.getElementById("underInput").innerHTML = '<br><br><iframe style="border: 0; width: 350px; height: 470px;" src="https://bandcamp.com/EmbeddedPlayer/album=2699361877/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless><a href="http://threeninjas.net/album/the-sadness-will-last-forever">The Sadness Will Last Forever by Three Ninjas &amp; His Weird Old Tricks</a></iframe>';
				//setTimeout('process()', 500);
			} else { 
				document.getElementById("underInput").innerHTML = '<h4>' + message + '</h4>';
				setTimeout('process()', 500);
		} 
	}
}
}