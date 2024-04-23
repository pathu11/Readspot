function fullView(imgLink){
  document.getElementById("large-event-poster").src = imgLink;
  document.getElementById("myModal").style.display = "block";
}

function closeFullView(){
  document.getElementById("myModal").style.display = "none";
  document.getElementById("myModal1").style.display = "none";
  document.getElementById("myModal2").style.display = "none";
}

function respondPopup(complaint_id,email,name){
  document.getElementById("complaint_id").value = complaint_id;
  document.getElementById("email").value = email;
  document.getElementById("name").value = name;
  document.getElementById("myModal1").style.display = "block";
}

function showFullDescription(description){
  document.getElementById("fullDescription").innerText = description;
  document.getElementById("myModal2").style.display = "block";
}