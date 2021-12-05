// -------------------------- Blocker ----------------------------------- //

let blocker = document.createElement("div");
blocker.id = "blocker";
blocker.classList.add("bg-dark" ,"text-white", "position-fixed" ,"h-100" ,"w-100","top-0","start-0");

let content = document.createElement("div");
content.innerHTML = `
  <section id="securityInfo" class="bg-light position-fixed container p-0">
    <h2 id = "securityTitle" class="bg-primary col-12 p-2 m-0 ">chargement.</h2>
    <p id = "securityText" class="m-2"> chargement.</p>
    <button id="securityBtn"class="m-2">J'ai compris</button>
  </section> `;


sessionStorage.setItem("hasBeenAccepted","open");

if (sessionStorage.getItem("hasBeenAccepted") === "open"){
document.body.appendChild(blocker);
document.body.appendChild(content);
document.querySelector("#securityBtn").addEventListener("click",function(){
    sessionStorage.setItem("hasBeenAccepted","closed");
    document.querySelector("#blocker").remove();
    document.querySelector("#securityInfo").remove();
})

let httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange = function(){
    if (httpRequest.readyState === XMLHttpRequest.DONE){
        console.log("Response arrive")
        if (httpRequest.status === 200){
            let response = JSON.parse(httpRequest.response);
            console.log(response);
            document.querySelector("#securityTitle").innerText = response.title;
            document.querySelector("#securityText").innerText = response.text;
        }
    } else {
        document.querySelector("#securityTitle").innerText = "Error loading text";
        document.querySelector("#securityText").innerText = "Error loading text";
    }
}
httpRequest.open("GET","json/security.json",true);
httpRequest.send();
}