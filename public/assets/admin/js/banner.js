function fetchImageForm(url){
    if(url){
        fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById("banner-image").insertAdjacentHTML('beforeend',html);
        })
        .catch(error => {console.log(error)});
    }
}
