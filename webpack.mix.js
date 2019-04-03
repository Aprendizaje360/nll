let mix = require('laravel-mix').mix;

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

let myConfig = {
	admin_js_sequence_create: {
		source: "resources/assets/admin/js/sequence_create.js",
		output: "public/admin/js/sequence_create.min.js"
	},
	admin_js_inspinia:{
		source: [
			"resources/assets/admin/js/vendor/plugins/metisMenu/jquery.metisMenu.js", 
			"resources/assets/admin/js/vendor/plugins/pace/pace.min.js",
			"resources/assets/admin/js/vendor/plugins/slimscroll/jquery.slimscroll.min.js", 
			"resources/assets/admin/js/vendor/inspinia.js"
		],
		output: "public/admin/vendor/js/inspinia.min.js"
	},
	admin_js_jquery:{
		source: "resources/assets/admin/js/vendor/jquery-3.1.1.min.js",
		output: "public/admin/vendor/js/jquery-3.1.1.min.js"
	},
	admin_js_bootstrap:{
		source: "resources/assets/admin/js/vendor/bootstrap.min.js",
		output: "public/admin/vendor/js/bootstrap.min.js"
	},
}

// Client general resources
	// Admin general resources  
mix.js("resources/assets/admin/js/sequence_create.js", "public/admin/js/sequence_create.min.js")
   .js("resources/assets/enterprise/js/addClerks.js", "public/enterprise/js/addClerks.min.js")
   .js("resources/assets/enterprise/js/uploadFile.js", "public/enterprise/js/uploadFile.min.js")
   .js("resources/assets/enterprise/js/enterprise.js", "public/enterprise/js/enterprise.min.js")
   .scripts(myConfig.admin_js_jquery.source, myConfig.admin_js_jquery.output)
   .js(myConfig.admin_js_inspinia.source, myConfig.admin_js_inspinia.output)
   .js(myConfig.admin_js_bootstrap.source, myConfig.admin_js_bootstrap.output)
   .sass('resources/assets/client/scss/app.scss', 'public/client/css')
   .sass('resources/assets/admin/scss/style.scss', 'public/admin/css')
   .sass('resources/assets/enterprise/scss/style.scss', 'public/enterprise/css')
   .copy('resources/assets/admin/css/patterns', 'public/admin/vendor/css/patterns')
   .copy('resources/assets/admin/css', 'public/admin/vendor/css')
   .copy('resources/assets/favicons', 'public/favicons')
   .copy('resources/assets/admin/font-awesome', 'public/admin/font-awesome')

 	// faviconss
    
 	
//No usados porque error (Vue)
/*
   .js('resources/assets/client/js/app.js', 'public/client/js')
 	
*/