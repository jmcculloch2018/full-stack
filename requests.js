function fetchData(id) {
    alert("about to request page");

    if (id == 1) {
        console.log("new word pair");
        word = document.getElementById("word");
        first = document.getElementById("first");
        last = document.getElementById("last");
        httpGetAsync("http://localhost/full-stack/submitNewPair.php?word=" + word + "&first=" + first + "&last=" + last, processPage);
    }
    if (id == 2) {
        word = document.getElementById("word-lookup");
        httpGetAsync("http://localhost/full-stack/getWord.php?word=" + word, processPage);
        console.log("wordlookup");

    }
    if (id == 3) {
        first = document.getElementById("first-lookup");
        last = document.getElementById("last-lookup");
        httpGetAsync("http://localhost/full-stack/getTeacher.php?first=" + first + "&last=" + last, processPage);
        console.log("teacherlookup");

    }

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
    document.getElementById("s").innerHTML = responseText;
}