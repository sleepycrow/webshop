function adjustTextarea(elem){
  elem.style.height = "auto";
  elem.style.height = (elem.scrollHeight + 8) + "px";
}

window.addEventListener("load", () => {
  var textareas = document.getElementsByTagName("textarea");
  for(let i = 0; i < textareas.length; i++){
    textareas[i].addEventListener("keydown", (e) => {
      adjustTextarea(e.target);
    });
    adjustTextarea(textareas[i]);
  }
});
