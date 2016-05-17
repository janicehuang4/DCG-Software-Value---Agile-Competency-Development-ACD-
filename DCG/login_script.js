var form=document.getElementById("loginForm");


form.onsubmit = function (e) {
  // stop the regular form submission
  e.preventDefault();

  // collect the form data while iterating over the inputs
  var data = {};
  for (var i = 0, ii = form.length; i < ii; ++i) {
    var input = form[i];
    if (input.id) {
      data[input.id] = input.value;
    }
  }
  
  console.log(data['password']);
  var password = sjcl.hash.sha256.hash(data['password']);
  password = sjcl.codec.hex.fromBits(password);
  //data['password'] = sjcl.hash.sha256.hash(data['password']);
  console.log(String(password));
  // construct an HTTP request
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./php_files/connect_login.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

  // send the collected data as JSON
  xhr.send("user_id="+data['user_id']+"&password="+password);

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
