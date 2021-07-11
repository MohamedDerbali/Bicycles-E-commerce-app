function modifyURLQuery(url, param){
        var value = {};

	var query = String(url).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}
	}
        
        value = $.extend(value, param);
        
        // Generate query parameter string
        var query_param = '';
        for (i in value){
            if(value[i]){
                if(i === 'route'){ // Skip route value to encode
                    query_param += '&' + i + '=' + value[i];
                } else {
                    query_param += '&' + i + '=' + encodeURIComponent(value[i]);
                }
            }
        }
        
        // Return url with modified parameter
        if(query_param){
            return query[0] + '?' + query_param.substring(1);
        } else {
            return query[0];
        }
}

$.fn.tf_filter = function(setting = null){
    // Default setting
    var default_setting = {
        delay: 2, // Second
        requestURL: null,
        searchEl: null,
        ajax: false,
        search_in_description: true,
        no_result: '', // HTML for empty product result
        onParamChange: function(){},
        onInputChange: function(){},
        onReset: function(){},
        onResult: function(){}, // Result function for json
        onBeforeSend: function(){},
        onComplete: function(){},
        status: {
            price: 1,
            manufacturer: 1,
            search: 0,
            rating: 0,
            discount: 0,
            filter: 1,
            custom: 0,
            availability: 1
        }
    };
    
    setting = $.extend(default_setting, setting);
    
    var tf_filter = this;
    
    // Filter inputs
    this.inputs = $(this).find('input:not([type="search"])');
    
    // Start filter
    this.start = function(param){
        if(!setting.ajax){
            // Reload page with filter parameter
            window.location.href = modifyURLQuery(window.location.href, $.extend(param, {page: null}));
            return;
        }
    };
    
    this.getParam = function(){
        var param = {};
        
        // price
        if(setting.status.price){ 
            var price = '';
            var min_price_input = tf_filter.inputs.filter('[name="tf_fp[min]"]');
            var max_price_input = tf_filter.inputs.filter('[name="tf_fp[max]"]');
            
            if(min_price_input.attr('min') !== min_price_input.val()){ // When minimum price change
                price +=  min_price_input.val();
            }
            
            if(max_price_input.attr('max') !== max_price_input.val()){ // When maximum price change
                price += 'p' + max_price_input.val();
            }
            
            if(price){
                param.tf_fp = price;
            }
        }
        
        
        // Availability
        if(setting.status.availability){
            var in_stock = tf_filter.inputs.filter('[name="tf_fs"]:checked').val();
            
            if(in_stock !== undefined){
                param.tf_fs = in_stock;
            }
        }
        
        // Manufacturer
        if(setting.status.manufacturer){
            var manufacturer_ids = tf_filter.inputs.filter('[name="tf_fm"]:checked').map(function(){
                return $(this).val();
            }).get().join('.');
            
            if(manufacturer_ids){
                param.tf_fm = manufacturer_ids;
            }
        }
        
        // Filter
        if(setting.status.filter){
            var filter_ids = tf_filter.inputs.filter('[name="tf_ff"]:checked').map(function(){
                return $(this).val();
            }).get().join('.');
            
            if(filter_ids){
                param.tf_ff = filter_ids;
            }
        }
        
        return $.extend({
            tf_fp: null,
            tf_fq: null,
            tf_fr: null,
            tf_fd: null,
            tf_fs: null,
            tf_fm: null,
            tf_ff: null,
            tf_fc: null
        }, param);
    };
    
    // Run task after user change filter
    tf_filter.on('change', function(){
        // Clear past timeout
        if(tf_filter.timeoutId !== undefined){
            clearTimeout(tf_filter.timeoutId);
        }
        
        // Get filter param
        var param = tf_filter.getParam();
        
        // Delay before to start filter
        tf_filter.timeoutId = setTimeout(function(){
            tf_filter.start(param);
        }, setting.delay * 1000);
        
        // Update page URL
        history.pushState(null, null, modifyURLQuery(window.location.href, $.extend(param, {page: null})));
        
        // Trigger param change event
        setting.onParamChange(param);
        
        
    });
    
    // Input change event
    this.inputs.on('change', function(e){
        setting.onInputChange(e);
    });
    
    // # Reset #
    // Radio and checkbox
    $('[data-tf-reset="check"]').on('click', function(e){
        e.stopImmediatePropagation();
        $(this).parents('.tf-filter-group').find('input').prop('checked', false);
        
        setting.onReset(this);
        tf_filter.change();
    });

    // Price
    $('[data-tf-reset="price"]').on('click', function(e){
        e.stopImmediatePropagation();
        
        $('[name="tf_fp[min]"]').val($('[name="tf_fp[min]"]').attr('min'));
        $('[name="tf_fp[max]"]').val($('[name="tf_fp[max]"]').attr('max'));
        
        setting.onReset(this);
        tf_filter.change();
    });

    // Text
    $('[data-tf-reset="text"]').on('click', function(e){
        e.stopImmediatePropagation();
        $(this).parents('.tf-filter-group').find('input').val('');
        
        setting.onReset(this);
        tf_filter.change();
    });

    // Reset all
    $(this).find('[data-tf-reset="all"]').on('click', function(e){
        e.stopImmediatePropagation();

        // Radio and checkbox
        $('.tf-filter-group :checkbox, .tf-filter-group :radio').prop('checked', false);
        
        // Text
        $('.tf-filter-group input[type="text"]').val('');

        // Price
        $('[name="tf_fp[min]"]').val($('[name="tf_fp[min]"]').attr('min'));
        $('[name="tf_fp[max]"]').val($('[name="tf_fp[max]"]').attr('max'));
        
        // Trigger events
        setting.onReset(this);
        tf_filter.change();
    });
};