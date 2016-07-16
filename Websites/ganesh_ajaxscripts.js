var wname = 'ganesh'; 

function showtitle() 
{
        if (window.XMLHttpRequest) 
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
        else 
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() 
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("title").innerHTML = xmlhttp.responseText;
            }
        };
        var agrument=wname+'_'+"getinfo.php?q=title";
        xmlhttp.open("GET",agrument,true);
        xmlhttp.send();
}

showtitle();
