document.addEventListener('DOMContentLoaded', () => {
 
  function createNode(name, code) {
    const tr = document.createElement("tr");
    tr.setAttribute("class", "data-row");
    const lastParent = document.getElementsByTagName("tbody")[0]

    function nameF() {
      const td = document.createElement("td");
      const span = document.createElement("span");
      
      td.setAttribute("class", "data-grid-td");
      span.setAttribute("class", "data-grid-cell-content");
      span.innerHTML = name;
  
      td.append(span);
      tr.append(td);
    }
  
    function codeF() {
      const td = document.createElement("td");
      const span = document.createElement("span");
      
      td.setAttribute("class", "data-grid-td");
      span.setAttribute("class", "data-grid-cell-content");
      span.innerHTML = code;
  
      td.append(span);
      tr.append(td);
    }
  
    function actionsF() {
      const td = document.createElement("td");
      const a = document.createElement("a");
      const aTwo = document.createElement("a");
      const divOne = document.createElement("div");
      const divTwo = document.createElement("div");
      const divThree = document.createElement("div");
  
      td.setAttribute("class", "data-grid-td");
      divOne.setAttribute("class", "actions");
      td.append(divOne);
      
      divTwo.setAttribute("class", "action edit");
      a.setAttribute("href", "/assets/editCategory.html")
      a.innerHTML = "Edit";
      divTwo.append(a);
      divOne.append(divTwo);
  
      divThree.setAttribute("class", "action delete");
      aTwo.setAttribute("href", "/assets/deleteCategory.html")
      aTwo.innerHTML = "Delete";
      divThree.append(aTwo);
      divOne.append(divThree);
  
      
      tr.append(td);
    }

    nameF();codeF();actionsF();
    lastParent.append(tr);
  }

  function callApi()
  {
    const url = 'http://localhost:8000/api/V1/categories/get/';
    
    fetch(url, {method: 'GET'})
    .then(async function (response) {
        const respost = await response.json();
        respost.forEach((s) => 
        {
          createNode(s.name, s.code);
        })
    })
  }

  callApi(); 
});