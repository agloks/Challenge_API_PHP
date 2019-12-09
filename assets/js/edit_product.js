document.addEventListener('DOMContentLoaded', () => {
  const divButton = document.getElementsByClassName("actions-form");
  const button = divButton[0].children[1];
  const inputSku = document.getElementById("sku");
  const inputName = document.getElementById("name");
  const inputPrice = document.getElementById("price");
  const inputQuantity = document.getElementById("quantity");
  const inputCategory = document.getElementById("category");
  const inputDescription = document.getElementById("description");
  
  const categoryCode =
  {
    "Category 1":1201,
    "Category 2":1202,
    "Category 3":1203,
    "Category 4":1204,
  }

  button.onclick = (e) => {
    e.preventDefault();
    const url = 'http://localhost:8000/api/V1/product/update/';
    
    const query = `name=${inputName.value}&sku=${inputSku.value}&price=${inputPrice.value}&quantity=${inputQuantity.value}&description=${inputDescription.value}&categories=${categoryCode[inputCategory.value]}`

    fetch(url, {method: 'PUT', body: query})
    .then(async function (response) {
        const respost = await response.text();
        console.log(respost);
    })
  };
})