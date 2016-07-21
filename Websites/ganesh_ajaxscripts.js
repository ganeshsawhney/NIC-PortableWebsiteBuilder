var wname = 'ganesh'; 

function ajax_post1val(qry,val) {

    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = wname+"_update.php?q="+qry;
    var vars = "value="+val;//+"&lastname="+ln;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("loading").innerHTML = return_data+'\t <a href="javascript:window.location.reload();">Click to Refresh</a>';
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("loading").innerHTML = "Processing Request...";
}

function ajax_post4val(qry,val1,val2,val3,val4) {

    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = wname+"_update.php?q="+qry;
    var vars = "value1="+val1+"&value2="+val2+"&value3="+val3+"&value4="+val4;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("loading").innerHTML = return_data+'\t <a href="javascript:window.location.reload();">Click to Refresh</a>';
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("loading").innerHTML = "Processing Request...";
}

function ajax_postretrieve(qry,val) {

    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = wname+"_update.php?q="+qry;
    var vars = "value="+val;//+"&lastname="+ln;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("showupdatevalues").innerHTML = return_data+'\t <a href="javascript:window.location.reload();">Click to Refresh</a>';
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("showupdatevalues").innerHTML = "Processing Request...";
}


$(document).ready(function(){

    $('#pagetitle').change(function() {
    ajax_post1val('title',$('#pagetitle').val());
    });


    $('#addheader').click(function() {
    ajax_post1val('addheader','1');
    });

    $('#removeheader').click(function() {
    ajax_post1val('addheader','0');
    });

    $('#changeheader').click(function() {
    ajax_postretrieve('showheader','0');
    });

    $( document ).on( 'click', '.deleteheaderrow', function() {
    ajax_post1val('deleteheaderrow',this.id);
    ajax_postretrieve('showheader','0');
    });

    $('#enableaddheader').click(function() {
    $('#showupdatevalues').html('<select id="addheaderrowpos"> <option value="l">Left</option> <option value="r">Right</option> </select><label>Group</label><input type="text" id="addheaderrowgrp" /> <label>Name</label> <input type="text" id="addheaderrowname" />  <label>Link</label> <input type="text" id="addheaderrowlink" /> <button class="btn btn-info btn-xs" id="addheaderrow">Add Link</button>');
    });

    $( document ).on( 'click', '#addheaderrow', function() {
    ajax_post4val('addheaderrow',$('#addheaderrowpos').val(),$('#addheaderrowgrp').val(),$('#addheaderrowname').val(),$('#addheaderrowlink').val());
    });



});