document.getElementById("btn").addEventListener("click",validate);


function validate(){
    
    //Checking all the fields in Personal Details section are filled.
    var flag=0;
    var form = document.getElementById("personalform");
    var noofelements = form.elements.length;
    var inputs = form.elements;
    for(var i=0; i<noofelements; i++){
        if(inputs[i].value == "")
             flag=1;
    }

    //Checking all the fields in Contact Information are filled.
    var form2 = document.getElementById("contactform");
    var noofelements2 = form2.elements.length;
    var inputs2 = form2.elements;
    noofelements2--; //To remove the button from form element
    for(var i=0; i<noofelements2; i++){
        if(inputs2[i].value == "")
            flag=1;
    }

    //If any field is empty , alert message is displayed.
    flag==0 ? null : alert("Kindly fill all the fields." + noofelements2);


    //To check pincode is exactly 6 digits.
    var pincode = document.getElementById("pincode").value;
    if(pincode.length!= 6  ||  (isNaN(pincode)))
        alert("Kindly enter right pincode.\nFor eg. 602501");

    //To check phonenumber is exactly 10 digits.
    var phone = document.getElementById("phone").value;
    if(phone.length!= 10 || (isNan(phone)))
        alert("Kindly fill right phone number with exactly 10 digits.");

    //To check the email is valid.
    var email = document.getElementById("email").value;
    var regex = /^[a-zA-Z0-9._]+@[a-zA-Z0-9._-]+\.[a-z]{2,}$/;
    if(!regex.test(email))
        alert("Kindly fill right email address.");

}