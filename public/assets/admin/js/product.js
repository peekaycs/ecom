function fetchAttributeForm(url){
    if(url){
        fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById("attribute-form").insertAdjacentHTML('beforeend',html);
        })
        .catch(error => {console.log(error)});
    }
}

function fetchAttributeOptions(element){
    let url = element.options[element.selectedIndex].getAttribute('href');
    if(url){
        fetch(url)
        .then( response => response.text())
        .then( html => {
        let node =  document.querySelectorAll('.dynamic-attribute');
        for(let i  of  node){
            if(i.childNodes.length == 3){
                i.insertAdjacentHTML('beforeend',html);
            }
        }
        }).catch( error => {console.log(error)});
    }
}