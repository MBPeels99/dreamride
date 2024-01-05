const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

////////////////////// Login form - validation /////////////////////////
function ValidateLogin()
{
    var radioButtons = document.getElementsByName("login-form");
    for(var i = 0; i < radioButtons.length; i++)
    {
        console.log(radioButtons.length);
        if(radioButtons[i].checked == true)
        {
            if(confirm("You have selected to log in as " + radioButtons[i].value + ". Is that correct?")) {
                return true;
            }
            else {
                return false;
            }
        }  
    }
    alert("Do you want to login as Parent or as Child?");
    return false;
}


    //////////////////////////////////////////////// FIRST NAME NOT EMPTY //////////////////////////////////////////////////////
    function validateFirstName() 
    {
        var first_name = document.getElementById("first_name").value;
        var error = "";
  
        var error_style = document.getElementById("first_name");
        var style_input_field = document.getElementById("input_field_first_name");

        if (first_name == null || first_name == "") {          
            // error message as placeholder in the input field with different CSS styling for the placeholder
            error = "First Name may not be empty.";
            error_style.placeholder = error;

            error_style.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
            style_input_field.style.setProperty("background-color", "#ff8630");

            return false;
        }
        else {
            style_input_field.style.setProperty("background-color", "#f0f0f0");
            error_style.setAttribute("style", "font-weight: 500; font-size: 1rem;");
            return true;
        }
    }

//////////////////////////////////////////////// LAST NAME NOT EMPTY //////////////////////////////////////////////////////
    function validateLastName() 
    {
        var last_name = document.getElementById("last_name").value;
        var error = "";

        var error_style = document.getElementById("last_name");
        var style_input_field = document.getElementById("input_field_last_name");

        if (last_name == null || last_name == "") {          
            error = "Last Name may not be empty.";
            error_style.placeholder = error;

            error_style.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
            style_input_field.style.setProperty("background-color", "#ff8630");

            return false;
        }
        else {
            style_input_field.style.setProperty("background-color", "#f0f0f0");
            error_style.setAttribute("style", "font-weight: 500; font-size: 1rem;");
            return true;
        }
    }

//////////////////////////////////////////////// DATE OF BIRTH NOT EMPTY //////////////////////////////////////////////////////
function validateDateOfBirth() 
{
    var error_style = document.getElementById("date_of_birth");
    var date_of_birth = error_style.value;
    var error = "";

    
    var style_input_field = document.getElementById("input_field_date_of_birth");

    if (date_of_birth == null || date_of_birth == "") {          
        error = "Date of birth is a must to prove majority.";
        error_style.placeholder = error;

        error_style.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
        style_input_field.style.setProperty("background-color", "#ff8630");

        return false;
    }
    else {
        var dob = new Date(date_of_birth);
        //calculate month difference from current date in time
        var month_diff = Date.now() - dob.getTime();
        
        //convert the calculated difference in date format
        var age_dt = new Date(month_diff); 
        
        //extract year from date    
        var year = age_dt.getUTCFullYear();
        
        //now calculate the age of the user
        var age = Math.abs(year - 1970);
        
        //display the calculated age
        if (age < 18 ){
            error = "Age is below 18";           

            error_style.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
            style_input_field.style.setProperty("background-color", "#ff8630");
            alert("You must be over the age of 18 to create an account.")
            return false;
        }
        else{
            style_input_field.style.setProperty("background-color", "#f0f0f0");
            error_style.setAttribute("style", "font-weight: 500; font-size: 1rem;");
            error_style.innerHTML = age;
            return true;
        }
    }

}

//////////////////////////////////////////////// CHECK EMAIL //////////////////////////////////////////////////////
function validateEmail() 
{
    var email = document.getElementById("email");
    var style_email_field = document.getElementById("input_field_email");
    var email_to_check = email.value;
    var error = "";

    if (email_to_check == null || email_to_check == "") 
    {        
        error = "Email must be filled out.";
        email.value = error;
        email.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
        style_email_field.style.setProperty("background-color", "#ff8630");
        return false;
    }
    else
    {      
        var regexp = /^([a-zA-Z0-9]+[\-.\w]*)@([.\w-]+\.[a-zA-Z]+)$/;  // my try for email validation

        if(regexp.test(email_to_check))
        {
            style_email_field.style.setProperty("background-color", "#f0f0f0");
            email.setAttribute("style", "font-weight: 500; font-size: 1rem;");
            return true; 
        }
        else
        {
            error = "This is not a valid email.";
            email.value = error;
            email.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
            style_email_field.style.setProperty("background-color", "#ff8630");
            return false;
        }
    }
}

//////////////////////////////////////////////// PASSWORD NOT EMPTY //////////////////////////////////////////////////////
function validatePassword() 
{
    var password_field = document.getElementById("password");
    var style_password_field = document.getElementById("input_field_password");
    var password = password_field.value;
    var error = "";

    if (password == null || password == "") {          
        // error message as label under the field
        error = "Password must be filled out.";
        password_field.placeholder = error;
        style_password_field.style.setProperty("background-color", "#ff8630");
        password_field.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
        return false;
    }
    else{
        style_password_field.style.setProperty("background-color", "#f0f0f0");
        password_field.setAttribute("style", "font-weight: 500; font-size: 1rem;");
        return true;
    }
}

//////////////////////////////////////////////// COUNTRY NOT EMPTY //////////////////////////////////////////////////////
function validateCountry() 
{
    error_style=document.getElementById("country");
    var style_input_field = document.getElementById("input_field_country");
    var country = error_style.value;

    if (country == null || country == "not_selected") {          
        error_style.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
        error_style.style.setProperty("background-color", "#ff8630");
        style_input_field.style.setProperty("background-color", "#ff8630");
        return false;
    }
    else{
        error_style.style.setProperty("background-color", "#f0f0f0");
        style_input_field.style.setProperty("background-color", "#f0f0f0");
        error_style.setAttribute("style", "font-weight: 500; font-size: 1rem;");
        return true;
    }
}

//////////////////////////////////////////////// LANGUAGE NOT EMPTY //////////////////////////////////////////////////////
function validateLanguage() 
{
    error_style=document.getElementById("language");
    var style_input_field = document.getElementById("input_field_language");
    var language = error_style.value;

    if (language == null || language == "not_selected") {          
        error_style.setAttribute("style", "font-weight: 600; font-size: 0.7rem;");
        error_style.style.setProperty("background-color", "#ff8630");
        style_input_field.style.setProperty("background-color", "#ff8630");
        return false;
    }
    else{
        error_style.style.setProperty("background-color", "#f0f0f0");
        style_input_field.style.setProperty("background-color", "#f0f0f0");
        error_style.setAttribute("style", "font-weight: 500; font-size: 1rem;");
        return true;
    }
}

//////////////////////////////////////////////// TERMS AND CONDITIONS NOT EMPTY //////////////////////////////////////////////////////
function validateTermsAndConditions()
{
    var terms_and_conditions = document.getElementById("terms_and_conditions");
    var status_checkbox = document.getElementById("alert_terms_and_conditions");

    if (terms_and_conditions.checked) { 
        status_checkbox.style.setProperty("background-color", "#f8ba1d");         
        return true;
    }
    else {
        status_checkbox.style.setProperty("background-color", "#ff8630");
        alert("You must agree with our Terms and Conditions.");
        return false
    }
    
}

//////////////////////////////////////////////// PARENT CONSENT NOT EMPTY //////////////////////////////////////////////////////
function validateParentConsent()
{
    var parent_consent = document.getElementById("parent_consent");
    var status_checkbox = document.getElementById("alert_parent_consent");

    if (parent_consent.checked) {          
        status_checkbox.style.setProperty("background-color", "#f8ba1d");         
        return true;
    }
    else {
        status_checkbox.style.setProperty("background-color", "#ff8630");
        alert("You must agree to support/supervise your child's activity as a parent.");
        return false;
    }

}



////////////////////////////////////////////////// VALIDATE REGISTRATION FORM ///////////////////////////////////////////
function ValidateParentRegistration()
{
    if (
        validateFirstName() &&
        validateLastName() &&
        validateDateOfBirth() &&
        validateEmail() &&
        validatePassword() &&
        validateCountry() &&
        validateLanguage() && 
        validateTermsAndConditions() &&
        validateParentConsent())
        {
            return true; // now PHP is allowed to run   
        }
        else {
            alert("You must fill in all of the required fields!");
            
            return false
        }
        
      
}