define(assets_path+"/assets/dist/order/init",["$","dist/application/app"],function(a){"use strict";var b=a("$"),c=a("dist/application/app"),d=c.config,e=c.method;b(document).on("click",'[data-toggle="download"]',function(){var a=b(this),c=a.closest("form"),f=a.data("set"),g=a.data("type")||"get",h=a.data("action"),i=b("#reportrange").val();if(i){i=i.split("-");var j=new Date(i[0].replace("-","/").replace("-","/")),k=new Date(i[1].replace("-","/").replace("-","/")),l=(k-j)/864e5;if(c.length&&31>l){var m=c.serializeArray();m.push({name:"set",value:f}),e.OpenWindowWithPost(h||c.attr("action"),"_blank",m,g)}else d.msg.error("每次最多只能导出31天内的订单数据")}else d.msg.error("请选择日期每次最多只能导出31天内的订单数据")}),b(document).on("click",".js_multy_dispatch",function(){var a=b(this),c=a.data("action"),d=a.data("type")||"post",f=a.data("set"),g=[];g.push({name:"ids",value:f.ids}),e.OpenWindowWithPost(c,"_blank",g,d)})});