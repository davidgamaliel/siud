/*
 Highmaps JS v5.0.2 (2016-10-26)
 Highmaps as a plugin for Highcharts 4.1.x or Highstock 2.1.x (x being the patch version of this file)

 (c) 2011-2016 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(v){"object"===typeof module&&module.exports?module.exports=v:v(Highcharts)})(function(v){(function(a){var m=a.Axis,n=a.each,k=a.pick;a=a.wrap;a(m.prototype,"getSeriesExtremes",function(a){var d=this.isXAxis,t,m,u=[],q;d&&n(this.series,function(a,b){a.useMapGeometry&&(u[b]=a.xData,a.xData=[])});a.call(this);d&&(t=k(this.dataMin,Number.MAX_VALUE),m=k(this.dataMax,-Number.MAX_VALUE),n(this.series,function(a,b){a.useMapGeometry&&(t=Math.min(t,k(a.minX,t)),m=Math.max(m,k(a.maxX,t)),a.xData=u[b],
q=!0)}),q&&(this.dataMin=t,this.dataMax=m))});a(m.prototype,"setAxisTranslation",function(a){var g=this.chart,d=g.plotWidth/g.plotHeight,g=g.xAxis[0],k;a.call(this);"yAxis"===this.coll&&void 0!==g.transA&&n(this.series,function(a){a.preserveAspectRatio&&(k=!0)});if(k&&(this.transA=g.transA=Math.min(this.transA,g.transA),a=d/((g.max-g.min)/(this.max-this.min)),a=1>a?this:g,d=(a.max-a.min)*a.transA,a.pixelPadding=a.len-d,a.minPixelPadding=a.pixelPadding/2,d=a.fixTo)){d=d[1]-a.toValue(d[0],!0);d*=a.transA;
if(Math.abs(d)>a.minPixelPadding||a.min===a.dataMin&&a.max===a.dataMax)d=0;a.minPixelPadding-=d}});a(m.prototype,"render",function(a){a.call(this);this.fixTo=null})})(v);(function(a){var m=a.Axis,n=a.Chart,k=a.color,d,g=a.each,t=a.extend,z=a.isNumber,u=a.Legend,q=a.LegendSymbolMixin,c=a.noop,b=a.merge,f=a.pick,r=a.wrap;d=a.ColorAxis=function(){this.init.apply(this,arguments)};t(d.prototype,m.prototype);t(d.prototype,{defaultColorAxisOptions:{lineWidth:0,minPadding:0,maxPadding:0,gridLineWidth:1,tickPixelInterval:72,
startOnTick:!0,endOnTick:!0,offset:0,marker:{animation:{duration:50},width:.01,color:"#999999"},labels:{overflow:"justify"},minColor:"#e6ebf5",maxColor:"#003399",tickLength:5,showInLegend:!0},init:function(a,e){var l="vertical"!==a.options.legend.layout,c;this.coll="colorAxis";c=b(this.defaultColorAxisOptions,{side:l?2:1,reversed:!l},e,{opposite:!l,showEmpty:!1,title:null});m.prototype.init.call(this,a,c);e.dataClasses&&this.initDataClasses(e);this.initStops(e);this.horiz=l;this.zoomEnabled=!1;this.defaultLegendLength=
200},tweenColors:function(b,a,c){var l;a.rgba.length&&b.rgba.length?(b=b.rgba,a=a.rgba,l=1!==a[3]||1!==b[3],b=(l?"rgba(":"rgb(")+Math.round(a[0]+(b[0]-a[0])*(1-c))+","+Math.round(a[1]+(b[1]-a[1])*(1-c))+","+Math.round(a[2]+(b[2]-a[2])*(1-c))+(l?","+(a[3]+(b[3]-a[3])*(1-c)):"")+")"):b=a.input||"none";return b},initDataClasses:function(a){var l=this,c=this.chart,f,h=0,p=c.options.chart.colorCount,d=this.options,q=a.dataClasses.length;this.dataClasses=f=[];this.legendItems=[];g(a.dataClasses,function(a,
e){a=b(a);f.push(a);a.color||("category"===d.dataClassColor?(e=c.options.colors,p=e.length,a.color=e[h],a.colorIndex=h,h++,h===p&&(h=0)):a.color=l.tweenColors(k(d.minColor),k(d.maxColor),2>q?.5:e/(q-1)))})},initStops:function(a){this.stops=a.stops||[[0,this.options.minColor],[1,this.options.maxColor]];g(this.stops,function(a){a.color=k(a[1])})},setOptions:function(a){m.prototype.setOptions.call(this,a);this.options.crosshair=this.options.marker},setAxisSize:function(){var a=this.legendSymbol,b=this.chart,
c=b.options.legend||{},f,h;a?(this.left=c=a.attr("x"),this.top=f=a.attr("y"),this.width=h=a.attr("width"),this.height=a=a.attr("height"),this.right=b.chartWidth-c-h,this.bottom=b.chartHeight-f-a,this.len=this.horiz?h:a,this.pos=this.horiz?c:f):this.len=(this.horiz?c.symbolWidth:c.symbolHeight)||this.defaultLegendLength},toColor:function(a,b){var c=this.stops,e,h,l=this.dataClasses,f,d;if(l)for(d=l.length;d--;){if(f=l[d],e=f.from,c=f.to,(void 0===e||a>=e)&&(void 0===c||a<=c)){h=f.color;b&&(b.dataClass=
d,b.colorIndex=f.colorIndex);break}}else{this.isLog&&(a=this.val2lin(a));a=1-(this.max-a)/(this.max-this.min||1);for(d=c.length;d--&&!(a>c[d][0]););e=c[d]||c[d+1];c=c[d+1]||e;a=1-(c[0]-a)/(c[0]-e[0]||1);h=this.tweenColors(e.color,c.color,a)}return h},getOffset:function(){var a=this.legendGroup,b=this.chart.axisOffset[this.side];a&&(this.axisParent=a,m.prototype.getOffset.call(this),this.added||(this.added=!0,this.labelLeft=0,this.labelRight=this.width),this.chart.axisOffset[this.side]=b)},setLegendColor:function(){var a,
b=this.options,c=this.reversed;a=c?1:0;c=c?0:1;a=this.horiz?[a,0,c,0]:[0,c,0,a];this.legendColor={linearGradient:{x1:a[0],y1:a[1],x2:a[2],y2:a[3]},stops:b.stops||[[0,b.minColor],[1,b.maxColor]]}},drawLegendSymbol:function(a,b){var c=a.padding,e=a.options,h=this.horiz,l=f(e.symbolWidth,h?this.defaultLegendLength:12),d=f(e.symbolHeight,h?12:this.defaultLegendLength),g=f(e.labelPadding,h?16:30),e=f(e.itemDistance,10);this.setLegendColor();b.legendSymbol=this.chart.renderer.rect(0,a.baseline-11,l,d).attr({zIndex:1}).add(b.legendGroup);
this.legendItemWidth=l+c+(h?e:g);this.legendItemHeight=d+c+(h?g:0)},setState:c,visible:!0,setVisible:c,getSeriesExtremes:function(){var a;this.series.length&&(a=this.series[0],this.dataMin=a.valueMin,this.dataMax=a.valueMax)},drawCrosshair:function(a,b){var c=b&&b.plotX,f=b&&b.plotY,h,e=this.pos,l=this.len;b&&(h=this.toPixels(b[b.series.colorKey]),h<e?h=e-2:h>e+l&&(h=e+l+2),b.plotX=h,b.plotY=this.len-h,m.prototype.drawCrosshair.call(this,a,b),b.plotX=c,b.plotY=f,this.cross&&(this.cross.addClass("highcharts-coloraxis-marker").add(this.legendGroup),
this.cross.attr({fill:this.crosshair.color})))},getPlotLinePath:function(a,b,c,f,h){return z(h)?this.horiz?["M",h-4,this.top-6,"L",h+4,this.top-6,h,this.top,"Z"]:["M",this.left,h,"L",this.left-6,h+6,this.left-6,h-6,"Z"]:m.prototype.getPlotLinePath.call(this,a,b,c,f)},update:function(a,c){var f=this.chart,e=f.legend;g(this.series,function(a){a.isDirtyData=!0});a.dataClasses&&e.allItems&&(g(e.allItems,function(a){a.isDataClass&&a.legendGroup.destroy()}),f.isDirtyLegend=!0);f.options[this.coll]=b(this.userOptions,
a);m.prototype.update.call(this,a,c);this.legendItem&&(this.setLegendColor(),e.colorizeItem(this,!0))},getDataClassLegendSymbols:function(){var b=this,f=this.chart,d=this.legendItems,r=f.options.legend,h=r.valueDecimals,p=r.valueSuffix||"",w;d.length||g(this.dataClasses,function(e,l){var r=!0,A=e.from,k=e.to;w="";void 0===A?w="\x3c ":void 0===k&&(w="\x3e ");void 0!==A&&(w+=a.numberFormat(A,h)+p);void 0!==A&&void 0!==k&&(w+=" - ");void 0!==k&&(w+=a.numberFormat(k,h)+p);d.push(t({chart:f,name:w,options:{},
drawLegendSymbol:q.drawRectangle,visible:!0,setState:c,isDataClass:!0,setVisible:function(){r=this.visible=!r;g(b.series,function(a){g(a.points,function(a){a.dataClass===l&&a.setVisible(r)})});f.legend.colorizeItem(this,r)}},e))});return d},name:""});g(["fill","stroke"],function(b){a.Fx.prototype[b+"Setter"]=function(){this.elem.attr(b,d.prototype.tweenColors(k(this.start),k(this.end),this.pos))}});r(n.prototype,"getAxes",function(a){var b=this.options.colorAxis;a.call(this);this.colorAxis=[];b&&
new d(this,b)});r(u.prototype,"getAllItems",function(a){var b=[],c=this.chart.colorAxis[0];c&&c.options&&(c.options.showInLegend&&(c.options.dataClasses?b=b.concat(c.getDataClassLegendSymbols()):b.push(c)),g(c.series,function(a){a.options.showInLegend=!1}));return b.concat(a.call(this))});r(u.prototype,"colorizeItem",function(a,b,c){a.call(this,b,c);c&&b.legendColor&&b.legendSymbol.attr({fill:b.legendColor})})})(v);(function(a){var m=a.defined,n=a.each,k=a.noop,d=a.seriesTypes;a.colorPointMixin={isValid:function(){return null!==
this.value},setVisible:function(a){var d=this,g=a?"show":"hide";n(["graphic","dataLabel"],function(a){if(d[a])d[a][g]()})}};a.colorSeriesMixin={pointArrayMap:["value"],axisTypes:["xAxis","yAxis","colorAxis"],optionalAxis:"colorAxis",trackerGroups:["group","markerGroup","dataLabelsGroup"],getSymbol:k,parallelArrays:["x","y","value"],colorKey:"value",pointAttribs:d.column.prototype.pointAttribs,translateColors:function(){var a=this,d=this.options.nullColor,k=this.colorAxis,m=this.colorKey;n(this.data,
function(g){var c=g[m];if(c=g.options.color||(g.isNull?d:k&&void 0!==c?k.toColor(c,g):g.color||a.color))g.color=c})},colorAttribs:function(a){var d={};m(a.color)&&(d[this.colorProp||"fill"]=a.color);return d}}})(v);(function(a){function m(a){a&&(a.preventDefault&&a.preventDefault(),a.stopPropagation&&a.stopPropagation(),a.cancelBubble=!0)}var n=a.addEvent,k=a.Chart,d=a.doc,g=a.each,t=a.extend,z=a.merge,u=a.pick;a=a.wrap;t(k.prototype,{renderMapNavigation:function(){var a=this,c=this.options.mapNavigation,
b=c.buttons,f,d,l,e,g,k=function(b){this.handler.call(a,b);m(b)};if(u(c.enableButtons,c.enabled)&&!a.renderer.forExport)for(f in a.mapNavButtons=[],b)b.hasOwnProperty(f)&&(l=z(c.buttonOptions,b[f]),d=l.theme,d.style=z(l.theme.style,l.style),g=(e=d.states)&&e.hover,e=e&&e.select,d=a.renderer.button(l.text,0,0,k,d,g,e,0,"zoomIn"===f?"topbutton":"bottombutton").addClass("highcharts-map-navigation").attr({width:l.width,height:l.height,title:a.options.lang[f],padding:l.padding,zIndex:5}).add(),d.handler=
l.onclick,d.align(t(l,{width:d.width,height:2*d.height}),null,l.alignTo),n(d.element,"dblclick",m),a.mapNavButtons.push(d))},fitToBox:function(a,c){g([["x","width"],["y","height"]],function(b){var f=b[0];b=b[1];a[f]+a[b]>c[f]+c[b]&&(a[b]>c[b]?(a[b]=c[b],a[f]=c[f]):a[f]=c[f]+c[b]-a[b]);a[b]>c[b]&&(a[b]=c[b]);a[f]<c[f]&&(a[f]=c[f])});return a},mapZoom:function(a,c,b,f,d){var l=this.xAxis[0],e=l.max-l.min,g=u(c,l.min+e/2),k=e*a,e=this.yAxis[0],h=e.max-e.min,p=u(b,e.min+h/2),h=h*a,g=this.fitToBox({x:g-
k*(f?(f-l.pos)/l.len:.5),y:p-h*(d?(d-e.pos)/e.len:.5),width:k,height:h},{x:l.dataMin,y:e.dataMin,width:l.dataMax-l.dataMin,height:e.dataMax-e.dataMin}),k=g.x<=l.dataMin&&g.width>=l.dataMax-l.dataMin&&g.y<=e.dataMin&&g.height>=e.dataMax-e.dataMin;f&&(l.fixTo=[f-l.pos,c]);d&&(e.fixTo=[d-e.pos,b]);void 0===a||k?(l.setExtremes(void 0,void 0,!1),e.setExtremes(void 0,void 0,!1)):(l.setExtremes(g.x,g.x+g.width,!1),e.setExtremes(g.y,g.y+g.height,!1));this.redraw()}});a(k.prototype,"render",function(a){var c=
this,b=c.options.mapNavigation;c.renderMapNavigation();a.call(c);(u(b.enableDoubleClickZoom,b.enabled)||b.enableDoubleClickZoomTo)&&n(c.container,"dblclick",function(a){c.pointer.onContainerDblClick(a)});u(b.enableMouseWheelZoom,b.enabled)&&n(c.container,void 0===d.onmousewheel?"DOMMouseScroll":"mousewheel",function(a){c.pointer.onContainerMouseWheel(a);m(a);return!1})})})(v);(function(a){var m=a.extend,n=a.pick,k=a.Pointer;a=a.wrap;m(k.prototype,{onContainerDblClick:function(a){var d=this.chart;
a=this.normalize(a);d.options.mapNavigation.enableDoubleClickZoomTo?d.pointer.inClass(a.target,"highcharts-tracker")&&d.hoverPoint&&d.hoverPoint.zoomTo():d.isInsidePlot(a.chartX-d.plotLeft,a.chartY-d.plotTop)&&d.mapZoom(.5,d.xAxis[0].toValue(a.chartX),d.yAxis[0].toValue(a.chartY),a.chartX,a.chartY)},onContainerMouseWheel:function(a){var d=this.chart,k;a=this.normalize(a);k=a.detail||-(a.wheelDelta/120);d.isInsidePlot(a.chartX-d.plotLeft,a.chartY-d.plotTop)&&d.mapZoom(Math.pow(d.options.mapNavigation.mouseWheelSensitivity,
k),d.xAxis[0].toValue(a.chartX),d.yAxis[0].toValue(a.chartY),a.chartX,a.chartY)}});a(k.prototype,"zoomOption",function(a){var d=this.chart.options.mapNavigation;a.apply(this,[].slice.call(arguments,1));n(d.enableTouchZoom,d.enabled)&&(this.pinchX=this.pinchHor=this.pinchY=this.pinchVert=this.hasZoom=!0)});a(k.prototype,"pinchTranslate",function(a,g,k,m,n,q,c){a.call(this,g,k,m,n,q,c);"map"===this.chart.options.chart.type&&this.hasZoom&&(a=m.scaleX>m.scaleY,this.pinchTranslateDirection(!a,g,k,m,n,
q,c,a?m.scaleX:m.scaleY))})})(v);(function(a){var m=a.color,n=a.ColorAxis,k=a.colorPointMixin,d=a.each,g=a.extend,t=a.isNumber,v=a.map,u=a.merge,q=a.noop,c=a.pick,b=a.isArray,f=a.Point,r=a.Series,l=a.seriesType,e=a.seriesTypes,A=a.splat,x=void 0!==a.doc.documentElement.style.vectorEffect;l("map","scatter",{allAreas:!0,animation:!1,nullColor:"#f7f7f7",borderColor:"#cccccc",borderWidth:1,marker:null,stickyTracking:!1,joinBy:"hc-key",dataLabels:{formatter:function(){return this.point.value},inside:!0,
verticalAlign:"middle",crop:!1,overflow:!1,padding:0},turboThreshold:0,tooltip:{followPointer:!0,pointFormat:"{point.name}: {point.value}\x3cbr/\x3e"},states:{normal:{animation:!0},hover:{brightness:.2,halo:null},select:{color:"#cccccc"}}},u(a.colorSeriesMixin,{type:"map",supportsDrilldown:!0,getExtremesFromAll:!0,useMapGeometry:!0,forceDL:!0,searchPoint:q,directTouch:!0,preserveAspectRatio:!0,pointArrayMap:["value"],getBox:function(b){var h=Number.MAX_VALUE,f=-h,e=h,l=-h,g=h,k=h,r=this.xAxis,m=this.yAxis,
n;d(b||[],function(b){if(b.path){"string"===typeof b.path&&(b.path=a.splitPath(b.path));var d=b.path||[],r=d.length,p=!1,m=-h,w=h,B=-h,x=h,q=b.properties;if(!b._foundBox){for(;r--;)t(d[r])&&(p?(m=Math.max(m,d[r]),w=Math.min(w,d[r])):(B=Math.max(B,d[r]),x=Math.min(x,d[r])),p=!p);b._midX=w+(m-w)*(b.middleX||q&&q["hc-middle-x"]||.5);b._midY=x+(B-x)*(b.middleY||q&&q["hc-middle-y"]||.5);b._maxX=m;b._minX=w;b._maxY=B;b._minY=x;b.labelrank=c(b.labelrank,(m-w)*(B-x));b._foundBox=!0}f=Math.max(f,b._maxX);
e=Math.min(e,b._minX);l=Math.max(l,b._maxY);g=Math.min(g,b._minY);k=Math.min(b._maxX-b._minX,b._maxY-b._minY,k);n=!0}});n&&(this.minY=Math.min(g,c(this.minY,h)),this.maxY=Math.max(l,c(this.maxY,-h)),this.minX=Math.min(e,c(this.minX,h)),this.maxX=Math.max(f,c(this.maxX,-h)),r&&void 0===r.options.minRange&&(r.minRange=Math.min(5*k,(this.maxX-this.minX)/5,r.minRange||h)),m&&void 0===m.options.minRange&&(m.minRange=Math.min(5*k,(this.maxY-this.minY)/5,m.minRange||h)))},getExtremes:function(){r.prototype.getExtremes.call(this,
this.valueData);this.chart.hasRendered&&this.isDirtyData&&this.getBox(this.options.data);this.valueMin=this.dataMin;this.valueMax=this.dataMax;this.dataMin=this.minY;this.dataMax=this.maxY},translatePath:function(a){var b=!1,h=this.xAxis,c=this.yAxis,d=h.min,f=h.transA,h=h.minPixelPadding,e=c.min,l=c.transA,c=c.minPixelPadding,k,g=[];if(a)for(k=a.length;k--;)t(a[k])?(g[k]=b?(a[k]-d)*f+h:(a[k]-e)*l+c,b=!b):g[k]=a[k];return g},setData:function(h,c,f,e){var l=this.options,k=this.chart.options.chart,
g=k&&k.map,m=l.mapData,p=l.joinBy,w=null===p,x=l.keys||this.pointArrayMap,n=[],q={},y,z=this.chart.mapTransforms;!m&&g&&(m="string"===typeof g?a.maps[g]:g);w&&(p="_i");p=this.joinBy=A(p);p[1]||(p[1]=p[0]);h&&d(h,function(a,c){var d=0;if(t(a))h[c]={value:a};else if(b(a)){h[c]={};!l.keys&&a.length>x.length&&"string"===typeof a[0]&&(h[c]["hc-key"]=a[0],++d);for(var f=0;f<x.length;++f,++d)x[f]&&(h[c][x[f]]=a[d])}w&&(h[c]._i=c)});this.getBox(h);if(this.chart.mapTransforms=z=k&&k.mapTransforms||m&&m["hc-transform"]||
z)for(y in z)z.hasOwnProperty(y)&&y.rotation&&(y.cosAngle=Math.cos(y.rotation),y.sinAngle=Math.sin(y.rotation));if(m){"FeatureCollection"===m.type&&(this.mapTitle=m.title,m=a.geojson(m,this.type,this));this.mapData=m;this.mapMap={};for(y=0;y<m.length;y++)k=m[y],g=k.properties,k._i=y,p[0]&&g&&g[p[0]]&&(k[p[0]]=g[p[0]]),q[k[p[0]]]=k;this.mapMap=q;h&&p[1]&&d(h,function(a){q[a[p[1]]]&&n.push(q[a[p[1]]])});l.allAreas?(this.getBox(m),h=h||[],p[1]&&d(h,function(a){n.push(a[p[1]])}),n="|"+v(n,function(a){return a&&
a[p[0]]}).join("|")+"|",d(m,function(a){p[0]&&-1!==n.indexOf("|"+a[p[0]]+"|")||(h.push(u(a,{value:null})),e=!1)})):this.getBox(n)}r.prototype.setData.call(this,h,c,f,e)},drawGraph:q,drawDataLabels:q,doFullTranslate:function(){return this.isDirtyData||this.chart.isResizing||this.chart.renderer.isVML||!this.baseTrans},translate:function(){var a=this,b=a.xAxis,c=a.yAxis,f=a.doFullTranslate();a.generatePoints();d(a.data,function(h){h.plotX=b.toPixels(h._midX,!0);h.plotY=c.toPixels(h._midY,!0);f&&(h.shapeType=
"path",h.shapeArgs={d:a.translatePath(h.path)})});a.translateColors()},pointAttribs:function(a,b){b=e.column.prototype.pointAttribs.call(this,a,b);a.isFading&&delete b.fill;x?b["vector-effect"]="non-scaling-stroke":b["stroke-width"]="inherit";return b},drawPoints:function(){var a=this,b=a.xAxis,c=a.yAxis,f=a.group,l=a.chart,k=l.renderer,g,m=this.baseTrans;a.transformGroup||(a.transformGroup=k.g().attr({scaleX:1,scaleY:1}).add(f),a.transformGroup.survive=!0);a.doFullTranslate()?(l.hasRendered&&d(a.points,
function(b){b.shapeArgs&&(b.shapeArgs.fill=a.pointAttribs(b,b.state).fill)}),a.group=a.transformGroup,e.column.prototype.drawPoints.apply(a),a.group=f,d(a.points,function(a){a.graphic&&(a.name&&a.graphic.addClass("highcharts-name-"+a.name.replace(/ /g,"-").toLowerCase()),a.properties&&a.properties["hc-key"]&&a.graphic.addClass("highcharts-key-"+a.properties["hc-key"].toLowerCase()))}),this.baseTrans={originX:b.min-b.minPixelPadding/b.transA,originY:c.min-c.minPixelPadding/c.transA+(c.reversed?0:c.len/
c.transA),transAX:b.transA,transAY:c.transA},this.transformGroup.animate({translateX:0,translateY:0,scaleX:1,scaleY:1})):(g=b.transA/m.transAX,f=c.transA/m.transAY,b=b.toPixels(m.originX,!0),c=c.toPixels(m.originY,!0),.99<g&&1.01>g&&.99<f&&1.01>f&&(f=g=1,b=Math.round(b),c=Math.round(c)),this.transformGroup.animate({translateX:b,translateY:c,scaleX:g,scaleY:f}));x||a.group.element.setAttribute("stroke-width",a.options[a.pointAttrToOptions&&a.pointAttrToOptions["stroke-width"]||"borderWidth"]/(g||1));
this.drawMapDataLabels()},drawMapDataLabels:function(){r.prototype.drawDataLabels.call(this);this.dataLabelsGroup&&this.dataLabelsGroup.clip(this.chart.clipRect)},render:function(){var a=this,b=r.prototype.render;a.chart.renderer.isVML&&3E3<a.data.length?setTimeout(function(){b.call(a)}):b.call(a)},animate:function(a){var b=this.options.animation,c=this.group,h=this.xAxis,f=this.yAxis,d=h.pos,e=f.pos;this.chart.renderer.isSVG&&(!0===b&&(b={duration:1E3}),a?c.attr({translateX:d+h.len/2,translateY:e+
f.len/2,scaleX:.001,scaleY:.001}):(c.animate({translateX:d,translateY:e,scaleX:1,scaleY:1},b),this.animate=null))},animateDrilldown:function(a){var b=this.chart.plotBox,c=this.chart.drilldownLevels[this.chart.drilldownLevels.length-1],f=c.bBox,h=this.chart.options.drilldown.animation;a||(a=Math.min(f.width/b.width,f.height/b.height),c.shapeArgs={scaleX:a,scaleY:a,translateX:f.x,translateY:f.y},d(this.points,function(a){a.graphic&&a.graphic.attr(c.shapeArgs).animate({scaleX:1,scaleY:1,translateX:0,
translateY:0},h)}),this.animate=null)},drawLegendSymbol:a.LegendSymbolMixin.drawRectangle,animateDrillupFrom:function(a){e.column.prototype.animateDrillupFrom.call(this,a)},animateDrillupTo:function(a){e.column.prototype.animateDrillupTo.call(this,a)}}),g({applyOptions:function(a,b){a=f.prototype.applyOptions.call(this,a,b);b=this.series;var c=b.joinBy;b.mapData&&((c=void 0!==a[c[1]]&&b.mapMap[a[c[1]]])?(b.xyFromShape&&(a.x=c._midX,a.y=c._midY),g(a,c)):a.value=a.value||null);return a},onMouseOver:function(a){clearTimeout(this.colorInterval);
if(null!==this.value)f.prototype.onMouseOver.call(this,a);else this.series.onMouseOut(a)},onMouseOut:function(){var a=this,b=+new Date,c=m(this.series.pointAttribs(a).fill),d=m(this.series.pointAttribs(a,"hover").fill),e=a.series.options.states.normal.animation,l=e&&(e.duration||500);l&&4===c.rgba.length&&4===d.rgba.length&&"select"!==a.state&&(clearTimeout(a.colorInterval),a.colorInterval=setInterval(function(){var f=(new Date-b)/l,e=a.graphic;1<f&&(f=1);e&&e.attr("fill",n.prototype.tweenColors.call(0,
d,c,f));1<=f&&clearTimeout(a.colorInterval)},13));a.isFading=!0;f.prototype.onMouseOut.call(a);a.isFading=null},zoomTo:function(){var a=this.series;a.xAxis.setExtremes(this._minX,this._maxX,!1);a.yAxis.setExtremes(this._minY,this._maxY,!1);a.chart.redraw()}},k))})(v);(function(a){var m=a.seriesType,n=a.seriesTypes;m("mapline","map",{lineWidth:1,fillColor:"none"},{type:"mapline",colorProp:"stroke",pointAttrToOptions:{stroke:"color","stroke-width":"lineWidth"},pointAttribs:function(a,d){a=n.map.prototype.pointAttribs.call(this,
a,d);a.fill=this.options.fillColor;return a},drawLegendSymbol:n.line.prototype.drawLegendSymbol})})(v);(function(a){var m=a.merge,n=a.Point;a=a.seriesType;a("mappoint","scatter",{dataLabels:{enabled:!0,formatter:function(){return this.point.name},crop:!1,defer:!1,overflow:!1,style:{color:"#000000"}}},{type:"mappoint",forceDL:!0},{applyOptions:function(a,d){a=void 0!==a.lat&&void 0!==a.lon?m(a,this.series.chart.fromLatLonToPoint(a)):a;return n.prototype.applyOptions.call(this,a,d)}})})(v);(function(a){var m=
a.merge,n=a.Point,k=a.seriesType,d=a.seriesTypes;d.bubble&&k("mapbubble","bubble",{animationLimit:500,tooltip:{pointFormat:"{point.name}: {point.z}"}},{xyFromShape:!0,type:"mapbubble",pointArrayMap:["z"],getMapData:d.map.prototype.getMapData,getBox:d.map.prototype.getBox,setData:d.map.prototype.setData},{applyOptions:function(a,k){return a&&void 0!==a.lat&&void 0!==a.lon?n.prototype.applyOptions.call(this,m(a,this.series.chart.fromLatLonToPoint(a)),k):d.map.prototype.pointClass.prototype.applyOptions.call(this,
a,k)},ttBelow:!1})})(v);(function(a){var m=a.colorPointMixin,n=a.each,k=a.merge,d=a.noop,g=a.pick,t=a.Series,v=a.seriesType,u=a.seriesTypes;v("heatmap","scatter",{animation:!1,borderWidth:0,nullColor:"#f7f7f7",dataLabels:{formatter:function(){return this.point.value},inside:!0,verticalAlign:"middle",crop:!1,overflow:!1,padding:0},marker:null,pointRange:null,tooltip:{pointFormat:"{point.x}, {point.y}: {point.value}\x3cbr/\x3e"},states:{normal:{animation:!0},hover:{halo:!1,brightness:.2}}},k(a.colorSeriesMixin,
{pointArrayMap:["y","value"],hasPointSpecificOptions:!0,supportsDrilldown:!0,getExtremesFromAll:!0,directTouch:!0,init:function(){var a;u.scatter.prototype.init.apply(this,arguments);a=this.options;a.pointRange=g(a.pointRange,a.colsize||1);this.yAxis.axisPointRange=a.rowsize||1},translate:function(){var a=this.options,c=this.xAxis,b=this.yAxis,f=function(a,b,c){return Math.min(Math.max(b,a),c)};this.generatePoints();n(this.points,function(d){var l=(a.colsize||1)/2,e=(a.rowsize||1)/2,g=f(Math.round(c.len-
c.translate(d.x-l,0,1,0,1)),-c.len,2*c.len),l=f(Math.round(c.len-c.translate(d.x+l,0,1,0,1)),-c.len,2*c.len),k=f(Math.round(b.translate(d.y-e,0,1,0,1)),-b.len,2*b.len),e=f(Math.round(b.translate(d.y+e,0,1,0,1)),-b.len,2*b.len);d.plotX=d.clientX=(g+l)/2;d.plotY=(k+e)/2;d.shapeType="rect";d.shapeArgs={x:Math.min(g,l),y:Math.min(k,e),width:Math.abs(l-g),height:Math.abs(e-k)}});this.translateColors()},drawPoints:function(){u.column.prototype.drawPoints.call(this);n(this.points,function(a){a.graphic.attr(this.colorAttribs(a,
a.state))},this)},animate:d,getBox:d,drawLegendSymbol:a.LegendSymbolMixin.drawRectangle,alignDataLabel:u.column.prototype.alignDataLabel,getExtremes:function(){t.prototype.getExtremes.call(this,this.valueData);this.valueMin=this.dataMin;this.valueMax=this.dataMax;t.prototype.getExtremes.call(this)}}),m)})(v);(function(a){function m(a,b){var c,d,l,e=!1,g=a.x,k=a.y;a=0;for(c=b.length-1;a<b.length;c=a++)d=b[a][1]>k,l=b[c][1]>k,d!==l&&g<(b[c][0]-b[a][0])*(k-b[a][1])/(b[c][1]-b[a][1])+b[a][0]&&(e=!e);
return e}var n=a.Chart,k=a.each,d=a.extend,g=a.error,t=a.format,v=a.merge,u=a.win,q=a.wrap;n.prototype.transformFromLatLon=function(a,b){if(void 0===u.proj4)return g(21),{x:0,y:null};a=u.proj4(b.crs,[a.lon,a.lat]);var c=b.cosAngle||b.rotation&&Math.cos(b.rotation),d=b.sinAngle||b.rotation&&Math.sin(b.rotation);a=b.rotation?[a[0]*c+a[1]*d,-a[0]*d+a[1]*c]:a;return{x:((a[0]-(b.xoffset||0))*(b.scale||1)+(b.xpan||0))*(b.jsonres||1)+(b.jsonmarginX||0),y:(((b.yoffset||0)-a[1])*(b.scale||1)+(b.ypan||0))*
(b.jsonres||1)-(b.jsonmarginY||0)}};n.prototype.transformToLatLon=function(a,b){if(void 0===u.proj4)g(21);else{a={x:((a.x-(b.jsonmarginX||0))/(b.jsonres||1)-(b.xpan||0))/(b.scale||1)+(b.xoffset||0),y:((-a.y-(b.jsonmarginY||0))/(b.jsonres||1)+(b.ypan||0))/(b.scale||1)+(b.yoffset||0)};var c=b.cosAngle||b.rotation&&Math.cos(b.rotation),d=b.sinAngle||b.rotation&&Math.sin(b.rotation);b=u.proj4(b.crs,"WGS84",b.rotation?{x:a.x*c+a.y*-d,y:a.x*d+a.y*c}:a);return{lat:b.y,lon:b.x}}};n.prototype.fromPointToLatLon=
function(a){var b=this.mapTransforms,c;if(b){for(c in b)if(b.hasOwnProperty(c)&&b[c].hitZone&&m({x:a.x,y:-a.y},b[c].hitZone.coordinates[0]))return this.transformToLatLon(a,b[c]);return this.transformToLatLon(a,b["default"])}g(22)};n.prototype.fromLatLonToPoint=function(a){var b=this.mapTransforms,c,d;if(!b)return g(22),{x:0,y:null};for(c in b)if(b.hasOwnProperty(c)&&b[c].hitZone&&(d=this.transformFromLatLon(a,b[c]),m({x:d.x,y:-d.y},b[c].hitZone.coordinates[0])))return d;return this.transformFromLatLon(a,
b["default"])};a.geojson=function(a,b,f){var c=[],l=[],e=function(a){var b,c=a.length;l.push("M");for(b=0;b<c;b++)1===b&&l.push("L"),l.push(a[b][0],-a[b][1])};b=b||"map";k(a.features,function(a){var f=a.geometry,h=f.type,f=f.coordinates;a=a.properties;var g;l=[];"map"===b||"mapbubble"===b?("Polygon"===h?(k(f,e),l.push("Z")):"MultiPolygon"===h&&(k(f,function(a){k(a,e)}),l.push("Z")),l.length&&(g={path:l})):"mapline"===b?("LineString"===h?e(f):"MultiLineString"===h&&k(f,e),l.length&&(g={path:l})):"mappoint"===
b&&"Point"===h&&(g={x:f[0],y:-f[1]});g&&c.push(d(g,{name:a.name||a.NAME,properties:a}))});f&&a.copyrightShort&&(f.chart.mapCredits=t(f.chart.options.credits.mapText,{geojson:a}),f.chart.mapCreditsFull=t(f.chart.options.credits.mapTextFull,{geojson:a}));return c};q(n.prototype,"addCredits",function(a,b){b=v(!0,this.options.credits,b);this.mapCredits&&(b.href=null);a.call(this,b);this.credits&&this.mapCreditsFull&&this.credits.attr({title:this.mapCreditsFull})})})(v);(function(a){function m(a,c,d,l,
e,g,k,h){return["M",a+e,c,"L",a+d-g,c,"C",a+d-g/2,c,a+d,c+g/2,a+d,c+g,"L",a+d,c+l-k,"C",a+d,c+l-k/2,a+d-k/2,c+l,a+d-k,c+l,"L",a+h,c+l,"C",a+h/2,c+l,a,c+l-h/2,a,c+l-h,"L",a,c+e,"C",a,c+e/2,a+e/2,c,a+e,c,"Z"]}var n=a.Chart,k=a.defaultOptions,d=a.each,g=a.extend,t=a.merge,v=a.pick,u=a.Renderer,q=a.SVGRenderer,c=a.VMLRenderer;g(k.lang,{zoomIn:"Zoom in",zoomOut:"Zoom out"});k.mapNavigation={buttonOptions:{alignTo:"plotBox",align:"left",verticalAlign:"top",x:0,width:18,height:18,padding:5,style:{fontSize:"15px",
fontWeight:"bold"},theme:{"stroke-width":1,"text-align":"center"}},buttons:{zoomIn:{onclick:function(){this.mapZoom(.5)},text:"+",y:0},zoomOut:{onclick:function(){this.mapZoom(2)},text:"-",y:28}},mouseWheelSensitivity:1.1};a.splitPath=function(a){var b;a=a.replace(/([A-Za-z])/g," $1 ");a=a.replace(/^\s*/,"").replace(/\s*$/,"");a=a.split(/[ ,]+/);for(b=0;b<a.length;b++)/[a-zA-Z]/.test(a[b])||(a[b]=parseFloat(a[b]));return a};a.maps={};q.prototype.symbols.topbutton=function(a,c,d,l,e){return m(a-1,
c-1,d,l,e.r,e.r,0,0)};q.prototype.symbols.bottombutton=function(a,c,d,l,e){return m(a-1,c-1,d,l,0,0,e.r,e.r)};u===c&&d(["topbutton","bottombutton"],function(a){c.prototype.symbols[a]=q.prototype.symbols[a]});a.Map=a.mapChart=function(b,c,d){var f="string"===typeof b||b.nodeName,e=arguments[f?1:0],g={endOnTick:!1,visible:!1,minPadding:0,maxPadding:0,startOnTick:!1},k,h=a.getOptions().credits;k=e.series;e.series=null;e=t({chart:{panning:"xy",type:"map"},credits:{mapText:v(h.mapText,' \u00a9 \x3ca href\x3d"{geojson.copyrightUrl}"\x3e{geojson.copyrightShort}\x3c/a\x3e'),
mapTextFull:v(h.mapTextFull,"{geojson.copyright}")},xAxis:g,yAxis:t(g,{reversed:!0})},e,{chart:{inverted:!1,alignTicks:!1}});e.series=k;return f?new n(b,e,d):new n(e,c)}})(v)});
