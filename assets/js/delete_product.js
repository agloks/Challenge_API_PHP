document.addEventListener('DOMContentLoaded', () => {
  const divButton = document.getElementsByClassName("actions-form");
  const button = divButton[0].children[1];
  const inputSku = document.getElementById("sku");

  button.onclick = (e) => {
    e.preventDefault();
    const url = 'http://localhost:8000/api/V1/product/delete/';
    
    const query = `sku=${inputSku.value}`

    fetch(url, {method: 'DELETE', body: query})
    .then(async function (response) {
        const respost = await response.text();
        console.log(respost);
    })
  };
})