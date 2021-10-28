// -------------------------- Blocker ----------------------------------- //

document.querySelector("#securityBtn").addEventListener("click",function(){
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
// 