document.addEventListener('DOMContentLoaded', () => {
  console.log("has")
  const divButton = document.getElementsByClassName("actions-form");
  const button = divButton[0].children[1];
  const inputName = document.getElementById("category-name");
  const inputCode = document.getElementById("category-code");
  
  button.onclick = (e) => {
    e.preventDefault();
    const url = 'http://localhost:8000/api/V1/categories/update/';
  
    fetch(url, {method: 'PUT', body: `name=${inputName.value}&code=${inputCode.value}`})
    .then(function (response) {
        return response.text();
    })
    .then(function (body) {
        console.log(body);
    });
  };
})