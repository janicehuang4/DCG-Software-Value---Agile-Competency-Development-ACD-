var form=document.getElementById("adminForm");


form.onsubmit = function (e) {
  // stop the regular form submission
  e.preventDefault();

  // collect the form data while iterating over the inputs
  data = {};
  for (var i = 0, ii = form.length; i < ii; ++i) {
    var input = form[i];
    if (input.name) {
        data[input.name] = input.value;
      
        var userID = form[0].value; 

    }//end of if(input.name)
  } //end of for loop 
  alert("Account deleted!");
  this.reset(); 

  // construct an HTTP request
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./php_files/delete_accounts.php", true);
  xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');


  // send the collected data as JSON
  sendval = {"one" : data,"two" : "force"};
  xhr.send(JSON.stringify(sendval));

  xhr.onloadend = function () {
    // done
  };
};
