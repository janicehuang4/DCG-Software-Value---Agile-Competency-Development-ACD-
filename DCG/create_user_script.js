var form=document.getElementById("adminForm");


form.onsubmit = function (e) {
  // stop the regular form submission
  e.preventDefault();

  // collect the form data while iterating over the inputs
  data = {};
  data.past_roles = [];
  data.assessment_records = [];
  for (var i = 0, ii = form.length; i < ii; ++i) {
    var input = form[i];
    if (input.name) {
      if (input.name == "past_roles" || input.name == "assessment_records"){
        data[input.name].push(input.value);
      } else {
        data[input.name] = input.value;
      }

      var first = form[0].value; 
      var last = form[1].value; 
      var email = form[2].value; 
      var userType = form[3].selectedIndex;
      var userID = form[4].value; 
      var password = form[5].value; 
      var managerName = form[6].value; 
      var payGrade = form[7].value; 
      var ogranizationID = form[8].value; 
      var currentRole = form[9].value; 


      if (first=="" || last=="" || email=="" || password=="" || userType<1 || userID=="" || 
        managerName=="" || payGrade=="" || ogranizationID=="" || currentRole==""){
          alert ("Pleaase fill out the required fields."); 
          return false;
      }
    }//end of if(input.name)
  } //end of for loop 

  while (data.past_roles.length < 5){data.past_roles.push("not provided"); };
  while (data.assessment_records.length < 6){data.assessment_records.push("not provided"); };
  alert("Account created!");
  this.reset(); 

  // construct an HTTP request
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./php_files/create_accounts.php", true);
  xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');


  // send the collected data as JSON
  sendval = {"one" : data,"two" : "force"};
  xhr.send(JSON.stringify(sendval));

  xhr.onloadend = function () {
    // done
  };
};
