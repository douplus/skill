;(function($){
	$.cookie = {
		set: function(params){
			// params: ( name, value, expires, path, domain, secure )
			// $.cookie.set({ name: 'hello', value: 'works', expires: '1', path: '/' });
			var today = new Date();
			today.setTime( today.getTime() );
			if( params['expires'] ){
				params['expires'] = params['expires'] * 1000 * 60 * 60 * 24;
			}
			var expires_date = new Date( today.getTime() + (params['expires']) );
			document.cookie = params['name'] + '=' +escape( params['value'] ) +
				( ( params['expires'] ) ? ';expires=' + expires_date.toGMTString() : '' ) +
				( ( params['path'] ) ? ';path=' + params['path'] : '' ) + 
				( ( params['domain'] ) ? ';domain=' + params['domain'] : '' ) +
				( ( params['secure'] ) ? ';secure' : '' );
		},
		get: function(params){
			// params: ( name )
			// $.cookie.get({ name: 'hello' });
			var a_all_cookies = document.cookie.split( ';' );
			var a_temp_cookie = '';
			var cookie_name = '';
			var cookie_value = '';
			var b_cookie_found = false;
			for( var i=0; i < a_all_cookies.length; i++ ){
				a_temp_cookie = a_all_cookies[i].split( '=' );
				cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
				if( cookie_name == params['name'] ){
					b_cookie_found = true;
					if( a_temp_cookie.length > 1 ){
						cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
					}
					return cookie_value;
					break;
				}
				a_temp_cookie = null;
				cookie_name = '';
			}
			if( !b_cookie_found ){
				return null;
			}
		},
		remove: function(params){
			// params: ( name, path, domain )
			// $.cookie.remove({ name: 'hello', path: '/', domain: '' });
			var a = { name: params['name'] };
			if( this.get( a ) ) document.cookie = params['name'] + '=' +
				( ( params['path'] ) ? ';path=' + params['path'] : '' ) +
				( ( params['domain'] ) ? ';domain=' + params['domain'] : '' ) +
				';expires=Thu, 01-Jan-1970 00:00:01 GMT';
		},
		enabled: function(){
			// $.cookie.enabled();
			return navigator.cookieEnabled;
		}
	};
}(jQuery));
;(function($){
	$.timestamp = {
		get: function getTimestamp( params ){
			// params: ( readable: 'all'/true/flase )
			if( typeof params === 'undefined' || typeof params['readable'] === 'undefined' ){
				var c = null
			}else{
				var c = params['readable'];	
			}
			var a = new Date().getTime()
				,date = new Date(a)
				,datevalues = [
					date.getFullYear()
					,date.getMonth()+1
					,date.getDate()
					,date.getHours()
					,date.getMinutes()
					,date.getSeconds()
				];
			var b = datevalues[0] +'-'+ (datevalues[1] < 10 ? '0' : '')+datevalues[1] +'-'+ (datevalues[2] < 10 ? '0' : '')+datevalues[2] +' '+ (datevalues[3] < 10 ? '0' : '')+datevalues[3] +':'+ (datevalues[4] < 10 ? '0' : '')+datevalues[4] +':'+ (datevalues[5] < 10 ? '0' : '')+datevalues[5];
			if( c == 'all' || c == null ){
				return a +'_'+ b;
			}else if( c ){
				return b;
			}else{
				return a;
			}
		}
	};
}(jQuery));