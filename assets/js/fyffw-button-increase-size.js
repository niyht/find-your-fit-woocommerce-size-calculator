// Buttons
let findButton = document.getElementById("findButton");
let nextLenght = document.getElementById("nextLength");
let nextWeight = document.getElementById("nextWeight");
let nextSize = document.getElementById("nextSize");
let closeButton = document.getElementById("closeButton");

// Divs
let lengthDiv = document.getElementById("lengthDiv");
let weightDiv = document.getElementById("weightDiv");
let sizeDiv = document.getElementById("sizeDiv");
let finalDiv = document.getElementById("finalDiv");

// Inputs
let lengthInput = document.getElementById("lengthInput");
let weightInput = document.getElementById("weightInput");

// Selects
let sizeSelect = document.getElementById("sizeSelect");

// Texts
let finalSize = document.getElementById("finalSize");

findButton.addEventListener("click", (event) => {
  event.preventDefault();  // Prevent default behavior
  lengthDiv.style.display = "block";
  findButton.style.display = "none";
});

nextLenght.addEventListener("click", (event) => {
  event.preventDefault();  // Prevent default behavior
  if (lengthInput.value !== "") {
    weightDiv.style.display = "block";
    lengthDiv.style.display = "none";  
  } else {
    alert(findYourFitData.pleaseEnterHeight); // Localization 
  }
});

nextWeight.addEventListener("click", (event) => {
  event.preventDefault();  // Prevent default behavior
  if (weightInput.value !== "") {
    weightDiv.style.display = "none";
    sizeDiv.style.display = "block"; 
  } else {
    alert(findYourFitData.pleaseEnterWeight); // Localization
  }
});

nextSize.addEventListener("click", (event) => {
    event.preventDefault();  // Prevent default behavior
    sizeDiv.style.display = "none";
    finalDiv.style.display = "block";
  
    let length = Number(lengthInput.value);
    let weight = Number(weightInput.value);
    let userSize = sizeSelect.value;
  
    if (isNaN(length) || isNaN(weight) || userSize === "") {
        alert('Please fill in all fields correctly.');
        return;
    }
  
    let estimatedSize = '';
  
    // Estimation one size larger
    if (length < 160) {
        if (weight < 45) { 
            estimatedSize = 'S';
        } else if (weight >= 45 && weight < 60) {
            estimatedSize = 'M';
        } else {
            estimatedSize = 'L';
        }
    } else if (length >= 160 && length < 180) {
        if (weight < 55) { 
            estimatedSize = 'S';
        } else if (weight >= 55 && weight < 70) {
            estimatedSize = 'M';
        } else {
            estimatedSize = 'L';
        }
    } else if (length >= 180) {
        if (weight < 65) { 
            estimatedSize = 'M';
        } else if (weight >= 65 && weight < 80) {
            estimatedSize = 'L';
        } else {
            estimatedSize = 'XL';
        }
    }

  
    // Compare the size specified by the user with the estimated size
    if (userSize === estimatedSize) {
      finalSize.textContent = findYourFitData.sizeCorrect.replace('%1$s', estimatedSize); // Localization 
    } else {
      // If user size and estimated size do not match, select an average size
      finalSize.textContent = findYourFitData.sizeRecommend.replace('%1$s', userSize).replace('%2$s', estimatedSize); // Localization 
    }
  });
  

closeButton.addEventListener("click", (event) => {
    event.preventDefault();  // Prevent default behavior
    findButton.style.display = "block";
    finalDiv.style.display = "none";
});
