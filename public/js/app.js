function _(id){
    return document.getElementById(id);
}

//function to load an image for preview before upload
function imgPreview(pid,fid){
    var preview = _(pid);
    var file = _(fid).files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function(){
        preview.src = reader.result;
    }, false);

    if(file){
        reader.readAsDataURL(file);
    }
}

function fetchPerfomanceStats(){
    var session = $("#stats-session").val();
    var cat = $("#stats-cat").val();
    var term = $("#stats-term").val();
    $.get("./admin/resultStatsCntrl?cat="+cat+"&year="+session+"&term="+term, function(data, status){
        var res = JSON.parse(data);

        if(res.status == "Success"){

            var data = {
              labels: [
                'Fail',
                'Pass'
              ],
              datasets: [{
                label: 'Class Performance',
                data: [res.fail, res.pass],
                backgroundColor: [
                  'rgb(255, 99, 132)',
                  'rgb(54, 162, 235)'
                ],
                hoverOffset: 4
              }]
            };
            var config = {
             type: 'pie',
             data: data,
            };

            $("#statsView").html("");

            $("#statsView").html('<canvas id="myChart" class="animated fadeIn" height="100"></canvas>');

            myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            myChart.canvas.parentNode.style.height = '260px';
            myChart.canvas.parentNode.style.width = '260px';

        }else{
            swal("info","Results not ready yet!","info");
        }
    });
}

function fetchSubPerfomanceStats(){
    var session = $("#sub-stats-session").val();
    var cl = $("#sub-stats-class").val();
    var cat = $("#sub-stats-cat").val();
    var term = $("#sub-stats-term").val();
    var sub = $("#sub-stats-subject").val();
    $.get("./admin/resultSubStatsCntrl?cat="+cat+"&year="+session+"&class="+cl+"&term="+term+"&subject="+sub, function(data, status){
        var res = JSON.parse(data);

        if(res.status == "Success"){
            console.log(res.grades);
            console.log(res.performance);
            var labels = res.grades;
            var data = {
              labels: labels,
              datasets: [{
                label: cl+' Performance Chart for '+sub+ ' in '+term+' Term',
                data: res.performance,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 205, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(201, 203, 207, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 205, 86, 0.2)'
                ],
                borderColor: [
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                  'rgb(255, 205, 86)',
                  'rgb(75, 192, 192)',
                  'rgb(54, 162, 235)',
                  'rgb(153, 102, 255)',
                  'rgb(201, 203, 207)',
                  'rgb(255, 205, 86)',
                  'rgb(153, 102, 255)'
                ],
                borderWidth: 1
              }]
            };
            var config = {
              type: 'bar',
              data: data,
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              },
            };

            $("#subStatsView").html("");

            $("#subStatsView").html('<canvas id="mySubChart" class="animated fadeIn" height="273"></canvas>');

            myChart = new Chart(
                document.getElementById('mySubChart'),
                config
            );
            myChart.canvas.parentNode.style.height = '100%';
            myChart.canvas.parentNode.style.width = '100%';

        }else{
            swal("info","Results not ready yet!","info");
        }
    });
}

//save school detail changes
function saveSetup(){
     $("#setupForm").submit(function(e){
         e.preventDefault();
     });
     var file = _("school-logo").files[0];

     var schl_name = $("#schl-name").val();
     var country = $("#schl-country").val();
     var state =  $("#schl-state").val();
     var motto = $("#schl-motto").val();
     var email = $("#email").val();
     var schlPobox = $("#schl-pobox").val();
     var exam_officer = $("#exam-officer").val();
     // var password = $("#password").val();
     var department = $("#department").val();

     var formdata = new FormData();

     if(!file){
         // console.log("No file");
         //submit changes without image
         formdata.append("name", schl_name);
         formdata.append("country", country);
         formdata.append("state", state);
         formdata.append("motto", motto);
         formdata.append("email", email);
         // formdata.append("password", password);
         formdata.append("schlPobox", schlPobox);
         formdata.append("exam_officer", exam_officer);
         formdata.append("department", department);

     }else{

         //console.log(file);

         formdata.append("logo", file);
         formdata.append("name", schl_name);
         formdata.append("country", country);
         formdata.append("state", state);
         formdata.append("motto", motto);
         // formdata.append("password", password);
         formdata.append("email", email);
         formdata.append("schlPobox", schlPobox);
         formdata.append("exam_officer", exam_officer);
         formdata.append("department", department);
     }

     $.ajax({
         url: "./saveSetup",
         type: 'POST',
         data: formdata,
         contentType: false,
         processData: false,
         // dataType: "json",
         beforeSend: function(){
             _("saveSetUpBtn").disabled = true;
             $("#saveSetUpBtn").val("Processing...");
         },
         success: function(resp){
             $("#saveSetUpBtn").val("Save Changes");
             _("saveSetUpBtn").disabled = false;
             // console.log(resp);
             // return;
             var response = JSON.parse(resp);

             if(response.status === "Success"){
                 swal("Info","Changes saved successfully!","success").then((value)=>{
                     _("saveSetUpBtn").disabled = false;
                 });
                 location.assign("./");
             }else{
                 $("#saveSetUpBtn").html("Save Changes");
                 swal("Oooops!",response.status,"error").then((value)=>{
                     _("saveSetUpBtn").disabled = false;
                 });
             }
             return;
         },
         complete: function(){
             _("saveSetUpBtn").disabled = false;
             $("#saveSetUpBtn").val("Save Changes");
             return;
         },
         error: function(err){
             _("saveSetUpBtn").disabled = false;
             $("#saveSetUpBtn").val("Save Changes");
             swal("Oooops!","Something went wrong with your request...","error");
             return;
         }
     });
}

function uploadResultCSV(cat,csvclass,term,year){
    $("#csv-cat").val(cat);
    $("#csv-class").val(csvclass);
    $("#csv-term").val(term);
    $("#csv-session").val(year);
    $("#csvResultModal").modal('show');
    $("#uploadInfo").html("");
}

function submitCSVResult(){
    $("#uploadInfo").html("");
    var cat = $("#csv-cat").val();
    var csvclass = $("#csv-class").val();
    var term = $("#csv-term").val();
    var year = $("#csv-session").val();

     $("#submitCsvResultForm").submit(function(e){
        e.preventDefault();
    });
    var file = _("csv-file").files[0];

    var formdata = new FormData();

    if(!file){
        console.log("No file");
        //submit changes without image
        swal("Ooops!","You must select a CSV file for upload!","error");

        return;

    }else{

        console.log(file);

        formdata.append("file", file);
        formdata.append("cat", cat);
        formdata.append("class", csvclass);
        formdata.append("term", term);
        formdata.append("year", year);
    }
    var url = "";
    if(term == "First"){
        url = "./admin/processCSVFileCntrl";
    }
    if(term == "Second"){
        url = "./admin/processSecondTermCSVResultCntrl";
    }
    if(term == "Third"){
        url = "./admin/processThirdTermCSVResultCntrl";
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        // dataType: "json",
        beforeSend: function(){
            _("uploadCsvResultBtn").disabled = true;
            //$("#uploadCsvResultBtn").html("<i class='fa fa-spin'></i> ...");
        },
        success: function(resp){
            //$("#uploadCsvResultBtn").html("Save Changes");
            _("uploadCsvResultBtn").disabled = false;
            // console.log(resp);
            // return;
            var response = JSON.parse(resp);

            if(response.status === "Success"){
                _("csv-file").value = "";
                $("#uploadInfo").html(response.details);
                loadStudents2();
                return;
                // swal("Info","Changes saved successfully!","success").then((value)=>{
                //     $("#uploadCsvResultBtn").disabled = false;
                // });
            }else{
                $("#uploadInfo").html(response.details);
                return;
                // $("#uploadCsvResultBtn").html("Save Changes");
                // swal("Oooops!",response.status,"error").then((value)=>{
                //     $("#uploadCsvResultBtn").disabled = false;
                // });
            }
            return;
        },
        complete: function(){
            _("uploadCsvResultBtn").disabled = false;
            // $("#uploadCsvResultBtn").html("Save Changes");
            return;
        },
        error: function(err){
            _("uploadCsvResultBtn").disabled = false;
            // $("#uploadCsvResultBtn").html("Save Changes");
            swal("Oooops!","Something went wrong with your request...","error");
            return;
        }
    });

}

function enrollStudentsCSV(){

     $("#enrollStdCSVForm").submit(function(e){
        e.preventDefault();
    });
    var file = _("enroll-std-file").files[0];

    var formdata = new FormData();

    if(!file){
        console.log("No file");
        //submit changes without image
        swal("Ooops!","You must select a CSV file for upload!","error");
    }else{

        console.log(file);

        formdata.append("file", file);
    }

    $.ajax({
        url: "./admin/registerStudentsCSVCntrl",
        type: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        // dataType: "json",
        beforeSend: function(){
            _("enrollStdCsvBtn").disabled = true;
            //$("#enrollStdCsvBtn").html("<i class='fa fa-spin'></i> ...");
        },
        success: function(resp){
            _("enrollStdCsvBtn").disabled = false;
            // console.log(resp);
            // return;
            var response = JSON.parse(resp);

            if(response.status === "Success"){
                swal("Info","Students enrolled successfully!","success").then((value)=>{
                    _("enrollStdCsvBtn").disabled = false;
                });
            }else{
                $("#uploadInfo").html(resp);
                $("#enrollStdCsvBtn").html("Save Changes");
                swal("Oooops!",response.status,"error").then((value)=>{
                    _("enrollStdCsvBtn").disabled = false;
                });
            }
            return;
        },
        complete: function(){
            _("enrollStdCsvBtn").disabled = false;
            return;
        },
        error: function(err){
            _("enrollStdCsvBtn").disabled = false;
            swal("Oooops!","Something went wrong with your request...","error");
            return;
        }
    });
}

function saveToPdf(){
    var HTML_Width = $("#resultBroadsheet").width();
    var HTML_Height = $("#resultBroadsheet").height();
    var top_left_margin = 10;
    var PDF_Width = HTML_Width+(top_left_margin*2);
    var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;

    html2canvas($("#resultBroadsheet")[0],{allowTaint:true}).then(function(canvas) {
        canvas.getContext('2d');

        console.log(canvas.height+"  "+canvas.width);

        var imgData = canvas.toDataURL("image/png", 1);
        //console.log(imgData);
        var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'PNG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);

        for (var i = 1; i <= totalPDFPages; i++) {
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'PNG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        var rand = Math.random();
        var rdate = new Date().toLocaleDateString();

        pdf.save("result"+rdate+"_"+rand+".pdf");
    });
}
