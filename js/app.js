var app = {
  init: function() {
    // Ciblage des éléments du DOM
    app.errorsArea = document.getElementById('errors');
    app.loginForm = document.getElementById('login-form');
    app.fields = document.querySelectorAll('.field-input');

    // Écouteur d'événement pour chaque champ
    for (var fieldIndex = 0; fieldIndex < app.fields.length; fieldIndex++) {
      var field = app.fields[fieldIndex];
      field.addEventListener('blur', app.isInputValid);
    }

    // Écouteur d'événement pour tous les champs (soumission du formulaire)
    app.loginForm.addEventListener('submit', app.isFormValid);
  },

  errors: [],

  isInputValid: function(evt) {
    var field = evt.target;
    app.checkField(field);
  },
  
  isFormValid: function (evt) {
    app.clearErrors();
    if (app.hasErrors()) {
      evt.preventDefault();
      app.showErrors();
    }
  },

  hasErrors: function () {
    var usernameField = document.getElementById('field-username');
    var passwordField = document.getElementById('field-password');

    var usernameValid = app.checkField(usernameField);
    var passwordValid = app.checkField(passwordField);

    return !usernameValid || !passwordValid;
  },

  checkField: function(field) {
    field.className = 'field-input';

    if (field.value.length < 3) {
      app.errors.push(field.placeholder + ' doit contenir au moins 3 caractères');
      field.classList.add('invalid');
      return false;
    }

    field.classList.add('valid');
    return true;
  },

  clearErrors: function() {
    app.errors = [];
    app.errorsArea.innerHTML = '';
  },

  showErrors: function() {
    for (var errorIndex = 0; errorIndex < app.errors.length; errorIndex++) {
      app.errorsArea.innerHTML += '<p class="error">' + app.errors[errorIndex] + '</p>';
    }
  },
};

document.addEventListener('DOMContentLoaded', app.init);
