// detail.js
window.onload = function(){
	var banner_swiper = new Swiper ('#banner_swiper', {
    loop: true,
		pagination : '.swiper-pagination',
    paginationType : 'fraction',
    paginationFractionRender: function (swiper, currentClassName, totalClassName) {
        return '<i class="icon iconfont">&#xe60c;</i>&nbsp;&nbsp;<span class="' + currentClassName + '"></span>' +
         ' / ' +
         '<span class="' + totalClassName + '"></span>';
    }
	})
    var activity_swiper = new Swiper('#activity_swiper',{
        freeMode : true,
        slidesPerView: 'auto',
        spaceBetween: 10,
    })
    var recommend_swiper = new Swiper('#recommend_swiper',{
        freeMode : true,
        slidesPerView: 'auto',
        spaceBetween: 10,
    })
    var area_recommend_swiper = new Swiper('#area_recommend_swiper',{
        freeMode : true,
        slidesPerView: 'auto',
        spaceBetween: 10,
    })

    // map
    //创建和初始化地图函数：
    function initMap(){
      createMap();//创建地图
      setMapEvent();//设置地图事件
      addMapControl();//向地图添加控件
      addMapOverlay();//向地图添加覆盖物
    }
    function createMap(){ 
      map = new BMap.Map("map"); 
      map.centerAndZoom(new BMap.Point(104.093881,30.654082),15);
    }
    function setMapEvent(){
      map.enableDragging();
      map.enableDoubleClickZoom()
    }
    function addClickHandler(target,window){
      target.addEventListener("click",function(){
        target.openInfoWindow(window);
      });
    }
    function addMapOverlay(){
      var markers = [
        {content:"",title:"",imageOffset: {width:-92,height:-21},position:{lat:30.653274,lng:104.09345}}
      ];
      for(var index = 0; index < markers.length; index++ ){
        var point = new BMap.Point(markers[index].position.lng,markers[index].position.lat);
        var marker = new BMap.Marker(point,{icon:new BMap.Icon("../img/aroundhouse-icon-location.png",new BMap.Size(28,36))});
        var label = new BMap.Label(markers[index].title,{offset: new BMap.Size(25,5)});
        var opts = {
          width: 200,
          title: markers[index].title,
          enableMessage: false
        };
        var infoWindow = new BMap.InfoWindow(markers[index].content,opts);
        marker.setLabel(label);
        addClickHandler(marker,infoWindow);
        map.addOverlay(marker);
      };
    }
    //向地图添加控件
    function addMapControl(){
      var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
      // map.addControl(navControl);
    }
    var map;
    initMap();


    var data=['2万', '3万', '6万', '1万','2万','5万']
    // chart
    option = {
      tooltip : {
        trigger: 'axis',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        }
      },
      legend: {
          data:[
            {
              name:'本楼盘（住宅）',
              icon:'image://../img/light_legend.svg',
              textStyle:{
                'color':'#1c2627'
              }
            },
            {
              name:'锦江区（住宅）',
              icon:'image://../img/dark_legend.svg',
              textStyle:{
                'color':'#1c2627',
              }
            }
          ],
          itemWidth:22,
          bottom:'10px'
      },
      grid: {
          show: true,
          left: '3%',
          right: '4%',
          top: '3%',
          backgroundColor: '#f8f8f8',
          containLabel: true
      },
      toolbox: {
          feature: {
              saveAsImage: {}
          }
      },
      xAxis: {
          type: 'category',
          boundaryGap: false,
          splitLine: {
            show: true,
            lineStyle: {
              color: ['#eeeff4']
            }
          },
          axisLine: {
            lineStyle: {
              color: ['#e6e6e6']
            }
          },
          axisLabel: {
            show:true,
            textStyle:{
              color:'#a1a2a4'
            }
          },
          data: ['2月','3月','4月','5月','6月','7月']
      },
      yAxis: {
          type: 'category',
          boundaryGap: false,
          axisLine: {
            lineStyle: {
              color: ['#e6e6e6']
            }
          },
          axisLabel: {
            show:true,
            textStyle:{
              color:'#a1a2a4',
            }
          },
          data: ['0万','1万','2万','3万','4万','5万','6万','7万']
      },
      series: [
          {
              name:'本楼盘（住宅）',
              type:'line',
              symbol:'image://../img/pricetrend-dot-thehouse_light.png',
              symbolSize:7,
              lineStyle: {
                normal:{
                  width:1,
                  color:'#fb7d37'
                }
              },
              stack: '总量',
              data:[3.8, 4, 3.5, 3.2, 5, 6]
          },
          {
              name:'锦江区（住宅）',
              type:'line',
              symbolSize:7,
              symbol:'image://../img/pricetrend-icon-theareatrend_dark.png',
              lineStyle: {
                normal:{
                  width:1,
                  color:'#0aa3e9'
                }
              },
              stack: '总量',
              data:[3, 3.8, 4.5, 4, 4.5, 4]
          },
          
      ]
    };
    echarts.init(document.getElementById('main')).setOption(option);
}