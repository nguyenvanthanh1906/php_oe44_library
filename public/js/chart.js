var _token = $('input[name="_token"]').val();
var ctx = $('#myChart')[0].getContext('2d');
var url = 'charts/week/' + $('#weeks').val()
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Monday', 'Tuesday', 'Wedsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [{
            data: [],
            label: 'Week',
            backgroundColor: [
                'rgba(60, 179, 113)',
                'rgba(255, 0, 0)',
                'rgba(253, 254, 2)',
                'rgba(0, 0, 255)',
                'rgba(238, 130, 238)',
                'rgba(106, 90, 205)',
                'rgba(255, 114, 0)'
            ],
            
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
       
    }
});
$("#weeks").change(function() {
    let url = 'charts/week/' + $('#weeks').val()
    console.log(url)
    $.ajax({
        async: false,
        url: url,
        method: "GET", 
        data: { 
            _token:_token,
        },
        success:function(data){ 
            myChart.data.datasets[0].data = data
            myChart.update()
        }
    });
});

$.ajax({
    async: false,
    url: url, 
    method: "GET", 
    data: { 
        _token:_token,
    },
    success:function(data){ 
        myChart.data.datasets[0].data = data
        myChart.update()
    }
});

var ctx2 = $('#myChartMonth')[0].getContext('2d');
var url2 = 'charts/month/' + $('#months').val()
var myChartMonth = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            data: [],
            label: 'Month',
            fill: true,
            borderColor: 'rgb(245, 66, 66)',
            backgroundColor: 'rgba(239, 179, 179, 0.5)',
            tension: 0.1
            
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
       
    }
});
$.ajax({
    async: false,
    url: url2, 
    method: "GET", 
    data: { 
        _token:_token,
    },
    success:function(data){ 
        myChartMonth.data.labels = data['daysOfMonth']
        myChartMonth.data.datasets[0].data = data['requestsOfMonth']
        myChartMonth.update()
    }
});

$("#months").change(function() {
    let url = 'charts/month/' + $('#months').val()
    $.ajax({
        async: false,
        url: url,
        method: "GET", 
        data: { 
            _token:_token,
        },
        success:function(data){ 
            myChartMonth.data.labels = data['daysOfMonth']
            myChartMonth.data.datasets[0].data = data['requestsOfMonth']
            myChartMonth.update()
        }
    });
});
