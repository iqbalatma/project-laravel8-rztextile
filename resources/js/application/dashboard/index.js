$(document).ready(function(){
  const ctx = $("#salesChart").get(0).getContext("2d");

  const salesChartOption ={
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: 'Summary Sales Data'
      },
    },
    interaction: {
      intersect: false,
    },
    scales: {
      x: {
        display: true,
        title: {
          display: true,
          text: "This Month"
        }
      },
      y: {
        display: true,
        title: {
          display: true,
          text: 'Amount in Rupiah'
        },
      }
    },
  }

  $.ajax({
      url: "ajax/dashboard/sales-summary",
      type: "GET",
      dataType: "json",
  }).done(function (res) {
    console.log(res);
      let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: res.data.period,
            datasets: [{
                label: 'Sales Data',
                data: res.data.total_bill,
                cubicInterpolationMode: 'monotone',
                tension: 0.5,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: salesChartOption
    });
    
    myChart.options.scales.x.title.text = res.data.month;
    myChart.update();
  });



})
