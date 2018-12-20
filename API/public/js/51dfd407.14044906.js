(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["51dfd407"],{"360d":function(e,t,a){"use strict";a.r(t);var i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("q-page",{staticClass:"search-page page flex"},[a("div",{staticClass:"container full-width"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-2"},[a("q-datetime",{attrs:{type:"date",placeholder:"开始时间"},model:{value:e.filters.startTime,callback:function(t){e.$set(e.filters,"startTime",t)},expression:"filters.startTime"}})],1),a("div",{staticClass:"col-2"},[a("q-datetime",{attrs:{type:"date",placeholder:"结束时间"},model:{value:e.filters.endTime,callback:function(t){e.$set(e.filters,"endTime",t)},expression:"filters.endTime"}})],1),a("div",{staticClass:"col-2"},[a("q-select",{staticClass:"clients-select",attrs:{options:e.sources},model:{value:e.filters.source,callback:function(t){e.$set(e.filters,"source",t)},expression:"filters.source"}})],1),a("div",{staticClass:"col-2"},[a("q-select",{staticClass:"clients-select",attrs:{placeholder:"检测员",filter:!0,options:e.userList},model:{value:e.filters.userName,callback:function(t){e.$set(e.filters,"userName",t)},expression:"filters.userName"}})],1),a("div",{staticClass:"col-2"},[a("q-input",{attrs:{placeholder:"机身条码"},model:{value:e.filters.keyWord,callback:function(t){e.$set(e.filters,"keyWord",t)},expression:"filters.keyWord"}})],1),a("div",{staticClass:"col-2",staticStyle:{"text-align":"center"}},[a("q-btn",{attrs:{label:"查询",size:"md",color:"primary"},on:{click:function(t){e.getData()}}})],1)]),a("p",[e._v(" ")]),a("q-table",{attrs:{title:"检测时效分析",data:e.tableData,columns:e.columns,pagination:e.serverPagination,loading:e.loading,filter:e.filters,"row-key":"name"},on:{"update:pagination":function(t){e.serverPagination=t},request:e.queryData},scopedSlots:e._u([{key:"body-cell-detail",fn:function(t){return a("td",{},[a("q-btn",{attrs:{color:"info",label:"详情"},on:{click:function(a){e.showDetail(t)}}})],1)}},{key:"top-right",fn:function(t){return[a("q-btn",{attrs:{color:"primary",flat:!0,rounded:"",size:"sm",label:"统计检测员平均时效"},on:{click:function(t){e.dowData()}}})]}}])})],1),a("q-modal",{attrs:{"content-css":"padding: 20px"},model:{value:e.opened,callback:function(t){e.opened=t},expression:"opened"}},[a("q-table",{attrs:{title:"检测时效详情",data:e.detailData.nodeList,columns:e.detailColumns,"hide-bottom":"","row-key":"name"},scopedSlots:e._u([{key:"top-left",fn:function(t){return[a("strong",[e._v("检测员: "+e._s(e.detailData.userName)+"，总时效："+e._s(e.detailData.nodeTimeCount)+"s")])]}},{key:"body-cell-stime",fn:function(t){return a("td",{},[e._v("\n        "+e._s(e.fmDate(t.row.stime))+"\n      ")])}},{key:"body-cell-etime",fn:function(t){return a("td",{},[e._v("\n        "+e._s(e.fmDate(t.row.etime))+"\n      ")])}}])}),a("q-btn",{attrs:{color:"primary",label:"Close"},on:{click:function(t){e.opened=!1}}})],1)],1)},n=[];i._withStripped=!0;a("f751");var l=a("f490"),s={name:"analyze-page",data:function(){return{opened:!1,filters:{startTime:"",endTime:"",source:"xy",orderSerial:"",userName:"",keyWord:""},serverPagination:{page:1,rowsNumber:0},sources:[{label:"闲鱼验机",value:"xy"}],tableData:[{}],columns:[{name:"codeInfo",label:"机身条码",field:"codeInfo"},{name:"uniqueKey",label:"检测条码",field:"uniqueKey"},{name:"sourceDetect",label:"业务方",field:"sourceDetect"},{name:"userName",label:"检测人员",field:"userName"},{name:"detectStartTime",label:"检测开始时间",field:"detectStartTime"},{name:"detectEndTime",label:"检测结束时间",field:"detectEndTime"},{name:"totalTime",label:"总时效（S）",field:"totalTime"},{name:"detail",label:"详情",field:"detail"}],detailData:{nodeList:[],userName:"",nodeTimeCount:0},detailColumns:[{name:"node",label:"检测大项",field:"node"},{name:"stime",label:"检测开始时间",field:"stime"},{name:"etime",label:"检测结束时间",field:"etime"},{name:"optionTime",label:"总时效（S）",field:"optionTime"}],userList:[],loading:!1}},mounted:function(){var e=new Date,t=l["d"].addToDate(e,{days:-15});this.filters.startTime=l["d"].formatDate(t,"YYYY-MM-DD"),this.filters.endTime=l["d"].formatDate(e,"YYYY-MM-DD"),this.getUserlist(),this.queryData({pagination:this.serverPagination,filter:this.filters})},methods:{getData:function(){this.serverPagination.page=1,this.queryData({pagination:this.serverPagination,filter:this.filters})},queryData:function(e){var t=this,a=e.pagination,i=e.filter,n=Object.assign({},i);n.pageIndex=a.page,n.pageSize=a.rowsPerPage||100,this.loading=!0,this.$http.post("/getAnalyze",{data:n}).then(function(e){"0"===e._errCode&&(t.tableData=e.list,t.serverPagination=a,t.serverPagination.rowsNumber=+e.tatalCount),t.loading=!1}).catch(function(e){console.log("query data",e)})},showDetail:function(e){var t=this,a={uniqueKey:e.row.uniqueKey};this.$http.post("/getAnalyzeDetail",{data:a}).then(function(e){"0"===e._errCode&&(t.detailData.nodeList=e.detectTimeData,t.detailData.nodeTimeCount=e.tatalTime,t.detailData.userName=e.userName,t.opened=!0)}).catch(function(e){console.log("query info",e)})},fmDate:function(e){return l["d"].formatDate(new Date(1e3*+e),"YYYY-MM-DD hh:mm:ss")},dowData:function(){var e="http://product-line.huishoubao.com.cn/detectInfo/exportDetectTimeData";e+="?beginTime="+this.filters.startTime,e+="&endTime="+this.filters.endTime,window.open(e)},getUserlist:function(){var e=this;this.$http.post("/queryUser",{data:{login_token:localStorage.getItem("token"),login_user_id:localStorage.getItem("userid")}}).then(function(t){if("0"===t._errCode){var a=t.data.map(function(e){return{label:e.real_name,value:e.username}});a.unshift({label:"所有检测员",value:""}),e.userList=a}else e.notice("获取用户失败")}).catch(function(e){console.log("query user",e)})}}},o=s,r=(a("a19c"),a("2877")),c=Object(r["a"])(o,i,n,!1,null,null,null);c.options.__file="analyze.vue";t["default"]=c.exports},a19c:function(e,t,a){"use strict";var i=a("db45"),n=a.n(i);n.a},db45:function(e,t,a){}}]);