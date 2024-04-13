let checkbox = document.getElementById("checkbox");
let textTask = document.getElementById("textTask");

checkbox.addEventListener("change", () => {
  if (checkbox.checked) {
    textTask.style.textDecoration = "line-through";
  } else {
    textTask.style.textDecoration = "none";
  }
});







