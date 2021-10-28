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
        }
    } else {
        console.log("loading");
    }
    httpRequest.open("GET","json/security.json",true);
    httpRequest.send();
}
// 