//counter-count
$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
//counter-count

// Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        barGap:20,
        barSizeRatio:1,
        data: [{
            y: '2019',
            a: 100,
            b: 90,
            c: 80,
            e: 70,
            f: 60,
            g: 50,
            h: 40,
            i: 30,
           
            
        }],
        xkey: 'y',
        ykeys: ['a', 'b', 'c', 'e' , 'f', 'g', 'h','i'],
        labels: ['A', 'B', 'C', 'E' , 'F', 'G', 'H' , 'j'],
        barColors:['#5e63b6'],
        hideHover: 'auto',
        gridLineColor: '#eef0ee',
        resize: true,
      
    });
    
    

$("#sparkline1").sparkline([8,6,9,8,9,8,7,10,8,6,9,8,9,8,7,10], {
type: 'bar',
height: '30',
barWidth:3,
barSpacing:4,
barColor: '#6772e5'
})

$("#sparkline2").sparkline([8,6,9,8,9,8,7,10,8,6,9,8,9,8,7,10], {
type: 'bar',
height: '30',
barWidth:3,
barSpacing:4,
barColor: '#6772e5'
})

$("#sparkline3").sparkline([8,6,9,8,9,8,7,10,8,6,9,8,9,8,7,10], {
type: 'bar',
height: '30',
barWidth:3,
barSpacing:4,
barColor: '#6772e5'
})

$("#sparkline4").sparkline([8,6,9,8,9,8,7,10,8,6,9,8,9,8,7,10], {
type: 'bar',
height: '30',
barWidth:3,
barSpacing:4,
barColor: '#6772e5'
})


$("#sparkline5").sparkline([8,6,9,8,9,8,7,10,8,6,9,8,9,8,7,10], {
type: 'bar',
height: '30',
barWidth:3,
barSpacing:4,
barColor: '#6772e5'
})


$("#sparkline6").sparkline([8,6,9,8,9,8,7,10,8,6,9,8,9,8,7,10], {
type: 'bar',
height: '30',
barWidth:3,
barSpacing:4,
barColor: '#6772e5'
})

$("#sparkline7").sparkline([8,6,9,8,9,8,7,10,8,6,9,8,9,8,7,10], {
type: 'bar',
height: '30',
barWidth:3,
barSpacing:4,
barColor: '#6772e5'
})

    
    
