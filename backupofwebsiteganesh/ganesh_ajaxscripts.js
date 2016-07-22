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
    $('#showupdatevalues').html('<select id="addheaderrowpos"> <option value="l">Left</option> <option value="r">Right</option><br></select><br><label>Group</label><input type="text" id="addheaderrowgrp" /><br><label>Name</label> <input type="text" id="addheaderrowname" /><br><label>Link</label> <input type="text" id="addheaderrowlink" /><br><button class="btn btn-info btn-xs" id="addheaderrow">Add Link</button><br><br>');
    });

    $( document ).on( 'click', '#addheaderrow', function() {
    ajax_post4val('addheaderrow',$('#addheaderrowpos').val(),$('#addheaderrowgrp').val(),$('#addheaderrowname').val(),$('#addheaderrowlink').val());
    });








    $('#addimageslider').click(function() {
    ajax_post1val('addimageslider','1');
    });

    $('#removeimageslider').click(function() {
    ajax_post1val('addimageslider','0');
    });


    $('#changeimageslider').click(function() {
    ajax_postretrieve('showimageslider','0');
    });

    $( document ).on( 'click', '.deleteimagesliderrow', function() {
    ajax_post1val('deleteimagesliderrow',this.id);
    ajax_postretrieve('showimageslider','0');
    });

    $('#enableimageslider').click(function() {
    $('#showupdatevalues').html('<form id="form"><label style="display:inline-block;">Upload</label> &nbsp <input style="display:inline-block;" type="file" id="fileToUpload" name="fileToUpload" /> <br><label>Caption</label> <input type="text" id="imageslidercaption" name="imageslidercaption" /> &nbsp <label>Caption Color</label> <input type="text" id="imageslidercpcolor" name="imageslidercpcolor" /><br><label>AlternateText</label> <input type="text" id="imageslideralt" name="imageslideralt" /> <br><input type="submit" class="btn btn-info btn-xs" id="addimagesliderrow" value="Add Image"/><br><br></form>');
    });







    $( document ).on( 'click', '#enableaddrow', function() {
    $('#showupdatevalues').html('<label>Row-Name</label><input type="text" id="addrowname" /><br><button class="btn btn-info btn-xs" id="addrow">Add Link</button><br><br>');
    });

    $( document ).on( 'click', '#addrow', function() {
    ajax_post1val('addrow',$('#addrowname').val());
    });


    $('#changebody').click(function() {
    ajax_postretrieve('changebody','0');
    });


    $( document ).on( 'click', '.addcol', function() {
    var itsname=prompt("Please enter name of the column");
    var itslength=prompt("Please enter length of the column <=16");

    while(itslength>16)
    {
        var itslength=prompt("Value was not valid. Please enter length of the column <=16");
    }

    ajax_post4val('addcol',this.id,itsname,itslength,0);
    ajax_postretrieve('changebody','0');
    });


    $( document ).on( 'click', '.deletecol', function() {
    ajax_post1val('deletecol',this.id);
    ajax_postretrieve('changebody','0');
    });

    $( document ).on( 'click', '.adddata', function() {
    var itsname=prompt("Please enter text of the Data");
    ajax_post4val('adddata',itsname,this.id,0,0);
    });

    $( document ).on( 'click', '.deletedata', function() {
    ajax_post1val('deletedata',this.id);
    });

});












$( document ).on( 'click', '#addimagesliderrow', function(e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: wname+"_update.php?q=addimagesliderrow",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#loading").fadeOut();
   },
   success: function(data)
      {
    if(data=='invalid file')
    {
     // invalid file format.
     $("#loading").html("Invalid File !").fadeIn();
    }
    else
    {
     // view uploaded file.
     $("#loading").html(data+'\t <a href="javascript:window.location.reload();">Click to Refresh</a>').fadeIn();
     $("#form")[0].reset(); 
    }
      },
     error: function(e) 
      {
    $("#showupdatevalues").html(e).fadeIn();
      }          
    });
 }));
});