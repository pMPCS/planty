/* global grecaptcha */
(function () {
  const loadingClass = "is-loading";

  function formatError(error) {
    if (Array.isArray(error) && error.length) {
      return error.map((e) => e.message).join("<br />");
    }

    if (typeof error === "object") return error.message;
  }

  function interceptResponse(response) {
    return response.json().then((body) => {
      if (!response.ok) {
        throw new Error(formatError(body.data));
      }

      return body;
    });
  }

  function postData(url, data) {
    const { makeAjaxRequest } = window.BreakdanceFrontend.utils;
    const payload = {
      method: "POST",
      credentials: "same-origin", // Needed in order to store cookies.
      body: data,
    };

    return makeAjaxRequest(url, payload).then(interceptResponse);
  }

  function createMessage(text, type = "success", onDismiss = null) {
    const node = document.createElement("div");
    node.innerHTML = text;
    node.classList.add("breakdance-form-message");
    node.classList.add("breakdance-form-message--" + type);

    if (typeof onDismiss === "function") {
      node.classList.add("breakdance-form-message-dismissable");

      const dismissWrapper = document.createElement("div");
      dismissWrapper.classList.add("breakdance-form-message-dismiss");

      const dismissButton = document.createElement("button");
      dismissButton.classList.add("breakdance-form-message-dismiss-button");
      dismissButton.innerHTML = "&times;";
      dismissButton.addEventListener("click", onDismiss);

      dismissWrapper.appendChild(dismissButton);
      node.appendChild(dismissWrapper);
    }

    return node;
  }

  function createErrorMessage(text) {
    return createMessage(text, "error");
  }

  function resetForm(form) {
    form.reset();

    // Reset file fields
    const fileFields = form.querySelectorAll(".breakdance-form-field--file");

    fileFields.forEach((field) => {
      const fileText = field.querySelector(".breakdance-form-file-upload__text");

      if (fileText) {
        const emptyText = field.querySelector(".breakdance-form-file-upload__input").dataset.i18nEmptyText;
        fileText.textContent = emptyText;
      }

      const list = field.querySelector(".breakdance-form-files-list");

      if (list) {
        list.innerHTML = "";
        list.classList.remove("is-files-visible");
      }
    });

    // Reset conditional fields and steps
    resetConditionalFields(form);
    if (form.dataset.steps >= 1) resetSteps(form);
  }

  function safeEval(code, form, formData) {
    const formValues = {
      post_id: formData.get("post_id"),
      form_id: formData.get("form_id"),
    };

    for (const [name, value] of formData.entries()) {
      if (name.startsWith("fields[")) {
        const parts = name.match(/\[/g).length;
        const index = name.match(/\[(.*?)\]/)[1];

        if (parts >= 2) {
          if (!formValues[index]) {
            formValues[index] = [];
          }
          formValues[index].push(value);
        } else {
          formValues[index] = value;
        }
      }
    }

    try {
      eval(code);
    } catch (e) {
      console.warn("Could not run Custom JavaScript.", e);
    }
  }

  function getRecaptchaToken(apiKey) {
    const payload = { action: "breakdance_submit" };

    return new Promise((resolve, reject) => {
      grecaptcha.ready(() => {
        try {
          const token = grecaptcha.execute(apiKey, payload);
          return resolve(token);
        } catch (error) {
          return reject(error);
        }
      });
    });
  }

  function getOptions(form) {
    const options = JSON.parse(form.getAttribute("data-options"));

    const defaultOptions = {
      name: "empty",
      ajaxUrl: null,
      successMessage: null,
      errorMessage: null,
      clearOnSuccess: true,
      hideOnSuccess: false,
      redirectUrl: null,
      customJavaScript: {},
      popupsOnSuccess: [],
      popupsOnError: [],
      recaptcha: {
        key: null,
        enabled: false,
      },
    };

    if (!options) {
      return defaultOptions;
    }

    return Object.assign({}, defaultOptions, options);
  }

  async function onSubmit(event) {
    event.preventDefault();

    const form = event.currentTarget;
    const loading = form.classList.contains(loadingClass);
    const options = getOptions(form);

    if (loading) return;

    const formData = new FormData(form);
    formData.append("action", `breakdance_form_${options.slug}`);

    beforeSubmit(form);

    if (options.recaptcha.enabled) {
      try {
        const token = await getRecaptchaToken(options.recaptcha.key);
        formData.append("recaptcha_token", token);
      } catch (error) {
        console.error(error);
      }
    }

    postData(options.ajaxUrl, formData)
      .then((response) => onRequestSuccess(response, form, formData))
      .catch((error) => onRequestError(error, form, formData))
      .finally(() => afterSubmit(form));
  }

  function beforeSubmit(form) {
    form.classList.add(loadingClass);

    const messages = form.parentElement.querySelectorAll(".breakdance-form-message");

    messages.forEach((msg) => {
      msg.remove();
    })
  }

  function afterSubmit(form) {
    form.classList.remove(loadingClass);
  }

  function onRequestError(error, form, formData) {
    console.debug("[BREAKDANCE] Received a form error:", error.message);

    const options = getOptions(form);
    const message =
      error.message || options.errorMessage || "An unexpected error occurred.";
    const errorNode = createErrorMessage(message);
    form.after(errorNode);

    if (options.popupsOnError.length > 0) {
      options.popupsOnError.forEach((errorPopup) => {
        if (errorPopup.popup && errorPopup.action) {
          BreakdancePopup.runAction(errorPopup.popup, errorPopup.action);
        }
      });
    }

    safeEval(options.customJavaScript?.js_on_error, form, formData);
  }

  function onRequestSuccess(response, form, formData) {
    console.debug("[BREAKDANCE] Received form response:", response);

    const options = getOptions(form);
    const redirectOnSuccess = options.redirect && options.redirectUrl;

    if (options.successMessage && !redirectOnSuccess) {
      let messageNode = createMessage(options.successMessage);

      if (options.hideOnSuccess) {
        form.classList.add("breakdance-form--hidden");
        messageNode = createMessage(options.successMessage, "success", () => {
          form.classList.remove("breakdance-form--hidden");
          messageNode.remove();
        });
      }

      form.after(messageNode);
    }

    safeEval(options.customJavaScript?.js_on_success, form, formData);

    if (options.clearOnSuccess) {
      resetForm(form);
    }

    if (options.popupsOnSuccess.length > 0) {
      options.popupsOnSuccess.forEach((successPopup) => {
        if (successPopup.popup && successPopup.action) {
          BreakdancePopup.runAction(successPopup.popup, successPopup.action);
        }
      });
    }

    if (redirectOnSuccess) {
      location.href = options.redirectUrl;
    }
  }

  function onInputUpdate(event) {
    const parent = event.currentTarget.closest(".breakdance-form-field");
    const activeClass = "breakdance-form-field--filled";

    if (!parent) return;

    if (event.currentTarget.value.length) {
      parent.classList.add(activeClass);
    } else {
      parent.classList.remove(activeClass);
    }
  }

  function removeFile(input, fileToRemove, fileIndex) {
    const dt = new DataTransfer();

    for (let file of input.files) {
      if (file !== fileToRemove) {
        dt.items.add(file);
      }
    }

    input.files = dt.files;
    onFileInputChange(input);
  }

  function maybeShowInlineFileValidation({ input, numOfFiles, maxNumOfFiles, i18nError }) {
    const parentField = input.closest(".breakdance-form-field");
    const oldMsg = parentField.querySelector(".breakdance-form-message");
    // input.setCustomValidity("");

    if (oldMsg) oldMsg.remove();

    if (!maxNumOfFiles) return; // No max value set, unlimited files is allowed.
    if (numOfFiles <= maxNumOfFiles) return;

    const errorMessage = createErrorMessage(i18nError.replace("%n", `${maxNumOfFiles}`)); // Only %n file(s) allowed.
    parentField.appendChild(errorMessage);
    // input.setCustomValidity(i18nError.replace("%n", `${maxNumOfFiles}`));
  }

  function updateFilesList(input, files, listNode) {
    const fragment = document.createDocumentFragment();

    files.forEach((file, index) => {
      const li = document.createElement("li");
      const size = file.size < 1000000 ?
        Math.floor(file.size / 1000) + " KB" :
        Math.floor(file.size / 1000000) + " MB";

      // Name
      const nameNode = document.createElement("span");
      nameNode.appendChild(document.createTextNode(file.name));
      nameNode.classList.add("breakdance-form-files-list-item__name");

      // Size
      const sizeNode = document.createElement("span");
      sizeNode.appendChild(document.createTextNode(size));
      sizeNode.classList.add("breakdance-form-files-list-item__size");

      // Delete Button
      const deleteBtn = document.createElement("button");
      deleteBtn.classList.add("breakdance-form-files-list-item__delete");
      deleteBtn.setAttribute("aria-label", "Delete File");
      deleteBtn.setAttribute("type", "button");

      deleteBtn.addEventListener("click", () => {
        removeFile(input, file, index);
      })

      li.appendChild(nameNode);
      li.appendChild(sizeNode);
      li.appendChild(deleteBtn);
      li.classList.add("breakdance-form-files-list-item");

      fragment.appendChild(li);
    });

    listNode.innerHTML = "";
    listNode.appendChild(fragment);
    listNode.classList.add("is-files-visible");
  }

  function onFileInputChange(input) {
    const files = Array.from(input.files);
    const names = files.map((f) => f.name);
    const maxNumOfFiles = Number(input.dataset.maxFiles);
    const i18nFilledText = input.dataset.i18nFilledText;
    const i18nError = input.dataset.i18nErrorText;

    maybeShowInlineFileValidation({
      input,
      numOfFiles: files.length,
      maxNumOfFiles,
      i18nError
    });

    // Inline Upload
    const textNode = input.parentElement.querySelector(
      ".breakdance-form-file-upload__text"
    );

    if (textNode) {
      if (names.length > 1) {
        textNode.innerHTML = i18nFilledText.replace("%n", `${names.length}`); // Text: %n files
      } else {
        textNode.innerHTML = names[0]; // Show file name if only one selected
      }
    }

    // Drag and Drop
    const listNode = input.closest(".breakdance-form-field--file").querySelector(".breakdance-form-files-list");
    if (!listNode) return;

    updateFilesList(input, files, listNode);
  }

  function bindEvents(form) {
    bindFileEvents(form);

    const inputs = Array.from(form.querySelectorAll("input, select, textarea"));

    inputs.forEach((input) => {
      input.addEventListener("input", onInputUpdate);
    });

    form.addEventListener("submit", onSubmit);
  }

  function bindDropzone(dropzone) {
    const dragOver = (event) => {
      event.preventDefault();
      event.stopPropagation();
      dropzone.classList.add("is-dragging");
    };

    const dragLeave = (event) => {
      event.preventDefault();
      event.stopPropagation();
      dropzone.classList.remove("is-dragging");
    };

    const drop = (event) => {
      event.preventDefault();
      event.stopPropagation();

      const fileInput = dropzone.querySelector("input[type='file']");

      if (fileInput) {
        fileInput.files = event.dataTransfer.files;
        onFileInputChange(fileInput);
      }
    };

    dropzone.addEventListener("dragover", dragOver);
    dropzone.addEventListener("dragenter", dragOver);

    dropzone.addEventListener("dragleave", dragLeave);
    dropzone.addEventListener("dragend", dragLeave);
    dropzone.addEventListener("drop", dragLeave);

    dropzone.addEventListener("drop", drop);
  }

  function bindFileEvents(form) {
    const dropZones = Array.from(
      form.querySelectorAll(".breakdance-form-file-upload")
    );
    const inputs = Array.from(
      form.querySelectorAll(".breakdance-form-file-upload__input")
    );

    inputs.forEach((input) =>
      input.addEventListener("change", () => {
        if (!input.files.length) return;
        onFileInputChange(input);
      })
    );

    dropZones.forEach((dropzone) => bindDropzone(dropzone));
  }

  function unbindEvents(form) {
    const inputs = Array.from(form.querySelectorAll("input, select, textarea"));

    inputs.forEach((input) => {
      input.removeEventListener("input", onInputUpdate);
    });

    form.removeEventListener("submit", onSubmit);
  }

  function scrollIntoViewIfNeeded(element) {
    const rect = element.getBoundingClientRect();
    const notVisible = rect.top < 0;

    if (notVisible) {
      element.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  }

  function initConditionalFields(form, attachEventListeners = false) {
    const inputs = Array.from(
      form.querySelectorAll("input, select, textarea, .form-input-html")
    );

    inputs.forEach((input) => {
      const { conditionalFieldId, conditionalValue, conditionalOperand } =
        input.dataset;
      if (!conditionalFieldId) {
        return;
      }
      const conditionalFields = form.querySelectorAll(
        `[name="fields[${conditionalFieldId}]"],[name="fields[${conditionalFieldId}][]"]`
      );
      const wrapper = input.closest(".breakdance-form-field");

      // Show or hide conditional field on change
      conditionalFields.forEach((conditionalField) => {
        const runValidation = () => {
          showOrHideConditionalField(
            form,
            input,
            wrapper,
            conditionalFieldId,
            conditionalValue,
            conditionalOperand
          );
        };

        if (attachEventListeners) {
          const useChangeEvent = conditionalField.matches(
            "input[type=radio], input[type=checkbox], input[type=file], select, input[type=number], input[type=date]"
          );

          if (useChangeEvent) {
            conditionalField.addEventListener("input", () => runValidation());
            conditionalField.addEventListener("change", () => runValidation());
          } else {
            conditionalField.addEventListener("keyup", () => runValidation());
          }
        }

        // also run on init to set the initial state
        runValidation();
      });
    });
  }

  function showOrHideConditionalField(
    form,
    inputElement,
    fieldElement,
    conditionalFieldId,
    conditionalValue,
    conditionalOperand
  ) {
    const fieldValue = getConditionalFieldValue(form, conditionalFieldId);

    if (shouldShowField(fieldValue, conditionalOperand, conditionalValue)) {
      inputElement.removeAttribute("disabled");
      fieldElement.classList.remove("breakdance-form-field--condition-hidden");
      return;
    }

    inputElement.disabled = true;
    fieldElement.classList.add("breakdance-form-field--condition-hidden");
  }

  function getConditionalFieldValue(form, conditionalFieldId) {
    const selector = `[name="fields[${conditionalFieldId}]"],[name="fields[${conditionalFieldId}][]"], [type='file'][name="fields[${conditionalFieldId}][]"]`;
    const conditionalFields = Array.from(form.querySelectorAll(selector));

    if (!conditionalFields.length) return null;


    const values = conditionalFields.map((field) => {
      const isCheckboxOrRadio = ["checkbox", "radio"].includes(field.type);

      if (isCheckboxOrRadio && !field.checked) {
        return null;
      }

      return field.value;
    });

    return values?.filter((v) => v !== null).join(",");
  }

  function resetConditionalFields(form) {
    initConditionalFields(form, false);
  }

  function shouldShowField(aValue, operand, bValue) {
    if (operand === "equals") {
      return aValue == bValue;
    } else if (operand === "not equals") {
      return aValue != bValue;
    } else if (operand === "is set") {
      return aValue;
    } else if (operand === "is not set") {
      return !aValue;
    } else if (operand === "is one of") {
      const bValueArray = bValue.split(",");
      return bValueArray.some((x) => x.trim() == aValue);
    } else if (operand === "is none of") {
      const bValueArray = bValue.split(",");
      return !bValueArray.some((x) => x.trim() == aValue);
    } else if (operand === "contains") {
      if (typeof aValue === "string" && typeof bValue === "string") {
        return aValue.toLowerCase().includes(bValue.toLowerCase());
      }
      return false;
    } else if (operand === "does not contain") {
      if (typeof aValue === "string" && typeof bValue === "string") {
        return !aValue.toLowerCase().includes(bValue.toLowerCase());
      }
      return true;
    } else if (operand === "is greater than") {
      const aValueInteger = parseInt(aValue);
      const bValueInteger = parseInt(bValue);
      if (isNaN(aValueInteger) || isNaN(bValueInteger)) {
        return false;
      }
      return aValueInteger > bValueInteger;
    } else if (operand === "is less than") {
      const aValueInteger = parseInt(aValue);
      const bValueInteger = parseInt(bValue);
      if (isNaN(aValueInteger) || isNaN(bValueInteger)) {
        return false;
      }
      return aValueInteger < bValueInteger;
    } else if (operand === "is before date") {
      if (aValue === null || bValue === null) {
        return false;
      }
      const aDateValue = new Date(aValue);
      const bDateValue = new Date(bValue);
      const aValueIsValidDate =
        aDateValue instanceof Date && isFinite(aDateValue);
      const bValueIsValidDate =
        bDateValue instanceof Date && isFinite(bDateValue);
      if (!aValueIsValidDate || !bValueIsValidDate) {
        return false;
      }
      return aDateValue < bDateValue;
    } else if (operand === "is after date") {
      if (aValue === null || bValue === null) {
        return false;
      }
      const aDateValue = new Date(aValue);
      const bDateValue = new Date(bValue);
      const aValueIsValidDate =
        aDateValue instanceof Date && isFinite(aDateValue);
      const bValueIsValidDate =
        bDateValue instanceof Date && isFinite(bDateValue);
      if (!aValueIsValidDate || !bValueIsValidDate) {
        return false;
      }
      return aDateValue > bDateValue;
    } else if (operand === "is before time") {
      if (aValue === null || bValue === null) {
        return false;
      }
      const todaysDate = new Date().toDateString();
      const aDateValue = new Date(`${todaysDate} ${aValue}`);
      const bDateValue = new Date(`${todaysDate} ${bValue}`);
      const aValueIsValidDate =
        aDateValue instanceof Date && isFinite(aDateValue);
      const bValueIsValidDate =
        bDateValue instanceof Date && isFinite(bDateValue);
      if (!aValueIsValidDate || !bValueIsValidDate) {
        return false;
      }
      return aDateValue < bDateValue;
    } else if (operand === "is after time") {
      if (aValue === null || bValue === null) {
        return false;
      }
      const todaysDate = new Date().toDateString();
      const aDateValue = new Date(`${todaysDate} ${aValue}`);
      const bDateValue = new Date(`${todaysDate} ${bValue}`);
      const aValueIsValidDate =
        aDateValue instanceof Date && isFinite(aDateValue);
      const bValueIsValidDate =
        bDateValue instanceof Date && isFinite(bDateValue);
      if (!aValueIsValidDate || !bValueIsValidDate) {
        return false;
      }
      return aDateValue > bDateValue;
    }
    return true;
  }

  function destroy(selector) {
    const form = document.querySelector(selector);

    if (!form) {
      console.warn("[BREAKDANCE] Could not find form to destroy:", selector);
      return;
    }

    unbindEvents(form);
  }

  function initSteps(form, isBuilder = false) {
    if (form.dataset.steps == 0) return;

    const nextStepButtons = form.querySelectorAll(
      ".breakdance-form-button__next-step"
    );

    nextStepButtons.forEach((button) =>
      button.addEventListener("click", () => {
        nextStep(form, isBuilder);
      })
    );

    const previousStepButtons = form.querySelectorAll(
      ".breakdance-form-button__previous-step"
    );

    previousStepButtons.forEach((button) =>
      button.addEventListener("click", () => {
        previousStep(form);
      })
    );

    showOrHideSteps(form);
  }

  function validateStep(form, step) {
    const inputs = Array.from(
      form.querySelectorAll(
        `[data-form-step='${step}'] input,[data-form-step='${step}'] select, [data-form-step='${step}'] textarea`
      )
    );
    return inputs.every((input) => {
      input.reportValidity();
      return input.checkValidity();
    });
  }

  function getFirstInputInStep(form, step) {
    const firstFieldInStep = form.querySelector(
      `.breakdance-form-field[data-form-step="${step}"]:not(.breakdance-form-field--hidden, .breakdance-form-field--html, .breakdance-form-field--condition-hidden)`
    );

    if (firstFieldInStep) {
      return firstFieldInStep.querySelector(
        `input, textarea, select`
      );
    }

    return null;
  }

  function nextStep(form, isBuilder) {
    const currentStep = parseInt(form.dataset.currentStep);
    if (!validateStep(form, currentStep) && !isBuilder) {
      return;
    }
    const nextStep = currentStep + 1;
    setStep(form, nextStep);

    // Set focus on first element in active step
    const firstInput = getFirstInputInStep(form, nextStep);

    if (firstInput) {
      firstInput.focus();
    }

    scrollIntoViewIfNeeded(form);
  }

  function previousStep(form) {
    const currentStep = parseInt(form.dataset.currentStep);
    setStep(form, currentStep - 1);
    scrollIntoViewIfNeeded(form);
  }

  function setStep(form, step) {
    form.dataset.currentStep = step.toString();
    showOrHideSteps(form);
  }

  function showOrHideSteps(form) {
    const currentStep = parseInt(form.dataset.currentStep);
    const totalSteps = parseInt(form.dataset.steps);
    const fields = form.querySelectorAll(
      ".breakdance-form-field:not(.breakdance-form-footer)"
    );

    fields.forEach((field) => {
      const formStep = parseInt(field.dataset.formStep);
      if (formStep === currentStep) {
        field.classList.remove("hidden-step");
      } else {
        field.classList.add("hidden-step");
      }
    });

    const submitButton = form.querySelector(".breakdance-form-button__submit");
    const nextStepButton = form.querySelector(
      `.breakdance-form-field[data-form-step="${currentStep}"] .breakdance-form-button__next-step`
    );
    const previousStepButton = form.querySelector(
      `.breakdance-form-field[data-form-step="${currentStep}"] .breakdance-form-button__previous-step`
    );
    if (currentStep === totalSteps) {
      submitButton.classList.remove("hidden");
      nextStepButton.classList.add("hidden");
    } else {
      submitButton.classList.add("hidden");
      nextStepButton.classList.remove("hidden");
    }
    if (currentStep > 1) {
      previousStepButton.classList.remove("hidden");
    } else {
      previousStepButton.classList.add("hidden");
    }

    const steps = form.querySelectorAll(".breakdance-form-stepper__step");

    if (steps) {
      steps.forEach((step) => {
        const stepperStep = parseInt(step.dataset.stepperStep);
        if (stepperStep <= currentStep) {
          step.classList.add("is-active");
        } else {
          step.classList.remove("is-active");
        }
      });
      const currentStepper = form.querySelector(
        `[data-stepper-step="${currentStep}"]`
      );
      if (currentStepper) {
        currentStepper.classList.add("is-active");
      }
    }
  }

  function resetSteps(form) {
    setStep(form, 1);
  }

  function init(selector) {
    const form = document.querySelector(selector);

    if (!form) {
      console.warn("[BREAKDANCE] Could not find form:", selector);
      return;
    }

    bindEvents(form);
    initConditionalFields(form, true);
    initSteps(form);
  }

  window.breakdanceForm = {
    init,
    destroy,
    initConditionalFields,
    initSteps,
  };
})();
