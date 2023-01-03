var chart = new CanvasJS.Chart("chartContainer", {
	title: {
  	text: "Render Chart from HTML Table Data"
  },
  subtitles: [
  	{
    	text: ""
    }
  ],
  data: [
    {
      type: "line",
      dataPoints: []
    }					
  ]
});

function header_clicked(clicked_id){
    var colIndex = $(this).parent().children().index($(event.srcElement.id));
    var items=[];
    chart.options.data[0].dataPoints = [];

        $('#dataTable tbody tr td:nth-child('+(colIndex+1)+')').each( function(){    
            items.push( $(this).text() );       
        });
    for(var i = 0; i < items.length; i++){
            chart.options.data[0].dataPoints.push({y: Number(items[i])})
    } 
    
        chart.options.subtitles[0].text = "Datapoints " + (colIndex + 1);
        chart.render(); 
}