/*Vue.component('amp-pagebuilder-modal', {
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
})*/
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
/*
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
})*/
var app = new Vue({
  el: '#ampForWpPageBuilder_container',
  data: {
    message: 'Hello AMP Page builder',
    demoMessage: {},
    showModal: false,
    showmoduleModal: false,
    modalcontent: [],
    moduledrag: false,
    pagebuilderContent: ' <p class="dummy amppb-rows-message">Welcome to AMP Page Builder.</p>',
    mainContent: {},
    mainContent_Save: JSON.stringify(this.mainContent),
    colonetemplate: {
				'id':1,
				'index':1,
				'cells': 1,
				'cell_data': [],
				'data':{}
				},
	coltwotemplate:{
					'id':1,
					'index':1,
					'cells': 2,
					'cell_data': [],
					'data':{}
					},
    //Scroll position
    scrollPosition: 0
  },
  methods: {
  		showModulePopUp: function(event){
			openModulePopup(event);
		},
		copiedrows: function(template){
			template.id++;
		},
		module_copied: function(template){
			template.cell_id++;
		},
		inserted(data){
	      // console.log(data);
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
			this.mainContent.rows.sort(function(a, b){
				var a1= a.index, b1= b.index;
				if(a1== b1) return 0;
				return a1> b1? 1: -1;
			});
			this.mainContent.rows.forEach(function(row,key){
				if(row.cell_data && row.cell_data.length>0){
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
					}
				}
			});
		},
		call_default_functions:function(){
			this.re_process_rawdata();
			this.setcontentData();
		},

	}/*module close*/
});

//app.mainContent = amppb_data;
app.mainContent = {"rows":[{"id":1,"index":1,"cells":2,"cell_data":[{"cell_id":1,"index":1,"type":"blurb","container_id":"1","cell_container":"1","text_title":"Heart Of The Landing Page","text_description":"This is a sample text which is being used for the dummy purpose to avoid confusion.","blurb_image":"http://localhost/magzine/testing-wordpress/wp-content/plugins/accelerated-mobile-pages/images/150x150.png","img_width":"80px","img_height":"80px","css_class":""},{"cell_id":2,"index":1,"type":"button","container_id":"1","cell_container":"2","button_txt":"Click Here","button_link":"#","css_class":""}],"data":{}},{"id":2,"index":2,"cells":2,"cell_data":[{"cell_id":3,"index":1,"type":"blurb","container_id":"2","cell_container":"1","text_title":"Heart Of The Landing Page","text_description":"This is a sample text which is being used for the dummy purpose to avoid confusion.","blurb_image":"http://localhost/magzine/testing-wordpress/wp-content/plugins/accelerated-mobile-pages/images/150x150.png","img_width":"80px","img_height":"80px","css_class":""},{"cell_id":4,"index":1,"type":"button","container_id":"2","cell_container":"2","button_txt":"Click Here","button_link":"#","css_class":""}],"data":{}}],"totalrows":3,"totalmodules":5};
app.call_default_functions();