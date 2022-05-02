/**
 *  Get Input Fields
 */
 let submitBtn = document.getElementById('submit_btn');
 let fnameInput = document.getElementById('fname');
 let lnameInput = document.getElementById('lname');
 let linkInput = document.getElementById('link');
 
 /**
  *  Get Error Divs by id
  */
  let fnameError = document.getElementById('fname_error');
  let lnameError = document.getElementById('lname_error');
  let linkError = document.getElementById('link_error');
 
  /**
  *  REGEX Patterns
  */
 
  const FNAME_REGEX = /^[a-zA-Z-' ]*$/;
  const LNAME_REGEX = /^[a-zA-Z-' ]*$/;
 
  submitBtn.addEventListener('click', onSubmitForm);
 
  let errorExists = false;
 
  function showError(errorField, errorMessage) {
     errorExists = true;
     errorField.innerHTML = errorMessage;
  }
 
  function regexValid(regex, str) {
      return regex.test(str);
  }
 
  function resetValues() {
     fnameError.innerHTML = "";
     lnameError.innerHTML = "";
     linkError.innerHTML = "";
     errorExists = false;
  }
 
  function onSubmitForm(evt) {
     resetValues();
 
    /**
     *  Validate first name
     */
    if (fnameInput.value === "") {
        showError(fnameError, "The first name field is required.")
    }
    else if (!regexValid(FNAME_REGEX, fnameInput.value)) {
        showError(fnameError, "IOnly letters and white spaces are allowed.")
    }

    /**
     *  Validate last name
     */
     if (lnameInput.value === "") {
        showError(lnameError, "The last name field is required.")
    }
    else if (!regexValid(LNAME_REGEX, lnameInput.value)) {
        showError(lnameError, "Only letters and white spaces are allowed.")
    }

    /**
     *  Validate link
     */
    if (linkInput.value === "") {
        showError(linkError, "The link field is required.")
    }

    if (errorExists) {
        evt.preventDefault();
    }
  }