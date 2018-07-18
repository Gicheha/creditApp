$(document).ready(function () {

    //Submit Event
    $('#upload').bind("click", function(event){
                
        
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;//regex for Checking valid files csv of txt 
        
        //Checking for CSV File
        if (regex.test($("#fileUpload").val().toLowerCase())) 
        {
            if(typeof(FileReader) != "undefined") {
                var reader = new FileReader();
                
                reader.onload = function(e)
                {
                    //Split into Rows
                    var rows = e.target.result.split(/\r?\n|\r/);

                    if(rows.length > 0)
                    {
                        //First Row as Identifiers
                        var first_Row_Cells = splitCSVtoCells(rows[0], ","); //Taking Headings
                        var jsonArray = new Array();
                        
                    
                        //Iteratively create JSON Objects using first row and the rest
                        for(var i = 1; i < rows.length ; i++){
                            
                            var cells = splitCSVtoCells(rows[i], ",");
                            var obj = {};
                            
                        
                            for(var j = 0; j < cells.length; j++)
                            {
                                obj[first_Row_Cells[j]] = cells[j];
                            }
                            jsonArray.push(obj);
                        }
                        
                        //alert(JSON.stringify(jsonArray));
                        
                        $.post('http://localhost/Credit/application/interface.php', JSON.stringify(jsonArray), function (result)
                        {
                            var response = JSON.parse(result);
                            alert(response.message);
                            alert(response.names);
                        });
                        
                    }
                }
                reader.readAsText($("#fileUpload")[0].files[0]);
            } 
            else
            {
                alert("This browser does not support HTML5.");
            }
        }   
        else
        {
            alert("Select a valid CSV File.");
        }
        });           
});

function splitCSVtoCells(row, separator) 
{
    return row.split(separator);
}


                        
                      
