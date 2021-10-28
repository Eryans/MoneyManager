const TABLE = document.querySelector("#statTable");
let httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange = function(){
    if (httpRequest.readyState === XMLHttpRequest.DONE){
        console.log("Response arrive")
        if (httpRequest.status === 200){
            let response = JSON.parse(httpRequest.response);
            let tr = TABLE.insertRow(-1);
            let keys = [];
            response.information.forEach(function(x){
                for (let key in x){
                    keys.includes(key) ? false : keys.push(key);
                }
            });
            console.log(keys)
            keys.forEach(function(x){
                let th = document.createElement("th");
                th.innerText = x;
                tr.appendChild(th);
            });
            response.information.forEach(function(x){
                let tr = TABLE.insertRow(-1);
                for (key in x){
                    let tdata = key === "Indicateur" ? document.createElement("th") : document.createElement("td");
                    tdata.innerText = x[key];
                    tr.appendChild(tdata);
                }
            });
        } else {
            console.error("Shit happend");
        }
    } else {
        console.log("Loading");
    }
}
httpRequest.open("GET","json/stats.json",true);
httpRequest.send();