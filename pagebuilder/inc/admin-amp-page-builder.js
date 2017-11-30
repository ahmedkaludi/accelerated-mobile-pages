Vue.component('amp-pagebuilder-modal', {
  template: '#amp-pagebuilder-modal-template',
  props: ['dataContent'],
   methods:{
  	hidePageBuilderPopUp: function(event){
			app.showModal = false;
		},
  }
})
Vue.component('amp-pagebuilder-module-modal', {
  template: '#amp-pagebuilder-module-modal-template',
  props: [],
  data: function(){
  	return {
	  	modalcontent: app.modalcontent
	  };
  },
  methods:{
  	hideModulePopUp: function(event){
			app.showmoduleModal = false;
		},
	showtabs: function(key){
		this.modalcontent.default_tab=key;
	}
  }
})

//module is working
Vue.component('module-data',{
	template: '#module-data-template',
	props: ['cell','cellcontainer','modulekey'],
	data:function(){
		return {
			showModuleModal: false,
		};
	},
	methods:{
		showModulePopUp: function(event){
			openModulePopup(event);
		},
	}
})
function openModulePopup(event){
	popupContent = event.currentTarget.getAttribute('data-popupContent'); 
	app.modalcontent = JSON.parse(popupContent);
	app.showmoduleModal = true;
	alert(app.showmoduleModal);
}
Vue.component('fields-data',{
	template: '#fields-data-template',
	props: ['field','defaulttab'],
	data:function(){
		return {};
	},
	methods:{}	
})
var app = new Vue({
  el: '#ampForWpPageBuilder_container',
  data: {
    message: 'Hello AMP Page builder वासियों',
    showModal: false,
    showmoduleModal: false,
    modalcontent: [],
    moduledrag: false,
    pagebuilderContent: ' <p class="dummy amppb-rows-message">Welcome to AMP Page Builder.</p>',
    mainContent: {},
    mainContent_Save: JSON.stringify(this.mainContent),
  },
  methods: {
  		//module sort
  		modulesort:function(evt,originalEvent){
  			/*console.log("Module relatedContext");
  			console.log(evt.relatedContext.index,
  						evt.relatedContext.element,
  						evt.relatedContext.list,
  						evt.relatedContext.component,
  						);*/
  			/*console.log("Module draggedContext");
  			console.log(evt.draggedContext.index,
  						evt.draggedContext.element,
  						evt.draggedContext.futureIndex,
  						);*/
  			if(evt.draggedContext && evt.type=='move'){
  				//Information where element has dropped
  				var rowId = evt.to.getAttribute('data-rowid');
				var colid = evt.to.getAttribute('data-cellid');
				//console.log(colid,rowId)
  				//Element which we have moves
  				moveElemnt = evt.draggedContext.element;
  				moveElemntFutureIndex = evt.draggedContext.futureIndex;
  				moveElemnt.index = moveElemntFutureIndex+1;
  				moveElemnt.cell_container = colid;
  				moveElemnt.rowId = rowId;

  				var CopyData = this.mainContent.rows.slice();
  				
  				var removeKey = null;
  				this.mainContent.rows.forEach(function(data,key){
  					
					data.cell_data.forEach(function(module,modKey){
						if(module.cell_id==moveElemnt.cell_id){
							//Remove module from previous index
							Vue.delete( data.cell_data, modKey )
							return false;
						}
					});
				});
				var newRowID = null;
				this.mainContent.rows.forEach(function(data,key){
					if(data.id==rowId){
						Vue.set(data.cell_data, data.cell_data.length, moveElemnt);	
						return false;
					}
					
				});
				//this.mainContent.rows = CopyData;
				this.call_default_functions();
				//console.log(this.mainContent);
  			}
  			return false;
  		},
  		//row Sorting
  		rows_moved: function(evt, originalEvent){
  			if(evt.draggedContext && evt.type=='move'){
  			console.log("row draggedContext");
  			console.log(evt);
  			console.log("row relatedContext");
  			console.log(evt.relatedContext.index,
  						evt.relatedContext.element,
  						evt.relatedContext.list,
  						evt.relatedContext.component
  						)
  			return true;
  				var CopyData = this.mainContent.rows.slice();

				newIndex = (evt.draggedContext.futureIndex)+1;
				oldIndex = evt.draggedContext.index;
				element = evt.relatedContext.element;
				console.log(element);
				this.mainContent.rows.forEach(function(data,key){
					console.log(data);
					if(data.id==element.id){
						Vue.set(data,'index', newIndex);
					}else if(data.id != element.id && data.index>=newIndex){
						Vue.set(data,index, parseInt(data.index)+1);
					}
				});
				//this.mainContent.rows = CopyData;
			this.call_default_functions();
			}
			return false;
  		},

  		reomve_row: function(key){
			var response = confirm("Do you want to delete Row? ");
			if(response){
				this.mainContent.rows.splice(key, 1);
				this.call_default_functions();
			}
		},
  		//Rows drop details
		handleDrop: function(columnData,Events) {
			if(typeof columnData=='undefined' || typeof columnData.type=='undefined'){
				return false;
			}
			if(columnData.type!="column"){
				return false;
			}
			this.dropover = false;
			var containerid = parseInt(this.mainContent.totalrows);
			
			var noOfCell = columnData['value'].replace('col-',"");
			var newRow   = {
							'id':containerid,
							'index':containerid,
							'cells': noOfCell,
							'cell_data': [],
							'data':{}
							};
			if(noOfCell==2){
				newRow.cell_left = 0;
				newRow.cell_right = 0;
			}
			this.mainContent.totalrows = containerid+1;
			this.mainContent.rows.push(newRow);
			this.call_default_functions();
		},
		handleModuleDrop: function(moduleData,Events) {
			this.dropover = false;
			if(typeof moduleData=='undefined' || typeof moduleData.type=='undefined'){
				return false;
			}
			var moduletype = moduleData['type'];
			if(moduletype!="module"){
				return false;
			}
			var modulename = moduleData['modulename'];
			moduleJson = moduleData['moduleJson'];
			element = Events.currentTarget;
			var modulesid = parseInt(this.mainContent.totalmodules);

			var rowid = parseInt( element.getAttribute('data-rowid') );
			var cellid = parseInt( element.getAttribute('data-cellid') );

			this.mainContent.rows.forEach(function(columnVal,k){
				if(columnVal.id==rowid){
					moduleIndex = columnVal.cell_data.length;
					if(moduleIndex==0){ moduleIndex=1; }
					var cellData = {
							'cell_id'	: modulesid,
							'index'		: moduleIndex,
							'type'		: modulename,
							'container_id': rowid,
							'cell_container': cellid,
							};

						if(moduleJson.fields.length > 0){
							moduleJson.fields.forEach(function(module,key){
								cellData[module.name] = module.default;
							});
						}
						columnVal.cell_data.push(cellData);
				}
			});
			this.mainContent.totalmodules = modulesid+1;
			this.call_default_functions();
			/*rowData.cell_data.sort(function(a, b){
						var a1= a.index, b1= b.index;
						if(a1== b1) return 0;
						return a1> b1? 1: -1;
					});*/

			
		},
		add_modules: function(type){
			
		},
		setcontentData: function(){
  			this.mainContent_Save = JSON.stringify(this.mainContent);
  		},
		re_process_rawdata: function(){
			this.mainContent.rows.sort(function(a, b){
					var a1= a.index, b1= b.index;
					if(a1== b1) return 0;
					return a1> b1? 1: -1;
				});
			this.mainContent.rows.forEach(function(row,key){
				if(row.cells && row.cells=="2"){
					row.cell_left  = 0;
					row.cell_right = 0;
					row.cell_data.forEach(function(module,k){
						if(parseInt(module.cell_container)==1){
							row.cell_left = row.cell_left+1;
						}else if(parseInt(module.cell_container)==2){
							row.cell_right = row.cell_right+1;
						}
					});
					row.cell_data.sort(function(a, b){
						var a1= a.index, b1= b.index;
						if(a1== b1) return 0;
						return a1> b1? 1: -1;
					});
				}
			});
		},
		call_default_functions:function(){
			this.re_process_rawdata();
			this.setcontentData();
			//Vue.$forceUpdate();
			//this.mainContent.$forceUpdate()
		},

	}/*module close*/
});

app.mainContent = amppb_data;/* {
  "rows": [
    {
      "id": 1,
      "index": 1,
      "cells": 2,
      'cell_left':2,
      'cell_right':1,
      "cell_data": [
        {
          "cell_id": 1,
          "index": 1,
          "type": "text",
          "container_id": "1",
          "cell_container": "1",
          "text_editor": "Content Goes Here",
          "css_class": "Content Goes Here"
        },
        {
          "cell_id": 2,
          "index": 1,
          "type": "image",
          "container_id": "1",
          "cell_container": "2",
          "selected_image": "http://localhost/magzine/testing-wordpress/wp-content/plugins/accelerated-mobile-pages/images/150x150.png",
          "image_height": "150",
          "image_width": "150",
          "css_class": ""
        },
        {
          "cell_id": 3,
          "index": 2,
          "type": "button",
          "container_id": "1",
          "cell_container": "1",
          "button_txt": "Click Here",
          "button_link": "#",
          "css_class": ""
        },
        {
          "cell_id": 4,
          "index": 2,
          "type": "button",
          "container_id": "1",
          "cell_container": "2",
          "button_txt": "Click Here",
          "button_link": "#",
          "css_class": ""
        },
        {
          "cell_id": 5,
          "index": 3,
          "type": "image",
          "container_id": "1",
          "cell_container": "1",
          "selected_image": "http://localhost/magzine/testing-wordpress/wp-content/plugins/accelerated-mobile-pages/images/150x150.png",
          "image_height": "150",
          "image_width": "150",
          "css_class": ""
        },
        {
          "cell_id": 6,
          "index": 3,
          "type": "button",
          "container_id": "1",
          "cell_container": "2",
          "button_txt": "Click Here",
          "button_link": "#",
          "css_class": ""
        }
      ],
      "data": {
        
      }
    },
    {
      "id": 2,
      "index": 2,
      "cells": 1,
      "cell_data": [
        {
          "cell_id": 7,
          "index": 1,
          "type": "button",
          "container_id": "2",
          "cell_container": "1",
          "button_txt": "Click Here",
          "button_link": "#",
          "css_class": ""
        },
        {
          "cell_id": 8,
          "index": 2,
          "type": "button",
          "container_id": "2",
          "cell_container": "1",
          "button_txt": "Click Here",
          "button_link": "#",
          "css_class": ""
        },
        {
          "cell_id": 9,
          "index": 3,
          "type": "text",
          "container_id": "2",
          "cell_container": "1",
          "text_editor": "Content Goes Here",
          "css_class": "Content Goes Here"
        }
      ],
      "data": {
        
      }
    }
  ],
  "totalrows": 3,
  "totalmodules": 10
} */;
app.call_default_functions();