(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["6183c4e8"],{"466c":function(e,r,a){},ceb8:function(e,r,a){"use strict";var t=a("466c"),o=a.n(t);o.a},ff9c:function(e,r,a){"use strict";a.r(r);var t=function(){var e=this,r=e.$createElement,a=e._self._c||r;return a("q-page",{staticClass:"create-page page flex"},[a("div",{staticClass:"container full-width"},[a("form",{attrs:{action:"/","data-vv-scope":"bind"}},[a("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],ref:"orderSerialInput",attrs:{name:"orderSerialInput",clearable:"",autofocus:"",before:[{icon:"fas fa-barcode",handler:function(){}}],"float-label":"机身条码",placeholder:"输入","auto-complete":"off",spellcheck:"false",error:e.errors.has("orderSerialInput","bind")},on:{keyup:function(r){return"button"in r||13===r.keyCode?e.save1(r):null}},model:{value:e.orderSerial,callback:function(r){e.orderSerial=r},expression:"orderSerial"}},[a("validate-error",{attrs:{message:"请输入机身条码"}})],1),a("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],ref:"detIDInput",attrs:{name:"detIDInput",clearable:"",before:[{icon:"fas fa-barcode",handler:function(){}}],"float-label":"APP检测结果条码",placeholder:"输入",spellcheck:"false",error:e.errors.has("detIDInput","bind")},on:{keyup:function(r){return"button"in r||13===r.keyCode?e.save1(r):null}},model:{value:e.resultSerial,callback:function(r){e.resultSerial=r},expression:"resultSerial"}},[a("validate-error",{attrs:{message:"请输入屏幕条码"}})],1),a("q-btn",{staticClass:"save-btn save1-btn",attrs:{color:"secondary",width:"200",size:"md",label:"提交"},on:{click:function(r){e.save1()}}})],1)]),a("p",[e._v(" ")]),a("p",[e._v(" ")])])},o=[];t._withStripped=!0;var n={name:"create-page",data:function(){return{stage:1,orderSerial:"",resultSerial:"",source:"xy",orderNumber:"",taskNumber:"",sections:[],results:{},memo:"",priceResult:0}},mounted:function(){this.$refs.orderSerialInput.focus()},computed:{extraSections:function(){return this.sections.filter(function(e){return e.questions.some(function(e){return!e.finished})})}},methods:{save1:function(){var e=this;console.log("s");var r={oms:"/bind-oms",xy:"/bind-det-app"};this.$validator.validateAll("bind").then(function(a){if(a){var t={orderSerial:e.orderSerial,resultSerial:e.resultSerial,source:e.source},o=e;e.$http.post(r[e.source],{data:t}).then(function(r){switch(r._errCode){case"0":e.notice("绑定成功，请在APP上完成手机检测"),o.orderSerial="",o.resultSerial="",o.$refs.orderSerialInput.focus();break;case"100004":case"100001":e.orderSerial="",e.$refs.orderSerialInput.focus(),e.notice("条码错误");break;case"100003":e.resultSerial="",e.$refs.detIDInput.focus(),e.notice("app条码错误");break;case"100005":e.orderSerial="",e.resultSerial="",e.$refs.orderSerialInput.focus(),e.notice("条码已经检测过");break;default:e.notice(r._errStr)}}).catch(function(e){console.log("bind app",e)})}else e.$refs[e.$validator.errors.items[0].field].focus()})}}},i=n,s=(a("ceb8"),a("2877")),l=Object(s["a"])(i,t,o,!1,null,null,null);l.options.__file="create.vue";r["default"]=l.exports}}]);