(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[0],{0:function(e,t,n){e.exports=n("LzkT")},9:function(e,t){},"A0++":function(e,t,n){"use strict";var a=n("TOJS"),o=n.n(a);o.a},Bpx5:function(e,t,n){"use strict";var a=n("DVOl"),o=n.n(a);o.a},DVOl:function(e,t,n){},Hl11:function(e,t,n){},LzkT:function(e,t,n){"use strict";n.r(t);n("rGqo"),n("SpHO"),n("oRQL"),n("0UuB"),n("33V3"),n("Hl11"),n("fm0S");var a=n("Kw5r"),o=n("Pi8J"),i=n("6E/o"),s=n("cFFF"),r=n("IEC1"),u=n("zxLP"),l=n("Rqni"),c=n("MqH6"),d=n("8wy3"),m=n("zmdN"),p=n("SC7v"),f=n("UrUt"),h=n("EYBb"),v=n("HlXa"),g=n("UG+o"),b=n("uNnR"),_=n("fUOT"),k=n("XYut"),q=n("WTFv"),y=n("eelU"),w=n("Cfpk"),I=n("rINx"),S=n("xgT5"),$=n("CVJq"),D=n("KnAT"),x=n("FSbK"),Q=n("Ezub"),C=n("Z4Cl");a["a"].use(i["a"],{config:{},iconSet:o["a"],components:{QLayout:s["a"],QLayoutHeader:r["a"],QLayoutDrawer:u["a"],QPageContainer:l["a"],QPage:c["a"],QToolbar:d["a"],QToolbarTitle:m["a"],QBtn:p["a"],QIcon:f["a"],QList:h["a"],QListHeader:v["a"],QItem:g["a"],QItemMain:b["a"],QItemSide:_["a"],QInput:k["a"],QSelect:q["a"],QField:y["a"],QBtnToggle:w["a"],QCollapsible:I["a"],QTable:S["a"],QModal:$["a"],QModalLayout:D["a"]},directives:{Ripple:x["a"]},plugins:{Notify:Q["a"],Dialog:C["a"]}});var L=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"q-app"}},[n("router-view")],1)},N=[];L._withStripped=!0;var T={name:"App"},V=T,E=(n("A0++"),n("KHd+")),P=Object(E["a"])(V,L,N,!1,null,null,null),F=P.exports,A=n("L2JU"),O={},H=n("pwlE"),R=n("jW8M"),M=n("V4F6"),U={namespaced:!0,state:O,getters:H,mutations:R,actions:M};a["a"].use(A["a"]);var B=function(){var e=new A["a"].Store({modules:{example:U}});return e},K=n("jE9Z"),Y=[{path:"/",component:function(){return n.e(1).then(n.bind(null,"ez0Y"))},children:[{path:"",component:function(){return n.e(2).then(n.bind(null,"7qb8"))}},{path:"create",component:function(){return n.e(3).then(n.bind(null,"/5yV"))}},{path:"search",component:function(){return n.e(4).then(n.bind(null,"26Rk"))}},{path:"scheduler",component:function(){return n.e(5).then(n.bind(null,"Q4eH"))}},{path:"login",component:function(){return n.e(6).then(n.bind(null,"xvc/"))},meta:{authRequired:!1}}]}];Y.push({path:"*",component:function(){return n.e(7).then(n.bind(null,"7l0S"))}});var J=Y;a["a"].use(K["a"]);var j=function(){var e=new K["a"]({scrollBehavior:function(){return{y:0}},routes:J,mode:"hash",base:""});return e.beforeEach(function(e,t,n){!1===e.meta.authRequired||localStorage.getItem("userid")?n():n({path:"/login",query:{r:e.fullPath}})}),e},z=function(){var e="function"===typeof B?B():B,t="function"===typeof j?j({store:e}):j;e.$router=t;var n={el:"#q-app",router:t,store:e,render:function(e){return e(F)}};return{app:n,store:e,router:t}},W=n("ZIg9"),X=function(e){e.app;var t=e.router,n=e.Vue;W["a"].on("loginRequired",function(){t.push({path:"/login",query:{r:t.currentRoute.fullPath}})}),n.prototype.$bus=W["a"]},G=(n("9VmF"),n("yt8O"),n("RW0V"),n("/RDw")),Z={apis:[{path:"/login",to:"http://api-amc.huishoubao.com.cn/login",method:"post",params:[{name:"system",value:"product-line"},{name:"system_id",value:"114"}],boxing:function(e){return e},unboxing:function(e){return{code:e.body.retcode,data:{token:e.body.data.login_token,userid:e.body.data.user_id}}},fields:[]}]},ee=(n("f3/d"),{apis:[{path:"/bind-oms",to:"/bindDetectBarCode",method:"post",params:[{name:"codeInfo",value:"$orderSerial"},{name:"sourceDetect",value:"$source"},{name:"uniqueKey",value:"$resultSerial"},{name:"_interface",value:"det_getProfessionDetect"},{name:"detVersion",value:"$version",default:"v1.0.0"}],fields:[{name:"skuItems",from:"skuList"},{name:"extraItems",from:"checkList"}],hooks:{beforeParams:function(e){return e},afterParams:function(e){return e},beforeFields:function(e){return e},afterFields:function(e){var t={sections:[{id:"1",name:"section-1",label:"SKU选项",questions:e.skuItems?e.skuItems.map(function(e){return{id:e.questionId,name:"field-"+e.questionId,label:e.questionName,finished:e.isSelect||!1,options:e.answerList.map(function(e){return{value:e.answerId,label:e.answerName,selected:e.select||!1}})}}):[]},{id:"2",name:"section-2",label:"手动选项",questions:e.extraItems?e.extraItems.map(function(e){return{id:e.questionId,name:"field-"+e.questionId,label:e.questionName,finished:e.isSelect||!1,options:e.answerList.map(function(e){return{value:e.answerId,label:e.answerName,selected:e.select||!1}})}}):[]}]};return t}}},{path:"/bind-xy",to:"/bindXyDetectBarCode",method:"post",params:[{name:"codeInfo",value:"$orderSerial"},{name:"uniqueKey",value:"$resultSerial"},{name:"_interface",value:"det_getProfessionDetect"},{name:"detVersion",value:"$version",default:"v1.0.0"},{name:"sourceDetect",value:"$source"}],fields:[{name:"sections",from:"checkList"}],hooks:{beforeParams:function(e){return e},afterParams:function(e){return e.login_token=localStorage.getItem("token"),e.login_user_id=localStorage.getItem("userid"),e.login_user_name=localStorage.getItem("username"),e},beforeFields:function(e){return e},afterFields:function(e){var t=e.sections&&"Array"===e.sections.constructor.name?e.sections:[],n={sections:t.map(function(e){return{id:e.id,name:"section-"+e.id,label:e.name,isAdd:e.isAdd,isAddOption:e.isAddOption,isEditor:e.isEditor,questions:e.childs.map(function(e){return{id:e.id,name:"filed-"+e.id,label:e.name,multiple:e.isMultiple,isDet:e.isDet,finished:e.isSelect,options:e.childs.map(function(e){return{label:e.name,isDefective:e.isDefective,selected:e.isSelect,value:e.id}})}})}})};return console.log("log-----",n),n}}}]}),te={apis:[{path:"/save-oms",to:"/getQuotation",method:"post",params:[{name:"uniqueKey",value:"$resultSerial"},{name:"sections",value:"$sections"},{name:"sourceDetect",value:"$source"},{name:"detVersion",value:"$version",default:"v1.0.0"},{name:"_interface",value:"det_getQuotation"}],fields:[{name:"price",from:"quotation"}],hooks:{afterParams:function(e){var t=e.sections[0].questions,n=e.sections[1].questions,a={};return a.skuList=t.map(function(e){return{questionName:e.label,questionId:e.id,select:e.selected,answerList:e.options.map(function(e){return{answerId:e.value,answerName:e.label,select:e.selected||!1}})}}),a.checkList=n.map(function(e){return{questionName:e.label,questionId:e.id,select:e.selected,answerList:e.options.map(function(e){return{answerId:e.value,answerName:e.label,select:e.selected||!1}})}}),a}}},{path:"/save-xy",to:"/pullAppDetectToXyDetect",method:"post",params:[{name:"uniqueKey",value:"$resultSerial"},{name:"checkList",value:"$sections"},{name:"sourceDetect",value:"$source"},{name:"orderNum",value:"$orderNumber"},{name:"detectinfoId",value:"$taskNumber"},{name:"detVersion",value:"$version",default:"v1.0.0"},{name:"_interface",value:"det_getQuotation"}],fields:[{name:"price",from:"quotation"}],hooks:{afterParams:function(e){return console.log("afterParams------------------",e),e.login_token=localStorage.getItem("token"),e.login_user_id=localStorage.getItem("userid"),e.login_user_name=localStorage.getItem("username"),e.checkList=e.checkList.map(function(e){return{id:e.id,name:e.label,isAdd:e.isAdd,isAddOption:e.isAddOption,isEditor:e.isEditor,childs:e.questions.map(function(e){return{id:e.id,name:e.label,isMultiple:e.multiple,isDet:e.isDet,isSelect:e.finished,childs:e.options.map(function(e){return{id:e.value,name:e.label,isDefective:e.isDefective,isSelect:e.selected}})}})}}),e}}}]},ne=[Z,ee,te],ae={real:{scheme:"//",host:"product-line.huishoubao.com.cn",base:"/pushApp"},mock:{scheme:"//",host:"api.huishoubao.com"},boxing:function(e){var t={_head:{_interface:"det_getProfessionDetect",_msgType:"request",_remark:"",_timestamps:"",_version:"1.0.0"},_param:{}};return Object.keys(e).forEach(function(n){n.startsWith("_")&&(t._head[n]=e[n],delete e[n])}),t._param=e,t},unboxing:function(e){var t={code:e._data._retcode,message:e._data._retinfo,data:e._data._data};return t},hooks:{authExpired:function(){}}};G["a"].setup({config:ae,mappings:ne});var oe=function(e){e.app,e.router;var t=e.Vue;G["a"].hook("authExpired",function(){t.prototype.$bus.emit("loginRequired")}),t.prototype.$http=G["a"]},ie=n("9JDm"),se=function(e){e.app,e.router;var t=e.Vue;t.filter("yearsSince",function(e){var t=new Date(e);if(t instanceof Date){var n=new Date,a=n.getUTCFullYear()-t.getUTCFullYear();return isNaN(a)?"(未知)":0===a?"1 年":a+" 年"}return"(未知)"}),t.filter("formatTime",function(e){var t=e-0;return isNaN(t)?"暂无跟进时间":ie["a"].formatDate(t,"YYYY年MM月DD日 HH:mm")}),t.filter("money",function(e){var t=e-0;return isNaN(t)?"value":"￥"+t/100})},re=n("bgBf"),ue=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("q-modal",{ref:"container",staticClass:"modal-module",attrs:{"content-css":{minWidth:e.options.width,minHeight:e.options.height},"no-backdrop-dismiss":"","no-esc-dismiss":""}},[n("q-modal-layout",{staticClass:"modal-module-layout"},[e.options._header?n("q-toolbar",{staticClass:"popup-header sls-modals-header",attrs:{slot:"header"},slot:"header"},[n("q-toolbar-title",[e._v(e._s(e.title))]),n("q-btn",{attrs:{flat:""},on:{click:e.close}},[n("i",{staticClass:"iconfont icon-close"})])],1):e._e(),n("div",{class:[e.options._padding?"layout-padding":"","full-height"]},[n(e.contentComponent,{tag:"component",model:{value:e.options,callback:function(t){e.options=t},expression:"options"}})],1)],1)],1)},le=[];ue._withStripped=!0;n("91GP");var ce={},de={name:"modal",data:function(){return{contentComponent:null,title:"Modal",options:{},config:{header:!0,padding:!0,width:"80vm",height:"80vh"}}},mounted:function(){},methods:{close:function(){var e=this;this.$refs.container.hide(),this.$bus.$emit("loaded"),setTimeout(function(){e.$bus.$emit("resetData")},500)},make:function(e,t){var n=this.$refs.container,a=ce[e];a?(this.title=a.title,this.contentComponent=a.module):this.contentComponent=this.load(e),this.options=Object.assign(this.config,t),n.show()},hide:function(){this.$refs.container.hide(),this.contentComponent=null}}},me=de,pe=(n("Bpx5"),Object(E["a"])(me,ue,le,!1,null,"4e0a2710",null)),fe=pe.exports,he=function(e){e.app,e.router;var t=e.Vue,n=t.extend(fe),a=new n;console.log("notify-------index=====",a),a.$mount();var o={providers:{modal:a,notice:{make:function(e){var t=e.message;Q["a"].create({message:t,timeout:2500,color:"secondary",textColor:"white",icon:"info",position:"top-right"})}},dialog:{make:function(e){var t=e.message;e.options;return console.log("dialog----------",C["a"]),C["a"].create({title:"提示",message:t,ok:"确定",preventClose:!0,cancel:"取消"})}}}};o.$bus=t.prototype.$bus,re["a"].setup(o),t.mixin(re["a"])},ve=n("rIFp"),ge=ve["a"],be=n("nDUW"),_e={server:"https://sched.breezemakes.com",services:["/users","/messages","/tasks","/commands"]},ke=be["a"].make(_e),qe=function(e){e.app,e.router;var t=e.Vue;t.prototype.$feathers=ke},ye=z(),we=ye.app,Ie=ye.store,Se=ye.router;[X,oe,se,he,ge,qe].forEach(function(e){e({app:we,router:Se,store:Ie,Vue:a["a"],ssrContext:null})}),new a["a"](we)},TOJS:function(e,t,n){},V4F6:function(e,t){},fm0S:function(e,t,n){},jW8M:function(e,t){},pwlE:function(e,t){}},[[0,9,8]]]);