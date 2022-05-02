/**
 *  Get Input Fields
 */
 let submitBtn = document.getElementById('submit_btn');
 let nameInput = document.getElementById('name');
 
 /**
  *  Get Error Divs by id
  */
  let nameError = document.getElementById('name_error');
 
  /**
  *  REGEX Patterns
  */
 
  const NAME_REGEX = /^[a-zA-Z-' ]*$/;
 
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
     nameError.innerHTML = "";
     errorExists = false;
  }
 
  function onSubmitForm(evt) {
     resetValues();
 
    /**
     *  Validate first name
     */
    if (nameInput.value === "") {
        showError(nameError, "The first name field is required.")
    }
    else if (!regexValid(NAME_REGEX, nameInput.value)) {
        showError(nameError, "IOnly letters and white spaces are allowed.")
    }

    if (errorExists) {
        evt.preventDefault();
    }
  }