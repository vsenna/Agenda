$(document).ready(function(){
	jQuery("#agenda").jqGrid({
	   	url:'list',
	   	editurl:'crud',
		datatype: "json",
	   	colNames:['Birth date', 'Name', 'Phone','Cellphone'],
	   	colModel:[
	  	   	{name:'birth_date',index:'invdate', editable:true,width:200,editoptions:{size:20, 
                dataInit:function(el){ 
                	$(el).datepicker({
                		dateFormat:'yy-mm-dd',
                		 changeMonth: true,
                		 changeYear: true
                	}); 
                }}
	  	   	},
	   		{name:'name',index:'name asc, invdate',editable:true, editrules:{required:true},width:180},
	   		{name:'phone',index:'phone', editable:true,width:150, align:"right"},
	   		{name:'cellphone',index:'cellphone', editable:true,width:150, align:"right"}	
	   	],
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: '#agenda-pager',
	   	sortname: 'name',
	    viewrecords: true,
	    rownumbers: true,
	    gridview: true,
	    height: "auto",
	    sortorder: "asc",
	    caption:"My Contacts"
	}).navGrid("#agenda-pager",{edit:true,add:true,del:true,width:200});
});