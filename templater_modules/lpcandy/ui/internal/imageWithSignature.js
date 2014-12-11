lp.imageWithSignature = lp.cover.extendOptions({
    init: function () {
        this.cover.addClass("lp-button");
    },
    change: function(){
		this.element.find(".img_title").text(this.value.title);
		this.element.find(".img_desc").text(this.value.desc);
		if(this.value.url_image_preview){
			this.element.find(".big_img").attr('title',this.value.title);
			this.element.find(".preview_img").css({
				backgroundImage: "url('"+base_url+'/'+this.value.url_image_preview+"')",
			});
			this.element.find(".preview_img").attr({ src: base_url+'/'+this.url_image_preview });
			this.value.url_image = this.value.url_image_preview;
			this.element.find(".big_img").attr("href", base_url+'/'+this.value.url_image);
		}		         
    },
    configForm: {
        title: "Upload image and edit signature",
        items: [
            {   
                type: "label", value:'Upload image file', margin: "10px 0 5px", 
                 
            },  
            {
                name: 'url_image_preview', type: 'uploadButton', label: 'Select image file',
            },
            {
                type: 'label',
                value: "Image title:",
                margin: "10px 0 5px",
            },
            {
                name: "title", type: "text",
            },
            {
                type: 'label',
                value: "Image description:",
                margin: "10px 0 5px",
            },
            {
                name: "desc", type: "text"
            }
        ]
        
    }
})