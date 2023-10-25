

jQuery(document).ready(function(){
    function downloadCSV(csv, filename) {
      var csvFile;
      var downloadLink;

      // CSV file
      csvFile = new Blob([csv], {type: "text/csv"});

      // Download link
      downloadLink = document.createElement("a");

      // File name
      downloadLink.download = filename;

      // Create a link to the file
      downloadLink.href = window.URL.createObjectURL(csvFile);

      // Hide download link
      downloadLink.style.display = "none";

      // Add the link to DOM
      document.body.appendChild(downloadLink);

      // Click download link
      downloadLink.click();
    }


  function exportTableToCSV(filename) {

    var csv = [];
    var rows = document.querySelectorAll("table.coolca-exportable tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td.coolca-exportable, th.coolca-exportable");

        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);

        csv.push(row.join(";"));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
  }

  jQuery("#cool-ca-export2csv").click(function(){
    exportTableToCSV("example.csv");
  });

  function setBtnEvents(){

    jQuery(".coolca-edit-span").off("click");
    jQuery(".coolca-edit-span").click(function(){
      newVal = prompt("", jQuery(this).html());
      jQuery(this).html(newVal);
    });

    jQuery(".coolca-delete-btn").off("click");
    jQuery(".coolca-delete-btn").click(function(){
      if(confirm( "¿Está seguro que desea eliminar la fila? ")){
        jQuery(this).closest("tr").remove();
      }
    });

    jQuery(".coolca-add-btn").off("click");
    jQuery(".coolca-add-btn").click(function(){
      jQuery(this).closest('tr').after(jQuery(this).closest('tr').clone());
      setBtnEvents();

    });

  }

  setBtnEvents();
});
