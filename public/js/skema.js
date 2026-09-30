let pdfFiles = {};



function loadPDF(
url,
canvasId,
infoId,
id
){


pdfjsLib
.getDocument(url)
.promise
.then(function(pdf){


pdfFiles[id]={

pdf:pdf,

page:1,

canvas:
document.getElementById(canvasId),

info:
document.getElementById(infoId)

};



renderPDF(id);



});



}







function renderPDF(id){



let data = pdfFiles[id];


data.pdf
.getPage(data.page)
.then(function(page){



let canvas=data.canvas;

let ctx=
canvas.getContext("2d");


let scale = 1.1;


if(window.innerWidth <= 768){

    scale = 1.3;

}


let viewport =
page.getViewport({

    scale:scale

});



canvas.width =
viewport.width;


canvas.height =
viewport.height;



page.render({

canvasContext:ctx,

viewport:viewport


});




data.info.innerHTML =

data.page
+
" / "
+
data.pdf.numPages;



});



}









function nextPDF(id){


let data=pdfFiles[id];


if(!data)
return;



if(data.page < data.pdf.numPages){


data.page++;


renderPDF(id);


}



}








function prevPDF(id){


let data=pdfFiles[id];


if(!data)
return;



if(data.page > 1){


data.page--;


renderPDF(id);


}



}












// ACCORDION

document.addEventListener(
"DOMContentLoaded",
()=>{


const items =
document.querySelectorAll(
".accordion-item"
);



items.forEach(item=>{


let btn =
item.querySelector(
".accordion-header"
);



btn.addEventListener(
"click",
()=>{


items.forEach(i=>{


if(i!==item)

i.classList.remove(
"active"
);


});



item.classList.toggle(
"active"
);



});


});



});