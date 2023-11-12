var evidencaDatumov = [];

var id 
function avg(){
    stevila2 = JSON.parse(localStorage.getItem("stevila")) || [];
    var sum = 0
    stevila2.forEach(element => {
        sum += parseFloat(element)
    });


    return (sum/stevila2.length).toFixed(2) 
}
var stevila = JSON.parse(localStorage.getItem("stevila")) || [];

function min(){
    stevila21 = JSON.parse(localStorage.getItem("stevila")) || [];
    var max = stevila21[0] 
    stevila21.forEach(element => {
        if(max > element)
            max = element
    });


    return parseFloat(max).toFixed(2) 

}
function max(){
    stevila22 = JSON.parse(localStorage.getItem("stevila")) || [];
    var max = 0
    stevila22.forEach(element => {
        if(max < element)
        max = element
    });


    return parseFloat(max).toFixed(2) 

}

function update(){
    document.getElementById("povprecje").innerHTML = "Povprečje: " + avg()
    document.getElementById("max").innerHTML = "Maks. : " + max()
    document.getElementById("min").innerHTML = "Min. : " + min()
    document.getElementById("stanje").innerHTML = "Stanje : " + stanje()

}
function stanje(){
    stevila22 = JSON.parse(localStorage.getItem("stevila")) || [];
    var sta = 0
    stevila22.forEach(element => {
        sta += parseFloat(element)
    });


    return parseFloat(sta)

}

   



$(document).ready(() => {
    update()
    var tabela = document.getElementById("tabele")
    var data = JSON.parse(localStorage.getItem('stroski'));
    for(let i = 1; i < data.length; i++){
      //  var tabela = document.createElement("table")
        var vrstica = document.createElement("tr")

        for (const key in data[i]){
            if(key != "id"){
                const td = document.createElement("td");
                td.innerText = data[i][key];
                vrstica.appendChild(td);
            }   
            else{
            }
    }  
        var brisanje = document.createElement("p") 
        brisanje.style.padding = "10%    ";
        brisanje.style.cursor = "pointer";
        brisanje.style.backgroundColor = "#ccd6e2"
        brisanje.style.textAlign = "center"
        brisanje.innerText = "delete";
        brisanje.onclick = brisanjeVrstice2
        
        vrstica.appendChild(brisanje);
        tabela.appendChild(vrstica);
       // tabele.appendChild(tabela)
    }


    

});




        //loops through each cell in current row
        /* for(var j = 0; j < cellLength; j++){
            // get your cell info here
        
            var cellVal = oCells.item(j).innerHTML;
            //console.log(cellVal);
        }*/


        /* const participant = {
            id: idi,
            datum: oCells.item(i).innerHTML,
            trgovec: oCells.item(i).innerHTML,
            vsota: oCells.item(i).innerHTML,
            opombe: oCells.item(i).innerHTML,
        };

        stroski.push(participant)*/

    
    
    
    /*
    
    
    
    for(let i=0; i < rowCount; i++){
        //console.log(rowCount)
        var col = rowCount.cells;
        let row2push = {
            first : col[0].innerHTML,
            last  : col[1].innerHTML,
            role  : col[2].innerHTML
        }
        jsonArray.push(row2push);
        //console.log("participant"+ row2push + " fas")

    }*/



    /*for (let index = 1; index < table.length; index++) {
        const element = table[index];
        const participant = {
            id : i++,
            first: element.cells[0].innerHTML,
            last: element.cells[1].innerHTML,
            role: element.cells[2].innerHTML
        };
        arr.push(participant);    
        //console.log("participant"+ participant)

    }*/


//}

//localStorage.setItem(("stroski"), JSON.stringify(stroski));


/*
    for (let index = 0; index < table.length; index++) {
        const element = table[index];
        //console.log(element)

    }*/

/*
    for(let i=1, row; row = table.rows[i]; i++){
        var col = row.cells;
        let row2push = {
            first : col[0].innerHTML,
            last  : col[1].innerHTML,
            role  : col[2].innerHTML
        }
        jsonArray.push(row2push);
    }*/



    /*for (let index = 0; index < stroski.length ; index++){
        let table = document.getElementById(evidencaDatumov[index]).rows;
        for (let i = 0; i < table.length; i++) {
            const element = table[i];
            const participant = {
                id: idi,
                datum: element.cells[0].innerHTML,
                trgovec: element.cells[1].innerHTML,
                vsota: element.cells[2].innerHTML,
                opombe: element.cells[3].innerHTML,
            };
            ////console.log(participant)
            stroski.push(participant);     
        } 
    }*/

    //localStorage.setItem("verzija", JSON.parse(verzija));

    

//}





