//This are global variables
let width = 400,
    height = 300,
    filter = 'none',
    streaming = false;

//Getting the DOM elements
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var photos = document.getElementById('photos');
var clearBtn = document.getElementById('clear-btn');
var filterOptions = document.getElementById('filter-options');
var captureBtn = document.getElementById('capture-btn');

//Get media stream to show video
navigator.mediaDevices.getUserMedia({ video: true, Audio: false }).then(function(stream) {
    //Linking to the video source in php file
    video.srcObject = stream;
    //playing the video
    video.play();
}).catch(function(err) {
    console.log('Error: ${err}')
});

//Play video when ready
video.addEventListener('canplay', function(e) {
    if (!streaming) {
        //Now set video / canvas height
        height = videoHeight / (video.videoWidth / width);
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
    }
}, false);

captureBtn.addEventListener('click', function(e) {
    takePicture();

    e.preventDefault();
}, false);
//creating a picture from the canvas
filterOptions.addEventListener('change', function(e) {
    filter = e.target.value;
    video.style.filter = filter;
    e.preventDefault();
});

clearBtn.addEventListener('click', function(e) {
    filter = 'none';
    video.style.filter = filter;
    filterOptions.selectedIndex = 0;
})

function takePicture() {
    //create a canvas
    const context = canvas.getContext('2d');
    if (width && height) {
        //assigning the width and height for the canvas
        canvas.width = width;
        canvas.height = height;
        //Drawing the image on a canvas
        context.drawImage(video, 0, 0, width, height);
        //creating an image from the canvas
        var imgUrl = canvas.toDataURL('image/png');
        //imgUrl.value = setAttribute('src', 'photos/' + imgUrl);
        //create image element
        var img = document.createElement('img');
        //setting the image source to save
        img.setAttribute('src', imgUrl);
        //set image filter
        img.style.filter = filter;
        photos.appendChild(img);
    }
}