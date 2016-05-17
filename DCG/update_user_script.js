var form=document.getElementById("adminForm");


form.onsubmit = function (e) {
  // stop the regular form submission
  e.preventDefault();

  // collect the form data while iterating over the inputs
  data = {};
  data.past_roles = [];
  data.assessment_records = [];
  for (var i = 0; i < form.length; i++) {
    var input = form[i];
    if (input.name) {
      if (input.name == "past_roles" || input.name == "assessment_records"){
        data[input.name].push(input.value);
      } else {
        data[input.name] = input.value;
      }


      var userID = form[0].value; 
      if (userID==""){
          alert ("Pleaase fill out the required fields."); 
          return false;
      }
    }//end of if(input.name)
  } //end of for loop 
  while (data.past_roles.length < 5){data.past_roles.push("not provided"); };
  while (data.assessment_records.length < 6){data.assessment_records.push("not provided"); };
  alert("Account updated!");
  this.reset(); 

  // construct an HTTP request
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./php_files/update_accounts.php", true);
  xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');


  // send the collected data as JSON
  sendval = {"one" : data,"two" : "force"};
  xhr.send(JSON.stringify(sendval));

  xhr.onloadend = function () {
    // done
  };
};
