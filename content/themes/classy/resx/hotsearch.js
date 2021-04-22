// ten kod jest taki brzydki i pisany tak na szybko że aż się wstydzę. obiecuję Panu że zwykle tak nie jest. D:

var hs = {
  rootUri: null,
  timeouts: {},

  keydown: function(searchBox, resultBoxId){
    if(hs.timeouts[resultBoxId]) return;

    hs.timeouts[resultBoxId] = window.setTimeout(() => {
      var resultBox = document.getElementById(resultBoxId);
      hs.search(searchBox, resultBox);
    }, 1000);
  },

  search: function(searchBox, resultBox){
    // Zresetuj kilka rzeczy
    resultBox.style.display = "none";
    delete hs.timeouts[resultBox.id];

    // Upewnij się że możemy przeprowadzić wyszukiwanie
    if(hs.rootUri == null) return;
    if(searchBox.value.length <= 0) return;

    // Ustaw wygląd
    resultBox.style.display = "";
    resultBox.classList.add("hotsearch--loading");

    // Zacznij szukanie
    var xhr = new XMLHttpRequest();
    xhr.open("GET", hs.rootUri+'/api/search?limit=6&q='+encodeURIComponent(searchBox.value), true);

    xhr.onerror = () => {
      resultBox.style.display = "none";
      console.error(xhr.status, xhr.responseText);
      alert("Wystąpił błąd podczas wyszukiwania.");
    };

    xhr.onload = () => {
      var resp = JSON.parse(xhr.responseText);
      console.log(resp);

      if(!resp.ok){
        xhr.onerror();
        return;
      }

      resultBox.classList.remove("hotsearch--loading");
      resultBox.innerHTML = "";
      for(var i = 0; i < resp.products.length; i++){
        let product = resp.products[i];
        resultBox.innerHTML += `<a href="${hs.rootUri}/product/${product.product_id}"><li class="hotsearch__result">
          <img src="${product.product_thumbnail_src}" alt="${product.product_name}" />
          ${product.product_name}
        </li></a>`;
      }
    };

    xhr.send();
  }
};
