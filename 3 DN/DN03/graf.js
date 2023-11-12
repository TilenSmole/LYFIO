var podatki = JSON.parse(sessionStorage.getItem('stroski'));
if(podatki == null){
    alert("preusmerjanje na 'PODATKI', da se posodobi tabela!")
    window.location='statistika.php';
    
}
else{
    var dict = {} 
var max = 0
var skupno = 0
for (let index = 1; index < podatki.length; index++) {
    var datum = (podatki[index].datum ).split("-")
    var datum = (datum[1] +"-"+ datum[0])
    if(datum in dict){
        var atm = parseFloat(dict[datum] )
        var vsota = parseFloat(podatki[index].vsota) + parseFloat(atm)
        dict[datum] = vsota

        

    }
    else{
        dict[datum] = parseFloat(podatki[index].vsota)
    }
}
for(key in dict){
    skupno += dict[key]
}

for(key in dict){
    if (dict[key] > max  ){
        max = dict[key]
    }
}



var stEle = Object.keys(dict).length 

var canvas = document.getElementById("platno");
//  document.getElementById("platno").height = max
var ctx = canvas.getContext("2d");
var barWidth = canvas.width / stEle
document.getElementById("maxsVrednostMobile").innerHTML  = "max: "+max
var i = 0

document.getElementById("maxVrednostGrafa").innerHTML = parseFloat(max )
document.getElementById("midVrednostGrafa").innerHTML = parseFloat((max )/2)
document.getElementById("minVrednostGrafa").innerHTML = parseFloat(0)


for(key in dict){


    var barva =  Math.floor(Math.random()*16777215).toString(16).padStart(6, '0');
    ctx.fillStyle = "#"+barva


    if(dict[key] <= 0){
        ctx.fillRect(i++ * barWidth, 0  , barWidth, dict[key] )
    }
    else{
        var y = (100*dict[key]/max) 
        

        ctx.fillRect(i++ * barWidth, canvas.height - y , barWidth, y )
    
    
    }
    
    var legenda = document.getElementById("legenda");
    var ele = document.createElement("p")
    ele.innerHTML = key + " = " +dict[key]
    ele.style.color = "#"+barva
    ele.style.fontSize = "30px"
    legenda.appendChild(ele)

    
    }





}
