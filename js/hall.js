const container = document.querySelector(".container-hall");
const reserve = document.querySelector(".reserve");
const count = document.querySelector("#count");
const hall = document.querySelector("#hall");
var selectedSeats = new Map();
var counter = 0;
container.addEventListener("click", (e) => {
  seat = e.target;
  if (seat.classList.contains("seat") && !seat.classList.contains("occupied")) {
    if (seat.classList.contains("selected")) {
      counter--;
      selectedSeats.delete(seat.id);
    } else {
      counter++;
      selectedSeats.set(seat.id, counter)
    }

    count.innerHTML = selectedSeats.size;
  }
  e.target.classList.toggle("selected");
});

reserve.addEventListener("click", (e) => {
  let seats = Array.from(selectedSeats.keys());
  let strSeats = "";
  seats.forEach((s) => {
    strSeats += String(s) + ",";
  })
  document.cookie = "reserved=" + strSeats;
  document.cookie = "hall="+ hall.value;
});