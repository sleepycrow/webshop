class Gallery {

  constructor(id, imgs){
    var place = document.getElementById(id);

    // Create elements
    this.container = document.createElement("div");
    this.container.classList.add("jsgallery");
    place.appendChild(this.container);

    this.stage = document.createElement("div");
    this.stage.classList.add("stage");
    this.stage.addEventListener("click", (e) => {this.toggleLightbox(e);});
    this.container.appendChild(this.stage);

    this.bench = document.createElement("ul");
    this.bench.classList.add("bench");
    this.container.appendChild(this.bench);

    // Fill the bench
    for(let i in imgs){
      let li = document.createElement("li");

      let img = new Image();
      img.src = imgs[i];
      img.addEventListener("click", (e) => {this.changeImg(e);});

      li.appendChild(img);
      this.bench.appendChild(li);
    }

    // Put the first image up on stage
    this.changeImg(imgs[0]);
  }

  toggleLightbox(e){
    this.container.classList.toggle("jsgallery--lightbox");
  }

  changeImg(arg){
    if(typeof arg == "string")
      this.stage.style.backgroundImage = "url("+arg+")";
    else
      this.stage.style.backgroundImage = "url("+arg.target.src+")";
  }

}
