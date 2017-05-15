function fetchData() {
    //alert("about to request page");
    word = document.getElementById("word");
    first = document.getElementById("first");
    last = document.getElementById("last");
    httpGetAsync("http://localhost/full-stack/submitnewpair.php?word="+word+"&"+first+"&"+last, processPage);

}





//starts a request and then runs the callback method when it is loaded
function httpGetAsync(theUrl, callbackWhenPageLoaded) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callbackWhenPageLoaded(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous 
    xmlHttp.send(null);
}



//This callback method is a bit boring as it just prints to the console.
//Add more fun or call another method from inside to do something interesting.
function processPage(responseText) {
    document.getElementById("reportArea").innerHTML = responseText;
}