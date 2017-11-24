Vue.component('amp-pagebuilder-modal', {
  template: '#amp-pagebuilder-modal-template',
  props: ['dataContent'],
   methods:{
  	hidePageBuilderPopUp: function(event){
			app.showModal = false;
		},
	showtabs: function($key){

	}
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
    demoMessage: {},
    showModal: false,
    showmoduleModal: false,
    modalcontent: [],
    moduledrag: false,
    pagebuilderContent: ' <p class="dummy amppb-rows-message">Welcome to AMP Page Builder.</p>',
    mainContent: {},
    mainContent_Save: JSON.stringify(this.mainContent),
    //Scroll position
    scrollPosition: 0
  },
  methods: {
  		showModulePopUp: function(event){
			openModulePopup(event);
		},
  		 //row Sorting
  		rows_moved: function(evt){
  			/*newIndex = (evt.moved.newIndex)+1;
  			oldIndex = evt.moved.oldIndex;
  			element = evt.moved.element;
  			this.mainContent.rows.forEach(function(data,key){
  				if(data.id==element.id){
  					data.index = newIndex;
  				}else if(data.id != element.id && data.index>=newIndex){
  					data.index = (data.index)+1;
  				}
  			});
  			
  			this.call_default_functions();*/
  			return true;
  		},
  		module_moved: function(evt,row,col){
  			/*if(evt.added){
  				addedelement = evt.added.element;
  				addedelement.index = (evt.newIndex)+1;
  				this.mainContent.rows.forEach(function(data,key){
	  				if(row.id==data.id){
		  			 	data.cell_data.push(addedelement)
	  				}
	  			});
  			}else if(evt.removed){
  				removeelement = evt.removed.element;
  				this.mainContent.rows.forEach(function(data,key){
  					if(row.id==data.id){
  						data.cell_data.forEach(function(moduleData,modeuleKey){
  							alert(JSON.stringify(moduleData)+ " \n" + JSON.stringify(removeelement));
  							if(moduleData.cell_id == removeelement.cell_id){
  								moduleData.splice(modeuleKey,1);
  							}
  						});
  					}
  				});
  			}*/
  			//alert(JSON.stringify(evt)+ " \n"+(row.id)+ " \n"+col);
  			
  			// newIndex = (evt.moved.newIndex)+1;
  			// oldIndex = evt.moved.oldIndex;
  			// element = evt.moved.element;
  			// 

  			//this.call_default_functions();
  			return true;
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
		reomve_row: function(key){
			var response = confirm("Do you want to delete Row? ");
			if(response){
				this.mainContent.rows.splice(key, 1);
				this.call_default_functions();
			}
		},
		setcontentData: function(){
			this.mainContent_Save = JSON.stringify(this.mainContent);
  		},
		re_process_rawdata: function(){
			//Sort rows
			/*this.mainContent.rows.sort(function(a, b){
				var a1= a.index, b1= b.index;
				if(a1== b1) return 0;
				return a1> b1? 1: -1;
			});*/
			this.mainContent.rows.forEach(function(row,key){
				/*row.cell_data.sort(function(a, b){
					var a1= a.index, b1= b.index;
					if(a1== b1) return 0;
					return a1> b1? 1: -1;
				});*/
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
					/*row.cell_left.sort(function(a, b){
						var a1= a.index, b1= b.index;
						if(a1== b1) return 0;
						return a1> b1? 1: -1;
					});
					row.cell_right.sort(function(a, b){
						var a1= a.index, b1= b.index;
						if(a1== b1) return 0;
						return a1> b1? 1: -1;
					});*/
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