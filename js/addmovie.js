function verify_data() {
  var title = document.getElementById("title").value;
  var date = document.getElementById("date").value;
  var startTime = document.getElementById("startTime").value;
  var endTime = document.getElementById("endTime").value;
  var screeningRoom = document.getElementById("screeningRoom").value;
  var posterImage = document.getElementById("posterImage").value;

  if ((title = "")) {
    alert("Please enter the movie's title.");
    return false;
  }

  if ((date = "")) {
    alert("Please enter the movie's display date.");
    return false;
  }

  if ((startTime = "")) {
    alert("Please enter the movie's start time.");
    return false;
  }

  if ((endTime = "")) {
    alert("Please enter the movie's end time.");
    return false;
  }

  if ((screeningRoom = "")) {
    alert("Please enter the movie's screening room.");
    return false;
  }

  if ((posterImage = "")) {
    alert("Please enter the movie's poster image.");
    return false;
  }

  return true;
}
