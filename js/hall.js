const container = document.querySelector(".container-hall");
const reserve = document.querySelector("#reserve");
const cancel = document.querySelector("#cancel");
const count = document.querySelector("#count");
const hall = document.querySelector("#hall");
const form = document.querySelector("#res");
var selectedSeats = new Map();
var canceledSeats = new Map();

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
  else return null;
}

container.addEventListener("click", (e) => {
  seat = e.target;
  if (seat.classList.contains("seat") && !seat.classList.contains("occupied")) {
    if (seat.classList.contains("own") && seat.classList.contains("selected")) {
      canceledSeats.set(seat.id, 0);
    } else if (seat.classList.contains("own")) {
      canceledSeats.delete(seat.id);
    } else if (seat.classList.contains("selected")) {
      selectedSeats.delete(seat.id);
    } else {
      selectedSeats.set(seat.id, 0)
    }

    count.innerHTML = selectedSeats.size;
  }
  e.target.classList.toggle("selected");
});

reserve.addEventListener("click", (e) => {

  if (getCookie("LoggedIn") != null) {
    let seats = Array.from(selectedSeats.keys());
    let strSeats = "";
    seats.forEach((s) => {
      strSeats += String(s) + ",";
    })
    document.cookie = "reserved=" + strSeats;
    document.cookie = "hall=" + hall.value;
    form.action = "pay.php";
  } else {
    alert("You are not logged in, please login and try again");
    form.action = "index.php";
  }

});

cancel.addEventListener("click", (e) => {

  if (getCookie("LoggedIn") != null) {
    let seats = Array.from(canceledSeats.keys());
    let strSeats = "";
    seats.forEach((s) => {
      strSeats += String(s) + ",";
    })
    document.cookie = "cancelled=" + strSeats;
    document.cookie = "hall=" + hall.value;
    form.action = "cancelSeat.php";
  } else {
    alert("You are not logged in, please login and try again");
    form.action = "index.php";
  }

});