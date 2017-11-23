Vue.component('amp-pagebuilder-modal', {
  template: '#amp-pagebuilder-modal-template',
  props: ['dataContent']
})
Vue.component('amp-pagebuilder-module-modal', {
  template: '#amp-pagebuilder-module-modal-template',
  props: ['dataContent'],
  methods:{
  	hideModulePopUp: function(event){
			app.showmoduleModal = false;
		}
  }
})
//Need to make
Vue.component('col-template',function(){
	template: '#col-template'
})
//module is working
Vue.component('module-data',{
	template: '#module-data-template',
	props: ['cell','cellcontainer','modulekey'],
	data:function(){
		return {
			showModuleModal: false
			
		};
	},
	methods:{
		showModulePopUp: function(){
			app.showmoduleModal = true;
		},
		
	}
	
})
var app = new Vue({
  el: '#ampForWpPageBuilder_container',
  data: {
    message: 'Hello AMP Page builder वासियों अज़ीम',
    demoMessage: {},
    showModal: false,
    showmoduleModal: false,
    moduledrag: false,
    pagebuilderContent: ' <p class="dummy amppb-rows-message">Welcome to AMP Page Builder.</p>',
    mainContent: {},
    mainContent_Save: JSON.stringify(this.mainContent),
  },
  methods: {
  		 //row Sorting
  		rows_moved: function(evt){
  			
  			var newIndex = (evt.draggedContext.futureIndex)+1;
  			var currentElement = evt.draggedContext.element;
  			var current = evt.relatedContext.list;
  			//alert(JSON.stringify(current));
  			this.mainContent.rows.forEach(function(data,key){
  				if(data.id==currentElement.id){
  					data.index = newIndex;
  				}else if(data.id != currentElement.id && data.index>=newIndex){
  					data.index = data.index+1;
  					this.mainContent.rows[key].index = this.mainContent.rows[key].index+1
  					alert(data.id+"!="+currentElement.id);
  				}
  			});

  			this.call_default_functions();
  			
  		},
  		module_moved: function(evt){
  			/*var newIndex = (evt.draggedContext.futureIndex)+1;
  			var currentElement = evt.draggedContext.element;
  			
  			var rowid = evt.draggedContext;
  			alert("draggedContext "
  						+" \n "+ JSON.stringify( evt.draggedContext.index)
  						+" \n "+ JSON.stringify( evt.draggedContext.element)
  						+" \n "+ JSON.stringify( evt.draggedContext.futureIndex)
  						);
  			this.demoMessage = evt;*/
  			/*alert("relatedContext "
  						+ JSON.stringify(  evt.relatedContext.index) 
  						+ JSON.stringify(  evt.relatedContext.element) 
  						+ JSON.stringify(  evt.relatedContext.list)
  						+ JSON.stringify(  evt.relatedContext.component) );*/

			/*var cellid = evt.currentTarget.getAttribute('data-cellid');
  			this.mainContent.rows.forEach(function(data,key){
  				if(data.id == currentElement.container_id){
  					data.cell_data.forEach(function(moduleData,modulekey){
  						if(moduleData.cell_id==currentElement.cell_id){
  							moduleData.splice(modulekey, 1);
  						}

  					});
  				}
  				//add on new position 
  				if(data.id == rowid){
  					currentElement.index = newIndex;
  					currentElement.cell_container = cellid;
  					currentElement.container_id = rowid;
  					data.push(currentElement);
  				}
  			});*/
  			this.call_default_functions();
  			//return true;
		},
  		//Rows drop details
		handleDrop: function(columnData,Events) {
			if( typeof columnData == "undefined" || !("type" in columnData) || columnData.type!="column"){
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
				newRow.cell_left = [];
				newRow.cell_right = [];
			}

			this.mainContent.totalrows = containerid+1;
			this.mainContent.rows.push(newRow);
			this.call_default_functions();
		},
		handleModuleDrop: function(moduleData,Events) {
			this.dropover = false;
			if(typeof moduleData == "undefined" ){ return false; }
			if(!("type" in moduleData) ){return false;}
			if(moduleData.type!="module" ){return false;}
			var moduletype = moduleData['type'];
			var modulename = moduleData['modulename'];
			moduleJson = moduleData['moduleJson'];
			element = Events.currentTarget;
			var modulesid = (this.mainContent.totalmodules);

			var rowid = element.getAttribute('data-rowid');
			var cellid = element.getAttribute('data-cellid');
			this.mainContent.rows.forEach(function(columnVal,k){
				if(columnVal.id==rowid){
					moduleIndex = columnVal.cell_data.length+1;
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
			

			
		},
		setcontentData: function(){
			this.mainContent_Save = JSON.stringify(this.mainContent);
  		},
		re_process_rawdata: function(){
			//Sort rows
			this.mainContent.rows.sort(function(a, b){
				var a1= a.index, b1= b.index;
				if(a1== b1) return 0;
				return a1> b1? 1: -1;
			});
			this.mainContent.rows.forEach(function(row,key){
				row.cell_data.sort(function(a, b){
					var a1= a.index, b1= b.index;
					if(a1== b1) return 0;
					return a1> b1? 1: -1;
				});
				if(row.cells==2){
					row.cell_left  = [];
					row.cell_right = [];
					row.cell_data.forEach(function(module,k){
						if(module.cell_container==1){
							row.cell_left.push(module);
						}else if(module.cell_container==2){
							row.cell_right.push(module);
						}
					});
					row.cell_left.sort(function(a, b){
						var a1= a.index, b1= b.index;
						if(a1== b1) return 0;
						return a1> b1? 1: -1;
					});
					row.cell_right.sort(function(a, b){
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
		},

	}/*module close*/
});

app.mainContent = amppb_data;
app.call_default_functions();