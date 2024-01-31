<!DOCTYPE html>
<html>
<head>
  <title>Image Selection, Video Player, and Numbers Display</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('pbg5.png');
      background-size: cover; /* Scale the image to cover the entire body */
      background-repeat: no-repeat;   

    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #333;
      color: white;
      padding: 3px;
    }

    .navbar ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    .navbar ul li {
      margin-right: 20px;
    }

    .navbar ul li a {
      color: white;
      text-decoration: none;
    }

    .container {
      text-align: center;
      margin-bottom: 20px;
    }

    .image-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    .image-with-number {
      text-align: center;
      margin: 10px;
      cursor: pointer;
    }

    .image-with-number img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border: 2px solid transparent;
    }

    .image-value {
      font-size: 14px;
      color: white;
      font-weight:bold;
      margin-top: 5px;
      display: none; /* Initially hidden */
    }

    .highlight img {
      border: 2px solid blue; /* Highlight border */
    }

    #video-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 2;
    }

    #video-container {
      position: relative;
    }

    video {
      max-width: 80%;
      max-height: 80%;
      border-radius: 5px;
    }

    #popup {
      position: fixed;
      top: 70%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: none;
      padding: 15px;
      background-color: rgba(0, 0, 0, 0.8);
      border: 2px solid black;
      z-index: 3;
      margin-top: 50px;
    }

    #continue {
      margin-top: 10px;
    }

/* Volume icon styling */
#volumeIcon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      color: white;
      cursor: pointer;
      font-size: 24px;
    }
/* Audio controls styling */
  audio.controls-hidden {
        display: none;
      }
    audio.controls-visible {
      display: block;
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #333; /* Change the background color */
      color: white;
      padding: 5px;
    }
    .index-button {
    padding: 15px 30px;
    font-size: 20px;
    background-color: gold;
    color: black;
    border: solid;
    border-radius: 20px; /* Rounded corners */
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s; /* Adding a transition for a pop effect */
  }

  .index-button:hover {
    transform: scale(1.05); /* Scale up on hover for a popping effect */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Adding a subtle shadow */
  }

  </style>
  
</head>
<body>
<div class="navbar">
  <div class="logo">
  <img src="logo.png" alt="Logo" width="20%" height="auto">
  </div>
  <ul>
  <li><a href="index.php" style="font-size: 15px;">Play</a></li>
    <li><a href="Login.php" style="font-size: 15px;">Login</a></li>
    <li><a href="userreg.php" style="font-size: 15px;">Register</a></li>
    <li><a href="howto.php" style="font-size:15px;">How to play</a></li>    
    </ul>
</div>

<div class="container">
  <h2 style="font-size: 30px; color:white; font-weight: bold;">Vuna Chapaa na Magic POT</h2>
  <h2 style="color:teal;">Pick your lucky Magic POT</h2>
  
  <div class="image-container">
    <!-- Images with associated numbers -->
    <!-- Replace the image paths and IDs accordingly -->
    <div class="image-with-number" id="image_0" onclick="highlightImage(0)">
      <img src="image1.png" alt="Image 1">
      <p class="image-value" id="number_0">Magic Pot: </p>
    </div>
    <div class="image-with-number" id="image_1" onclick="highlightImage(1)">
      <img src="image2.png" alt="Image 2">
      <p class="image-value" id="number_1">Magic Pot: </p>
    </div>
    <div class="image-with-number" id="image_2" onclick="highlightImage(2)">
      <img src="image3.png" alt="Image 3">
      <p class="image-value" id="number_2">Magic Pot: </p>
    </div>
    <div class="image-with-number" id="image_3" onclick="highlightImage(3)">
      <img src="image4.png" alt="Image 4">
      <p class="image-value" id="number_3">Magic Pot: </p>
    </div>
    <div class="image-with-number" id="image_4" onclick="highlightImage(4)">
      <img src="image5.png" alt="Image 5">
      <p class="image-value" id="number_4">Magic Pot: </p>
    </div>
  </div>
    <button id="play" onclick="playVideo()">Play</button>
    <div style="margin-top: 20px;">
      <button onclick="goToIndexPage()" class="index-button">Play & Win real KSH</button>
    </div>
    <div>
      <label style="color:white"> Vunaa chapaa na Magic Pot</label>
  </div>
</div>

<div id="video-overlay">
  <div id="video-container">
    <video controls id="myVideo" onended="hideVideo()">
      <!-- Replace with your video source -->
      <source src="magicpotdraw.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
</div>

<!-- Popup for the 6th image -->
<div id="popup">
    <img id="popup-image" src="" alt="Popup Image"  width="150" height="150">
    <p id="selected-image-info" style="color: white; font-weight: bold; "></p>
  <button id="continue" onclick="resetDisplay()">Continue</button>
</div>
<!-- Volume icon -->
<div id="volumeIcon">&#128266;</div>

<!-- Audio tag with music controls -->
<audio id="bgMusic" loop class="controls-hidden">
  <source src="beautifulyouth.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tsparticles/3.0.2/tsparticles.min.js"></script>
<script>
  var shuffled = false;
  var imageValues = [];
  var imageOrder = [0, 1, 2, 3, 4]; // Array to maintain image order
  var imageValues = [0, 0, 0, 0, 0];
  var selectedImageIndex = -1; 
  var noofplays=0;
  var selectedValue = 0;
  // Toggle audio controls visibility when the volume icon is clicked
  const volumeIcon = document.getElementById('volumeIcon');
  const audio = document.getElementById('bgMusic');
  
  
  volumeIcon.addEventListener('click', () => {
    audio.classList.toggle('controls-visible');
    audio.classList.toggle('controls-hidden');
    audio.controls = !audio.controls; // Toggle the audio controls attribute
  });

  // Mute the audio on page load
  audio.muted = true;
  
  // Enable audio once user interacts with the page
  document.body.addEventListener('click', function() {
    if (audio.muted) {
      audio.muted = false;
      audio.play();
    }
  });

  // Hide audio controls on click outside controls area or moving mouse away
  document.addEventListener('click', function(event) {
    if (!audio.contains(event.target) && event.target !== volumeIcon) {
      audio.classList.remove('controls-visible');
      audio.classList.add('controls-hidden');
      audio.controls = false; // Hide audio controls
    }
  });

  function highlightImage(index) {
    var images = document.querySelectorAll('.image-with-number');
    for (var i = 0; i < images.length; i++) {
      images[i].classList.remove('highlight');
    }
    images[index].classList.add('highlight'); // Add highlight class to the selected image
    selectedImageIndex = index; // Update the selected image index
  }

  function playVideo() {
    var video = document.getElementById('myVideo');
    var images = document.querySelector('.image-container');
    var videoOverlay = document.getElementById('video-overlay');
    var playButton = document.getElementById('play');

    var highlightedImages = document.querySelectorAll('.highlight');
    if (highlightedImages.length === 0) {
      alert('Please select your Lucky magic pot.');
      return;
    }

    if (!shuffled) {
      shuffled = true;
      
      //displayRandomNumberstwozeros();
      getimagevalues();
      //getplayamount();
    }

    images.style.display = 'none';
    videoOverlay.style.display = 'flex';
    video.play();
    playButton.style.display = 'none';

    var highlightedImage = document.querySelector('.highlight');
   
    var selectedImageIndex = parseInt(highlightedImage.id.split('_')[1]);
    /*if (selectedImageIndex !== -1) {
      var realnumber =   selectedImageIndex+1;
      document.getElementById('selected-image-info').textContent ='Magic Pot: ' + realnumber + ' :Amount: ' + imageValues[selectedImageIndex];
    }
    */
  }

  function hideVideo() {
    var videoOverlay = document.getElementById('video-overlay');
    var images = document.querySelector('.image-container');
    var popup = document.getElementById('popup');

    videoOverlay.style.display = 'none';
    images.style.display = 'flex';
    popup.style.display = 'block';

    var imageValuesText = document.querySelectorAll('.image-value');
    for (var i = 0; i < imageValuesText.length; i++) {
      imageValuesText[i].style.display = 'block'; // Revealing numbers after video
    }

    checkAmountAndDisplayPopup();
  }
  function goToIndexPage() {
    window.location.href = 'index.php';
  }
  
function shuffleImages() {
    var container = document.querySelector('.image-container');
    for (var i = container.children.length; i >= 0; i--) {
      container.appendChild(container.children[Math.random() * i | 0]);
    }

    // Reapply the highlight to the selected image after shuffling
    if (selectedImageIndex !== -1) {
      var images = document.querySelectorAll('.image-with-number');
      images[selectedImageIndex].classList.add('highlight');
    }
  }
  

function getimagevalues() {
  if (selectedImageIndex !== -1) {
    var realnumber = selectedImageIndex;
  }

  
  var randomNumbers = [];
    for (var i = 0; i < 5; i++) {
        var randomNumber = Math.floor(Math.random() * 100000) + 12000; // Generates random number between 1 and 100 (you can adjust as needed)
        randomNumbers.push(randomNumber);
    }
    imageValues = randomNumbers;
    displayValuesFromPHP(imageValues);
}
 
function displayValuesFromPHP(imageValues) {
  var imageNumbers = document.querySelectorAll('.image-value');
  
  // Check if the number of image values matches the number of image elements
  if (imageValues && imageValues.length === imageNumbers.length) {
    // Update the displayed numbers for each image with values from PHP
    for (var i = 0; i < imageNumbers.length; i++) {
      imageNumbers[i].textContent = 'Magic Pot: ' + imageValues[i];
    }
  } else {
    console.error('Invalid number of image values received from PHP.');
  }

  if (selectedImageIndex !== -1) {
      var realnumber =   selectedImageIndex+1;
      var selectedValue = imageValues[selectedImageIndex];
      //document.getElementById('selected-image-info').textContent ='Magic Pot: ' + realnumber + ' :Amount: ' + imageValues[selectedImageIndex];
      var text = 'Magic Pot ' + realnumber + 'has KSH: ' + selectedValue;

      var element = document.getElementById('selected-image-info');
      element.textContent += '\n'+ text;

        if (selectedValue > 0) {
            var winningText = ' Congratulations!\n You won KSH: ' + selectedValue + ' !!';
            element.textContent = '\n'+ winningText; // Append winning text to the existing content
          // Set the font color or style differently when the value is greater than zero
          element.style.color = 'gold'; // Change font color to green
          // You can apply other styles as well, such as font-weight, font-size, etc.
                 } else {
                    var lossingText = ' Sorry!\n Better Luck on you next Try!!'
          element.style.color = 'teal'; // Change font color to red or another color of your choice
          // Apply other styles if needed for negative values or specific conditions
        }
    }
}




function checkAmountAndDisplayPopup() {
    //console.log('amount here is',selectedValue);
  var selectedValue = imageValues[selectedImageIndex];
  //console.log('amount here is then here is',selectedValue);
  if (selectedValue > 0) {
    // Display popup only if the selected amount is more than 0
    var popup = document.getElementById('popup');
    popup.style.display = 'block';

    // Play the audio (change the audio source and type as needed)
    var audio = new Audio('goodresult.mp3');
    audio.play();

    // Display the image associated with the popup (change the image source as needed)
    var popupImage = document.getElementById('popup-image');
    popupImage.src = 'winner1.png';

    // Trigger confetti animation
    //triggerParticles();
  }
  else{
    var popup = document.getElementById('popup');
    popup.style.display = 'block';

    // Play the audio (change the audio source and type as needed)
    var audio = new Audio('loss.mp3');
    audio.play();

    // Display the image associated with the popup (change the image source as needed)
    var popupImage = document.getElementById('popup-image');
    popupImage.src = 'pbg5.png';


  }
}

 function resetDisplay() {
    var imageNumbers = document.querySelectorAll('.image-value');
    for (var i = 0; i < imageNumbers.length; i++) {
      imageNumbers[i].textContent = '';
      imageNumbers[i].style.display = 'none'; // Hide numbers again on reset
    }

    var popup = document.getElementById('popup');
    popup.style.display = 'none';

    var highlightedImage = document.querySelector('.highlight');
    if (highlightedImage) {
      highlightedImage.classList.remove('highlight');
    }

    shuffled = false;

    var playButton = document.getElementById('play');
    playButton.style.display = 'block'; // Show the play button
    playButton.style.margin = 'auto'; // Align the play button to center
   // shuffleImages();
    selectedImageIndex = -1;
  }
  // Function to reset the page elements
function resetPage() {
  var imageNumbers = document.querySelectorAll('.image-value');
  for (var i = 0; i < imageNumbers.length; i++) {
    imageNumbers[i].textContent = '';
    imageNumbers[i].style.display = 'none';
  }

  var popup = document.getElementById('popup');
  popup.style.display = 'none';

  var highlightedImage = document.querySelector('.highlight');
  if (highlightedImage) {
    highlightedImage.classList.remove('highlight');
  }

  var playButton = document.getElementById('play');
  playButton.style.display = 'block';
  playButton.style.margin = 'auto';

  shuffled = false;
  selectedImageIndex = -1;
}


</script>

</body>
</html>

<?php


?>