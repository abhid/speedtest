onmessage = function(evt) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:
         postMessage(xhttp.responseText);
      }
  };
  xhttp.open("GET", "/backend/mtr.php", true);
  xhttp.send();
};
