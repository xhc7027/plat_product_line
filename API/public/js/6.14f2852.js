(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[6],{kuvp:function(e,a,r){"use strict";var s=r("nS3d"),t=r.n(s);t.a},nS3d:function(e,a,r){},"xvc/":function(e,a,r){"use strict";r.r(a);var s=function(){var e=this,a=e.$createElement,r=e._self._c||a;return r("div",{staticClass:"login-page page"},[r("h1",[e._v("登录")]),r("p",[e._v(" ")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],attrs:{name:"username",placeholder:"用户名",error:e.errors.has("username")},model:{value:e.username,callback:function(a){e.username=a},expression:"username"}},[r("validate-error",{attrs:{message:"请输入用户名"}})],1),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],attrs:{name:"password",type:"password",placeholder:"密码",error:e.errors.has("password")},model:{value:e.password,callback:function(a){e.password=a},expression:"password"}},[r("validate-error",{attrs:{message:"请输入密码"}})],1),r("p",[e._v(" ")]),r("q-btn",{staticClass:"login-btn",attrs:{color:"secondary"},on:{click:e.login}},[e._v("登录")])],1)},t=[];s._withStripped=!0;var n={name:"login-page",data:function(){return{username:"",password:"",system_id:"114"}},methods:{login:function(){var e=this;this.$validator.validateAll().then(function(a){a?e.$http.post("/login",{data:{username:e.username,password:e.password,system_id:e.system_id}}).then(function(a){var r=a.data;localStorage.setItem("userid",r.userid),localStorage.setItem("username",e.username),localStorage.setItem("token",r.token),e.$router.push(e.$route.query.r||"/create")}):e.notice("请填写用户名密码")})}}},o=n,i=(r("kuvp"),r("KHd+")),l=Object(i["a"])(o,s,t,!1,null,null,null);a["default"]=l.exports}}]);