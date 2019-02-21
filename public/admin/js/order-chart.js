  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieChart       = new Chart(pieChartCanvas)
  var PieData        = [
    {
    value    : confirmed['quantity'],
    color    : '#3c8dbc',
    highlight: '#3c8dbc',
    label    : confirmed['title'],
    },
    {
    value    : processing['quantity'],
    color    : '#d81b60',
    highlight: '#d81b60',
    label    : processing['title'],
    },
    {
    value    : quality_check['quantity'],
    color    : '#3d9970',
    highlight: '#3d9970',
    label    : quality_check['title'],
    },
    {
    value    : dispatched_item['quantity'],
    color    : '#605ca8',
    highlight: '#605ca8',
    label    : dispatched_item['title'],
    },
    {
    value    : delivered['quantity'],
    color    : '#001f3f',
    highlight: '#001f3f',
    label    : delivered['title'],
    },
    {
    value    : canceled['quantity'],
    color    : '#dd4b39',
    highlight: '#dd4b39',
    label    : canceled['title'],
    },
    {
    value    : pending['quantity'],
    color    : '#f39c12',
    highlight: '#f39c12',
    label    : pending['title'],
    }
  ]
  var pieOptions     = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    //String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    //Number - The width of each segment stroke
    segmentStrokeWidth   : 2,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps       : 100,
    //String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : true,
    //String - A legend template
    legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
