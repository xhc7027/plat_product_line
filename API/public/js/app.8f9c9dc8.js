(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["app"],{0:function(e,t,a){e.exports=a("2f39")},"034f":function(e,t,a){"use strict";var n=a("fb1c"),o=a.n(n);o.a},"1e5d":function(e,t,a){},"2f39":function(e,t,a){"use strict";a.r(t);a("ac6a"),a("a114"),a("d14b"),a("1e5d"),a("7e6d");var n=a("2b0e"),o=a("5335"),r=a("e84f"),i=a("7051"),s=a("2040"),u=a("cf12"),l=a("46a9"),c=a("32a1"),d=a("f30c"),m=a("ce67"),p=a("482e"),f=a("52b5"),h=a("1180"),g=a("1e55"),v=a("506f"),b=a("b8d9"),_=a("7d43"),y=a("5d8b"),$=a("5931"),k=a("79e9"),w=a("09fa"),T=a("ac83"),D=a("c604"),q=a("0952"),x=a("2a70"),Q=a("3d5b"),I=a("1526"),C=a("133b"),S=a("6780");n["a"].use(r["a"],{config:{},iconSet:o["a"],components:{QLayout:i["a"],QLayoutHeader:s["a"],QLayoutDrawer:u["a"],QPageContainer:l["a"],QPage:c["a"],QToolbar:d["a"],QToolbarTitle:m["a"],QBtn:p["a"],QIcon:f["a"],QList:h["a"],QListHeader:g["a"],QItem:v["a"],QItemMain:b["a"],QItemSide:_["a"],QInput:y["a"],QSelect:$["a"],QField:k["a"],QBtnToggle:w["a"],QCollapsible:T["a"],QTable:D["a"],QModal:q["a"],QModalLayout:x["a"],QDatetime:Q["a"]},directives:{Ripple:I["a"]},plugins:{Notify:C["a"],Dialog:S["a"]}});var P=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{attrs:{id:"q-app"}},[a("router-view")],1)},N=[];P._withStripped=!0;var F={name:"detOS"},E=F,U=(a("034f"),a("2877")),R=Object(U["a"])(E,P,N,!1,null,null,null);R.options.__file="App.vue";var L=R.exports,M=a("8c4f"),O=[{path:"/",component:function(){return a.e("13a870ec").then(a.bind(null,"f241"))},children:[{path:"",component:function(){return a.e("1bdb053e").then(a.bind(null,"8b24"))}},{path:"create",component:function(){return a.e("6183c4e8").then(a.bind(null,"ff9c"))}},{path:"analyze",component:function(){return a.e("51dfd407").then(a.bind(null,"360d"))}},{path:"login",component:function(){return a.e("71a07566").then(a.bind(null,"c6f7"))},meta:{authRequired:!1}}]}];O.push({path:"*",component:function(){return a.e("4b47640d").then(a.bind(null,"e51e"))}});var V=O;n["a"].use(M["a"]);var Y=function(){var e=new M["a"]({scrollBehavior:function(){return{y:0}},routes:V,mode:"hash",base:""});return e.beforeEach(function(e,t,a){console.log("router.beforeEach-------",e.meta.authRequired),!1!==e.meta.authRequired&&null==localStorage.getItem("userid")?a({path:"/login",query:{r:e.fullPath}}):a()}),e},j=function(){var e="function"===typeof Y?Y({}):Y,t={el:"#q-app",router:e,render:function(e){return e(L)}};return{app:t,router:e}},z=a("6488"),H=function(e){e.app;var t=e.router,a=e.Vue;z["a"].on("loginRequired",function(){t.push({path:"/login",query:{r:t.currentRoute.fullPath}})}),a.prototype.$bus=z["a"]},A=(a("f559"),a("cadf"),a("456d"),a("fd10")),W={apis:[{path:"/login",to:"http://api-amc.huishoubao.com.cn/login",method:"post",params:[{name:"system",value:"product-line"},{name:"system_id",value:"51"}],boxing:function(e){return e},unboxing:function(e){return{code:e.body.retcode,data:{token:e.body.data.login_token,userid:e.body.data.user_id}}},fields:[]},{path:"/queryUser",to:"http://api-amc.huishoubao.com.cn/systemusers",method:"post",params:[{name:"login_token",value:"$login_token"},{name:"login_user_id",value:"$login_user_id"},{name:"login_system_id",value:"51"}],boxing:function(e){var t={head:{interface:"systemusers",msgtype:"request",remark:"",version:"1.0.0"},params:{}};return t.params=e,t},unboxing:function(e){return{_errCode:e.body.retcode,_errStr:e.body.retinfo,data:e.body.data}},fields:[]}]},B={apis:[{path:"/bind-det-app",to:"/pushApp/bindCodeInfo",method:"post",params:[{name:"codeInfo",value:"$orderSerial"},{name:"uniqueKey",value:"$resultSerial"},{name:"_interface",value:"det_getProfessionDetect"},{name:"detVersion",value:"$version",default:"v1.0.0"},{name:"sourceDetect",value:"$source"}],fields:[],hooks:{beforeParams:function(e){return e},afterParams:function(e){return e.login_token=localStorage.getItem("token"),e.login_user_id=localStorage.getItem("userid"),e.login_user_name=localStorage.getItem("username"),e},beforeFields:function(e){return e},afterFields:function(e){return e}}}]},K={apis:[{path:"/getAnalyze",to:"/detectInfo/getDetectTimeData",method:"post",params:[{name:"_interface",value:"det_getDetectTimeData"},{name:"beginTime",value:"$startTime"},{name:"endTime",value:"$endTime"},{name:"sourceDetect",value:"$source"},{name:"loginUserId",value:"$loginUserId"},{name:"loginToken",value:"$loginToken"},{name:"userName",value:"$userName"},{name:"keyWord",value:"$keyWord"},{name:"pageIndex",value:"$pageIndex"},{name:"pageSize",value:"$pageSize"}],hooks:{beforeParams:function(e){return e},afterParams:function(e){return e},beforeFields:function(e){return e},afterFields:function(e){return e}},fields:[]},{path:"/getAnalyzeDetail",to:"/detectInfo/getDetectTimeDetails",method:"post",params:[{name:"_interface",value:"det_getDetectTimeDetails"},{name:"uniqueKey",value:"$uniqueKey"},{name:"loginUserId",value:"$loginUserId"},{name:"loginToken",value:"$loginToken"}],hooks:{beforeParams:function(e){return e},afterParams:function(e){return e},beforeFields:function(e){return e},afterFields:function(e){return e}},fields:[]},{path:"/dowData",to:"/detectInfo/exportDetectTimeData",method:"post",params:[{name:"_interface",value:"det_exportDetectTimeData"},{name:"beginTime",value:"$startTime"},{name:"endTime",value:"$endTime"},{name:"loginUserId",value:"$loginUserId"},{name:"loginToken",value:"$loginToken"},{name:"userName",value:"$userName"}],hooks:{beforeParams:function(e){return e},afterParams:function(e){return e},beforeFields:function(e){return e},afterFields:function(e){return e}},fields:[]}]},J=[W,B,K],G={real:{scheme:"//",host:"product-line.huishoubao.com.cn",base:""},mock:{scheme:"//",host:"api.huishoubao.com"},boxing:function(e){var t={_head:{_interface:"det_getProfessionDetect",_msgType:"request",_remark:"",_timestamps:"",_version:"1.0.0"},_param:{}};return Object.keys(e).forEach(function(a){a.startsWith("_")&&(t._head[a]=e[a],delete e[a])}),t._param=e,t},unboxing:function(e){var t=e._data;return t},hooks:{authExpired:function(){}}};A["a"].setup({config:G,mappings:J});var X=function(e){e.app,e.router;var t=e.Vue;A["a"].hook("authExpired",function(){t.prototype.$bus.emit("loginRequired")}),t.prototype.$http=A["a"]},Z=a("f490"),ee=function(e){e.app,e.router;var t=e.Vue;t.filter("yearsSince",function(e){var t=new Date(e);if(t instanceof Date){var a=new Date,n=a.getUTCFullYear()-t.getUTCFullYear();return isNaN(n)?"(未知)":0===n?"1 年":n+" 年"}return"(未知)"}),t.filter("formatTime",function(e){var t=e-0;return isNaN(t)?"暂无跟进时间":Z["d"].formatDate(t,"YYYY年MM月DD日 HH:mm")}),t.filter("money",function(e){var t=e-0;return isNaN(t)?"value":"￥"+t/100})},te=a("6e00"),ae=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("q-modal",{ref:"container",staticClass:"modal-module",attrs:{"content-css":{minWidth:e.options.width,minHeight:e.options.height},"no-backdrop-dismiss":"","no-esc-dismiss":""}},[a("q-modal-layout",{staticClass:"modal-module-layout"},[e.options._header?a("q-toolbar",{staticClass:"popup-header sls-modals-header",attrs:{slot:"header"},slot:"header"},[a("q-toolbar-title",[e._v(e._s(e.title))]),a("q-btn",{attrs:{flat:""},on:{click:e.close}},[a("i",{staticClass:"iconfont icon-close"})])],1):e._e(),a("div",{class:[e.options._padding?"layout-padding":"","full-height"]},[a(e.contentComponent,{tag:"component",model:{value:e.options,callback:function(t){e.options=t},expression:"options"}})],1)],1)],1)},ne=[];ae._withStripped=!0;a("f751");var oe=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"login-module"},[a("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],attrs:{name:"username",placeholder:"用户名",error:e.errors.has("username")},model:{value:e.username,callback:function(t){e.username=t},expression:"username"}},[a("validate-error",{attrs:{message:"请输入用户名"}})],1),a("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],attrs:{name:"password",type:"password",placeholder:"密码",error:e.errors.has("password")},model:{value:e.password,callback:function(t){e.password=t},expression:"password"}},[a("validate-error",{attrs:{message:"请输入密码"}})],1),a("p",[e._v(" ")]),a("q-btn",{staticClass:"login-btn",attrs:{color:"secondary"},on:{click:e.login}},[e._v("登录")])],1)},re=[];oe._withStripped=!0;var ie={name:"login-module",data:function(){return{username:"",password:"",system_id:"51"}},methods:{login:function(){console.log("s")}}},se=ie,ue=(a("ea3a"),Object(U["a"])(se,oe,re,!1,null,null,null));ue.options.__file="login.vue";var le=ue.exports,ce={login:{title:"登录",module:le}},de={name:"modallog",data:function(){return{contentComponent:null,title:"Modal",options:{},config:{header:!0,padding:!0,width:"400px",height:""}}},mounted:function(){},methods:{close:function(){var e=this;this.$refs.container.hide(),this.$bus.$emit("loaded"),setTimeout(function(){e.$bus.$emit("resetData")},500)},make:function(e,t){var a=this.$refs.container,n=ce[e];n?(this.title=n.title,this.contentComponent=n.module):this.contentComponent=this.load(e),this.options=Object.assign(this.config,t),a.show()},hide:function(){this.$refs.container.hide(),this.contentComponent=null}}},me=de,pe=(a("aae3d"),Object(U["a"])(me,ae,ne,!1,null,null,null));pe.options.__file="modal.vue";var fe=pe.exports,he=function(e){e.app,e.router;var t=e.Vue,a=t.extend(fe),n=new a,o=document.createElement("div");document.body.appendChild(o),n.$mount(o),console.log("notify-------index=====",n);var r={providers:{modal:n,notice:{make:function(e){var t=e.message;C["a"].create({message:t,timeout:2500,color:"secondary",textColor:"white",icon:"info",position:"top-right"})}},dialog:{make:function(e){var t=e.message;e.options;return console.log("dialog----------",S["a"]),S["a"].create({title:"提示",message:t,ok:"确定",preventClose:!0,cancel:"取消"})}}}};r.$bus=t.prototype.$bus,te["a"].setup(r),t.mixin(te["a"])},ge=a("ac81"),ve=ge["a"],be=j(),_e=be.app,ye=be.router;[H,X,ee,he,ve].forEach(function(e){e({app:_e,router:ye,Vue:n["a"],ssrContext:null})}),new n["a"](_e)},"7e6d":function(e,t,a){},"8bb0":function(e,t,a){},a7e5:function(e,t,a){},aae3d:function(e,t,a){"use strict";var n=a("8bb0"),o=a.n(n);o.a},ea3a:function(e,t,a){"use strict";var n=a("a7e5"),o=a.n(n);o.a},fb1c:function(e,t,a){}},[[0,"runtime","vendor"]]]);