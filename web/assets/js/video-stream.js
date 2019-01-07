var xMousePosition = 0;
var yMousePosition = 0;
document.onmousemove = function(e)
{
    xMousePosition = e.clientX + window.pageXOffset;
    yMousePosition = e.clientY + window.pageYOffset;
};


function rename(element)
{
    alert("Le téléchargement de la vidéo n'est pas accessible sur ce site :) ")
}

// function edit(element)
// {
//     alert("Editer");
// }

function videoContext(element)
{
    var x = document.getElementById('ctxmenu1');
    if(x) x.parentNode.removeChild(x);

    var d = document.createElement('div');
    d.setAttribute('class', 'ctxmenu');
    d.setAttribute('id', 'ctxmenu1');
    element.parentNode.appendChild(d);
    d.style.left = xMousePosition + "px";
    d.style.top = yMousePosition + "px";
    d.onmouseover = function(e) { this.style.cursor = 'pointer'; }
    d.onclick = function(e) { element.parentNode.removeChild(d);  }
    document.body.onclick = function(e) { element.parentNode.removeChild(d);  }

    var p = document.createElement('p');
    d.appendChild(p);
    p.onclick=function() { rename(element) };
    p.setAttribute('class', 'ctxline');
    p.innerHTML = "Télécharger";

    // var p2 = document.createElement('p');
    // d.appendChild(p2);
    // p2.onclick=function() { edit(element) };
    // p2.setAttribute('class', 'ctxline');
    // p2.innerHTML = "Stop";

    return false;
}