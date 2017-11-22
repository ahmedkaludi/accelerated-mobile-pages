Vue.component('amp-pagebuilder-modal', {
  template: '#amp-pagebuilder-modal-template',
  props: ['dataContent']
})
//Need to make
Vue.component('col-template',function(){
	template: '#col-template'
})
//module is working
Vue.component('module-data',{
	template: '#module-data-template',
	props: ['cell','cellcontainer','modulekey'],
})
var app = new Vue({
  el: '#ampForWpPageBuilder_container',
  data: {
    message: 'Hello AMP Page builder वासियों अज़ीम',
    showModal: false,
    moduledrag: false,
    pagebuilderContent: ' <p class="dummy amppb-rows-message">Welcome to AMP Page Builder.</p>',
    mainContent: {},
    mainContent_Save: JSON.stringify(this.mainContent),
  },
  methods: {
  		//Columns Events
  		add_column_pagebuilder:function(evt){
  			var containerid = (this.mainContent.rows.totalrows)+1;
			var noOfCell = 1;//data.replace('col-',"");
			var newRow = {
						'id':containerid,
						'index':containerid,
						'cells': noOfCell,
						'cell_data': [],
						'data':{}
						};
			this.mainContent.rows.push(newRow);
			this.setcontentData();
			return true;
  		},
  		//row Sorting
  		rows_moved: function(evt, originalEvent){
  			alert("row moved");
  			return false;
  		},


  		//Rows drop details
		handleDrop: function(columnData,Events) {
			if(columnData.type!="column"){
				return false;
			}
			this.dropover = false;
			var containerid = (this.mainContent.totalrows);
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
			var moduletype = moduleData['type'];
			if(moduletype!="module"){
				return false;
			}
			var modulename = moduleData['modulename'];
			moduleJson = moduleData['moduleJson'];
			element = Events.currentTarget;
			var modulesid = (this.mainContent.totalmodules);

			var rowid = element.getAttribute('data-rowid');
			var cellid = element.getAttribute('data-cellid');
			this.mainContent.rows.forEach(function(columnVal,k){
				if(columnVal.id==rowid){
					moduleIndex = columnVal.cell_data.length;
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
			this.mainContent.totalrows = modulesid+1;
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
			this.mainContent.rows.forEach(function(row,key){
				if(row.cells==2){
					row.cell_left  = 0;
					row.cell_right = 0;
					row.cell_data.forEach(function(module,k){
						if(module.cell_container==1){
							row.cell_left = row.cell_left+1;
						}else if(module.cell_container==2){
							row.cell_right = row.cell_right+1;
						}
					});
				}
			});
		},
		call_default_functions:function(){
			this.re_process_rawdata();
			this.setcontentData();
		},

	}/*module close*/
});

app.mainContent = {
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
};
app.re_process_rawdata();