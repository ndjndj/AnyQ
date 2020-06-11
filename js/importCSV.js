
let loadBtn;
let file;
let reader;

loadBtn = document.querySelector("#loadCSV");
loadBtn.addEventListener("change", upload, false);

file = event.target.files[0];
reader = new FileReader();

reader.readAsText(file);

reader.onload = function(e) {
    var result = event.target.result;
    makeCSV(result);
};



function makeCSV(csvData) {
    let arr2D;
    let rowData;
    arr2D = csvData.split("\n").split;

    for (var i=0; i < arr2D.length; i++) {
        rowData = arr2D.split(",");
        for (var j=0; j < rowData.length; j++) {
            console.log(rowData[j]);
        }
    }
    
}

