function logout(){

}


form.onsubmit = function (e) {
  // stop the regular form submission
  e.preventDefault();

  var userID = form.user_id; 


  // construct an HTTP request
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./php_files/connect_logout.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

  // send the collected data as JSON
  xhr.send("user_id="+userID);

  /*xhr.onloadend = function () {
    // done
  };*/
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200) {
    document.open();
    document.write(xhr.responseText);
  }
}
};
