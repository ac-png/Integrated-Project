/**
 *  Get Input Fields
 */
let submitBtn = document.getElementById('submit_btn');
let headlineInput = document.getElementById('headline');
let articleInput = document.getElementById('article');
let summaryInput = document.getElementById('summary');
let dateInput = document.getElementById('date');
let timeInput = document.getElementById('time');
let categoryInput = document.getElementById('category');
let authorInput = document.getElementById('author');

/**
 *  Get Error Divs by id
 */
 let headlineError = document.getElementById('headline_error');
 let articleError = document.getElementById('article_error');
 let summaryError = document.getElementById('summary_error');
 let dateError = document.getElementById('date_error');
 let timeError = document.getElementById('time_error');
 let categoryError = document.getElementById('category_error');
 let authorError = document.getElementById('author_error');

 /**
 *  REGEX Patterns
 */
                 
 const DATE_REGEX = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;
 const TIME_REGEX = /^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/;

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
    headlineError.innerHTML = "";
    articleError.innerHTML = "";
    summaryError.innerHTML = "";
    dateError.innerHTML = "";
    timeError.innerHTML = "";
    categoryError.innerHTML = "";
    authorError.innerHTML = "";
    errorExists = false;
 }

 function onSubmitForm(evt) {
    resetValues();
    
    /**
     *  Validate headline
     */
    if (headlineInput.value === "") {
        showError(headlineError, "The headline field is required.")
    }

    /**
     *  Validate article
     */
    if (articleInput.value === "") {
        showError(articleError, "The article field is required.")
    }

    /**
     *  Validate summary
     */
    if (summaryInput.value === "") {
        showError(summaryError, "The summary field is required.")
    }

    /**
     *  Validate date
     */
    if (dateInput.value === "") {
        showError(dateError, "The date field is required.")
    }
    else if (!regexValid(DATE_REGEX, dateInput.value)) {
        showError(dateError, "Invalid date format")
    }

    /**
     *  Validate time
     */
    if (timeInput.value === "") {
        showError(timeError, "The time field is required.")
    }
    else if (!regexValid(TIME_REGEX, timeInput.value)) {
        showError(timeError, "Invalid time format")
    }

    /**
     *  Validate category
     */
     if (categoryInput.value === "") {
        showError(categoryError, "The category field is required.")
    }

    /**
     *  Validate author
     */
     if (authorInput.value === "") {
        showError(authorError, "The author field is required.")
    }

    if (errorExists) {
        evt.preventDefault();
    }
 }