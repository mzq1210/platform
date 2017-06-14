$(function(){
    var banner_swiper = new Swiper ('#banner_swiper', {
        loop: true,
        pagination : '.swiper-pagination',
        paginationType : 'fraction',
        
    })
    var option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        series: [
            {
                name:'房贷计算',
                type:'pie',
                radius: ['50%', '80%'],
                avoidLabelOverlap: false,
                
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '14',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {
                        value:20,
                        name:"首付总额",
                        itemStyle: {
                            normal: {
                                color:"#fdc915"
                            },
                        },
                    },
                    {
                        value:62,
                        name:"贷款总额",
                        itemStyle: {
                            normal: {
                                color:"#5aaddf"
                            },
                        },
                    },
                    {
                        value:62,
                        name:"利息总额",
                        itemStyle: {
                            normal: {
                                color:"#f1734c"
                            },
                        },
                    },
                ]
            }
        ]
    };
    echarts.init(document.getElementById('chart')).setOption(option);
})