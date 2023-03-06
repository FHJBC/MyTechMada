var bar = document.getElementById('bar');
var mark = document.getElementById('mark')
bar.addEventListener("click", affiche);
function affiche(){
    bar.style.display="none";
    mark.style.display="initial";
    mark.style.color="white";
    document.getElementById('ul').style.display="initial";
}
mark.addEventListener('click', cache);
function cache(){
    bar.style.display="initial";
    mark.style.display="none";
    document.getElementById('ul').style.display="none";
}