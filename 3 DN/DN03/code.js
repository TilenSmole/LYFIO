$(document).ready(() => {
    saveToLocalStorage()
});




function saveToLocalStorage() {
 
    var data = parseInt(JSON.parse(sessionStorage.getItem('stevila'))) ;
    i = 0
    let jsonArray = [];
    var tabele = document.querySelectorAll('#tabele');
    console.log(tabele.length)
    for (let index = 0; index < tabele.length; index++) {
        let table = tabele[index]
        for(let i=0, row; row = table.rows[i]; i++){
            var col = row.cells;
            let row2push = {
                id: ((tabele).length+i),
                datum: col[0].innerHTML,
                trgovec : col[1].innerHTML,
                vsota: col[2].innerHTML,
                opombe: col[3].innerHTML


            }
            jsonArray.push(row2push);
        }
        i++;

        
    }
    sessionStorage.setItem(("stroski"), JSON.stringify(jsonArray));




        }





