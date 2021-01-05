// Get all <span> elements that closes the modals
var closeModalBtns = document.querySelectorAll(".close");

// Get all modal elements
var modals = document.querySelectorAll(".modal.fade");

// load video pages
function move(songId,index){
	if (index){
		window.location.replace("./pages/video.php?id="+songId);
	}else{
		window.location.replace("./video.php?id="+songId);
	}
}

function hideModals() {
	Array.from(modals).forEach((modal) => {
		modal.classList.remove("show");
	  	modal.classList.remove("d-block");
  	});
}

Array.from(closeModalBtns).forEach((btn) => {
    btn.onclick = function() {
	  	hideModals();
	}
});

// hideModals();

// Set the options for the toastr messages
toastr.options = {
	"closeButton": true,
	"newestOnTop": true,
	"positionClass": "toast-top-full-width",
	// "positionClass": "toast-top-center",
	"timeOut": "5000",
}

$(function() {
	// toastr.info('Hé, ça marche !'); // message, titre
});